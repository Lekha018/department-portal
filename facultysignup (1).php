<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Faculty signup and login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class = "signup">
        <h1>Faculty sign Up</h1>
        <form method="POST" action="">
            <label>First Name</label>
            <input type = "text" name="first_name" required>
            <label>Last Name</label>
            <input type = "text" name="last_name" required>
            <label>Contact Number</label>
            <input type = "tel" name="con_number" required>
            <label>Faculty Id</label>
            <input type = "text" name = "reg_no" required>
            <label>Email</label>
            <input type = "text" name="user" required>
            <label>Password</label>
            <input type = "password" name="pass" required>
            <input type="submit" name="" value="Submit">
        </form>
        <p style="text-align: center; padding-top: 20px; font-size: 15px;";>Have an account already? <a href="facultylogin.php">Login Here!</a></p>
    </div>
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
                        <a href="web.php" class="logo-text">Back</a>
                    </div>
                </li>
            </ul>    
        </div>
    </div>
    <?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Database connection
    $conn = mysqli_connect('localhost', 'root', 'root', 'reg');
    
    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Get form data
    $fname = $_POST['first_name'];
    $lname = $_POST['last_name'];
    $number = $_POST['con_number'];
    $regno = $_POST['reg_no'];
    $user = $_POST['user'];
    $pass = $_POST['pass'];

    // SQL query to insert data into students table
    $sql = "INSERT INTO faculty (first_name, last_name, con_number, reg_no, user, password) 
            VALUES ('$fname', '$lname', '$number','$regno','$user', '$pass')";

    if (mysqli_query($conn, $sql)) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

    // Close connection
    mysqli_close($conn);
}
?>
</body>
</html>