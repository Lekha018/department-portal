<?php
require 'vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

if(isset($_POST["submit"])) {
    if(isset($_FILES["file"]) && $_FILES["file"]["error"] == 0) {
        $allowed_extensions = array("xls", "xlsx");
        $file_extension = pathinfo($_FILES["file"]["name"], PATHINFO_EXTENSION);

        if(in_array($file_extension, $allowed_extensions)) {
            $target_dir = "uploads/";
            $target_file = $target_dir . basename($_FILES["file"]["name"]);

            if(move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
                // Process the uploaded Excel file and insert data into the database
                $spreadsheet = IOFactory::load($target_file);
                $sheet = $spreadsheet->getActiveSheet();

                // Connect to your database
                $dsn = "mysql:host=localhost;dbname=form";
                $username = "root";
                $password = "root";

                try {
                    $db = new PDO($dsn, $username, $password);
                    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                    $firstRow = true; // Flag to track whether it's the first row

                    foreach ($sheet->getRowIterator() as $row) {
                        if ($firstRow) {
                            $firstRow = false; // Set to false after processing the first row
                            continue; // Skip processing the first row
                        }

                        $data = $row->getCellIterator();
                        $cellIndex = 0; // Variable to keep track of cell index
                        $values = array(); // Array to store values for insertion

                        foreach ($data as $cell) {
                            $values[] = $cell->getValue();
                        }

                        // Construct your SQL INSERT query
                        $stmt = $db->prepare("INSERT INTO attendance (first_name, last_name, reg_no, sem1, sem2, sem3, sem4, sem5, sem6, sem7, sem8) VALUES (?, ?, ?, ?, ?,?,?,?,?,?,?)");
                        $stmt->execute($values); // Execute the query with the array of values/
                    }

                    echo "Data inserted successfully.";
                
                } catch(PDOException $e) {
                    echo "Database error: " . $e->getMessage();
                } catch(Exception $e) {
                    echo "Error: " . $e->getMessage();
                }
            
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        } else {
            echo "Sorry, only Excel files are allowed.";
        }
    } else {
        echo "Error uploading file.";
    }
}
?>
