<?php
// Database connection
$dsn = "mysql:host=localhost;dbname=hod";
$username = "root";
$password = "root";

try {
    $db = new PDO($dsn, $username, $password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo "Database error: " . $e->getMessage();
    exit;
}

if(isset($_POST["update"])) {
    // Debug output for received form data
    print_r($_POST); // Output received form data for debugging
    
    $reg_no = $_POST["reg_no"];
    $first_name = $_POST["first_name"];
    $last_name = $_POST["last_name"];
    $dept = $_POST['dept'];
    $age = $_POST["age"];
    $research = $_POST["research"];
    $interest = $_POST["interest"];
    $experience = $_POST["experience"];
    // Add other fields as needed
    
    try {
        // Query to update student record
        $stmt = $db->prepare("UPDATE `hod database` SET first_name = ?, last_name = ?, dept = ?,age = ?, research = ?, interest = ?, experience = ? WHERE reg_no = ?");
        $stmt->execute([$first_name, $last_name, $dept,$age,$research,$interest, $experience, $reg_no]); // Update other fields as needed
        
        // Check if update was successful
        if($stmt->rowCount() > 0) {
            echo "Hod record updated successfully.";
        } else {
            echo "No changes were made to the hod record.";
        }
    } catch(PDOException $e) {
        echo "Database error: " . $e->getMessage(); // Output any database errors for debugging
    }
}
?>