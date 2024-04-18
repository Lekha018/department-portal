<?php
require 'vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\IOFactory;

if(isset($_POST["submit"])) {
    if(isset($_FILES["file"]) && $_FILES["file"]["error"] == 0) {
        $allowed_extensions = array("xls", "xlsx");
        $file_extension = pathinfo($_FILES["file"]["name"], PATHINFO_EXTENSION);

        if(in_array($file_extension, $allowed_extensions)) {
            // Get batch, semester, and examination inputs
            $batch = isset($_POST['batch']) ? $_POST['batch'] : '';
            $examination = isset($_POST['exam']) ? $_POST['exam'] : '';

            if (!empty($batch) && !empty($examination)) {
                // Adjusting batch format to match database naming convention
                $batch_start_year = substr($batch, 0, 4);
                $batch_end_year = substr($batch, 5);
                $next_year = (int)$batch_start_year + 1;
                $database_suffix = $next_year . '_' . $batch_end_year;

                // Construct database name based on batch
                $database_name = $batch;

                // Construct table name based on examination
                $table_name = $examination;
                $target_dir = "uploads/";
                $target_file = $target_dir . basename($_FILES["file"]["name"]);

                if(move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
                    // Process the uploaded Excel file and update data in the database
                    $spreadsheet = IOFactory::load($target_file);
                    $sheet = $spreadsheet->getActiveSheet();

                    // Connect to the dynamically selected database
                    $dsn = "mysql:host=localhost;dbname=$database_name";
                    $username = "root";
                    $password = "root";

                    try {
                        $db = new PDO($dsn, $username, $password);
                        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                        // Get the header row from the Excel sheet
                        $headerRow = $sheet->getRowIterator(1)->current();
                        $headerData = [];
                        foreach ($headerRow->getCellIterator() as $cell) {
                            $headerData[] = $cell->getValue();
                        }

                        // Iterate through each row in the Excel file
                        $rowIterator = $sheet->getRowIterator();
                        foreach ($rowIterator as $row) {
                            $rowData = [];
                            foreach ($row->getCellIterator() as $cell) {
                                $rowData[] = $cell->getValue();
                            }

                            // Extract register number from the row
                            $registerNumber = $rowData[1]; // Assuming register number is in the second column

                            // Iterate through each column in the Excel file (starting from the third column)
                            for ($i = 2; $i < count($headerData); $i++) {
                                $columnName = $headerData[$i];
                                $mark = $rowData[$i];

                                // Construct your SQL query to update data in the database
                                if (!empty($columnName) && !empty($registerNumber)) {
                                    $sql = "UPDATE $table_name SET `$columnName` = ? WHERE `REGISTER NUMBER` = ?";
                                    $stmt = $db->prepare($sql);
                                    $stmt->execute([$mark, $registerNumber]);
                                } else {
                                    echo "Error: Empty column name or register number.";
                                }
                            }
                        }

                        echo "Data updated successfully.";

                    } catch(PDOException $e) {
                        echo "Database error: " . $e->getMessage();
                    } catch(Exception $e) {
                        echo "Error: " . $e->getMessage();
                    }

                } else {
                    echo "Sorry, there was an error uploading your file.";
                }
            } else {
                echo "Batch and examination fields are required.";
            }
        } else {
            echo "Sorry, only Excel files are allowed.";
        }
    } else {
        echo "Error uploading file.";
    }
}
?>
