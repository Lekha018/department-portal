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

if(isset($_POST["search"])) {
    $reg_no = $_POST["reg_no"];

    // Query to search for student record
    $stmt = $db->prepare("SELECT * FROM register WHERE reg_no = ?");
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
            <title>Edit Student Record</title>
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
                        <a href="stueditpersonal.php" class="logo-text">Back</a>
                    </div>
                </li>
                <li>
                    <div class="logo-text-container">
                        <img src="images/logout1.png" alt="" class="imh">
                        <a href="admin.php" class="logo-text">Logout</a>
                    </div>
                </li>
            </ul>    
        </div>
    </div>

            <div class="form-container">
                <h1>Edit Student Record</h1>
                <form action="studentpersonalupdate.php" method="POST">
                    <input type="hidden" name="reg_no" value="<?php echo $student['reg_no']; ?>">
                    <label for="first_name">First Name:</label>
                    <input type="text" id="first_name" name="first_name" value="<?php echo $student['first_name']; ?>" required>
                    <label for="last_name">Last Name:</label>
                    <input type="text" id="last_name" name="last_name" value="<?php echo $student['last_name']; ?>" required>
                    <label for="personalemail">Personal Email:</label>
                    <input type="text" id="personalemail" name="personalemail" value="<?php echo $student['personalemail']; ?>" required>
                    <label for="highsc">Higher Secondary School:</label>
                    <input type="text" id="highsc" name="highsc" value="<?php echo $student['highsc']; ?>" required>
                    <label for="msc">Marks Secured:</label>
                    <input type="text" id="msc" name="msc" value="<?php echo $student['msc']; ?>" required>
                    <label for="secsc">Secondary School:</label>
                    <input type="text" id="secsc" name="secsc" value="<?php echo $student['secsc']; ?>" required>
                    <label for="mscu">Marks Secured:</label>
                    <input type="text" id="mscu" name="mscu" value="<?php echo $student['mscu']; ?>" required>
                    <label for="address">Address:</label>
                    <input type="text" id="address" name="address" value="<?php echo $student['address']; ?>" required>
                    <label for="con_number">Contact Number:</label>
                    <input type="text" id="con_number" name="con_number" value="<?php echo $student['con_number']; ?>" required>
                    <label for="year">Year:</label>
                    <input type="text" id="year" name="year" value="<?php echo $student['year']; ?>" required>
                    <label for="cgpa">Current Ggpa:</label>
                    <input type="text" id="cgpa" name="cgpa" value="<?php echo $student['cgpa']; ?>" required>
                    <label for="fmobile">Father's Mobile:</label>
                    <input type="text" id="fmobile" name="fmobile" value="<?php echo $student['fmobile']; ?>" required>
                    <label for="mmobile">Mother's Mobile:</label>
                    <input type="text" id="mmobile" name="mmobile" value="<?php echo $student['mmobile']; ?>" required>
                    <!-- Add other fields as needed -->
                    <button type="submit" name="update">Update</button>
                </form>
            </div>
        </body>
        </html>
        <?php
    } else {
        echo "Student record not found.";
    }
}
?>
