<?php
require 'vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\IOFactory;

if(isset($_POST["submit"])) {
    if(isset($_FILES["file"]) && $_FILES["file"]["error"] == 0) {
        $allowed_extensions = array("xls", "xlsx");
        $file_extension = pathinfo($_FILES["file"]["name"], PATHINFO_EXTENSION);

        if(in_array($file_extension, $allowed_extensions)) {
            // Get batch, semester, and year inputs
            $batch = isset($_POST['batch']) ? $_POST['batch'] : '';
            $semester = isset($_POST['sem']) ? $_POST['sem'] : '';
            $year = isset($_POST['year']) ? $_POST['year'] : '';

            if (!empty($batch) && !empty($semester) && !empty($year)) {
                // Adjusting batch format to match database naming convention
                $batch_start_year = substr($batch, 0, 4);
                $batch_end_year = substr($batch, 5);
                $next_year = (int)$batch_start_year + 1;
                $database_suffix = $next_year . '_' . $batch_end_year;

                // Construct database name based on batch
                $database_name = $batch;

                // Construct table name based on semester
                $table_name = "attendance";

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

                        // Update year for all students
                        $updateYearSql = "UPDATE $table_name SET year = ?";
                        $stmtYear = $db->prepare($updateYearSql);
                        $stmtYear->execute([$year]);

                        // Iterate through each row in the Excel file
                        $rowIterator = $sheet->getRowIterator();
                        foreach ($rowIterator as $row) {
                            $rowData = [];
                            foreach ($row->getCellIterator() as $cell) {
                                $rowData[] = $cell->getValue();
                            }

                            // Extract register number and marks from the row
                            $registerNumber = $rowData[1]; // Assuming register number is in the second column
                            // Assuming marks start from the third column, adjust as needed
                            $marks = array_slice($rowData, 2);

                            // Construct your SQL query to update data in the database
                            $updateSql = "UPDATE $table_name SET ";
                            $params = [];
                            foreach ($marks as $index => $mark) {
                                $columnName = $sheet->getCellByColumnAndRow($index + 3, 1)->getValue(); // Assuming month names start from the fourth column
                                if ($columnName !== null) {
                                    $updateSql .= "$columnName = ?, ";
                                    $params[] = $mark;
                                }
                            }
                            $updateSql = rtrim($updateSql, ', ') . " WHERE `REGISTER NUMBER` = ?";
                            $stmt = $db->prepare($updateSql);
                            $params[] = $registerNumber;
                            $stmt->execute($params);
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
                echo "Batch, semester, and year fields are required.";
            }
        } else {
            echo "Sorry, only Excel files are allowed.";
        }
    } else {
        echo "Error uploading file.";
    }
}
?>
