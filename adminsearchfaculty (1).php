<?php
// Database connection
$dsn = "mysql:host=localhost;dbname=reg";
$username = "root";
$password = "root";

try {
    $db = new PDO($dsn, $username, $password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo "Database error: " . $e->getMessage();
    exit;
}

if(isset($_POST["search"])) {
    $reg_no = $_POST["reg_no"];

    // Query to search for student record
    $stmt = $db->prepare("SELECT * FROM `faculty database` WHERE reg_no = ?");
    $stmt->execute([$reg_no]);
    $student = $stmt->fetch(PDO::FETCH_ASSOC);

    if($student) {
        // Display student record with editable fields
        ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Edit Faculty Record</title>
            <link rel="stylesheet" href="stupersonaldisplay.css">
        </head>
        <body>
        <div class="sidebar"> 
        <div>
            <ul>
                <li>
                    <div class="logo-text-container">
                        <img src="images/rmkcet1.png" alt="" class="imh1">
                        
                    </div>
                </li>
                <li>
                    <div class="logo-text-container">
                        <img src="images/homelogo1.png" alt="" class="imh">
                        <a href="web.php" class="logo-text">Home</a>
                    </div>
                </li>
                <li>
                    <div class="logo-text-container">
                        <img src="images/back.png" alt="" class="imh">
                        <a href="adminaddandupdatefaculty.php" class="logo-text">Back</a>
                    </div>
                </li>
                <li>
                    <div class="logo-text-container">
                        <img src="images/logout1.png" alt="" class="imh">
                        <a href="adminpanel.php" class="logo-text">Logout</a>
                    </div>
                </li>
            </ul>    
        </div>
    </div>

            <div class="form-container">
                <h1>Edit Faculty Record</h1>
                <form action="adminfacultyupdate.php" method="POST">
                    <input type="hidden" name="reg_no" value="<?php echo $student['reg_no']; ?>">
                    <label for="first_name">First Name:</label>
                    <input type="text" id="first_name" name="first_name" value="<?php echo $student['first_name']; ?>" required>
                    <label for="last_name">Last Name:</label>
                    <input type="text" id="last_name" name="last_name" value="<?php echo $student['last_name']; ?>" required>
                    <label for="reg_no">Faculty Id:</label>
                    <input type="text" id="reg_no" name="reg_no" value="<?php echo $student['reg_no']; ?>" required>
                    <label for="dept">Department:</label>
                    <input type="text" id="dept" name="dept" value="<?php echo $student['dept']; ?>" required>
                    <label for="experience">Experience:</label>
                    <input type="text" id="experience" name="experience" value="<?php echo $student['experience']; ?>" required>
                    <!-- Add other fields as needed -->
                    <button type="submit" name="update">Update</button>
                </form>
            </div>
        </body>
        </html>
        <?php
    } else {
        echo "Faculty record not found.";
    }
}
?>