<?php
// Database connection
$dsn = "mysql:host=localhost;dbname=form";
$username = "root";
$password = "root";

try {
    $db = new PDO($dsn, $username, $password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo "Database error: " . $e->getMessage();
    exit;
}

if(isset($_POST["delete"])) {
    $reg_no = $_POST["reg_no"];

    try {
        // Query to delete student record
        $stmt = $db->prepare("DELETE FROM register WHERE reg_no = ?");
        $stmt->execute([$reg_no]);
        
        // Check if deletion was successful
        if($stmt->rowCount() > 0) {
            echo "Student record deleted successfully.";
        } else {
            echo "No record found with the given registration number.";
        }
    } catch(PDOException $e) {
        echo "Database error: " . $e->getMessage();
    }
}
?>
