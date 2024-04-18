<!DOCTYPE html>
<html lang="en">
  <head>
  <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Achievements</title>
    <link rel="stylesheet" href="style.css">
  </head>
  <body>
  <div class="stucontainer">
    <h1>Student Achievements</h1>
    <form action="view.php" method="POST" id="myForm">
        <label>First Name</label>
        <input type="text" name="first_name">
        <br><br>
        <label>Last Name</label>
        <input type="text" name="last_name">
        <br><br>
        <label>Register Number</label>
        <input type="text" name="reg_no">
        <br><br>
        <label>Department</label>
        <input type="text" name="dept">
        <br><br>
        <label>Journal Paper</label>
        <input type="text" name="journal">
        <br><br>
        <label>Conference Paper</label>
        <input type="text" name="conference">
        <br><br>
        <label>Awards</label>
        <input type="text" name="awards">
        <br><br>
        <label>Courses Completed</label>
        <input type="text" name="courses">
        <br><br>
        <label>Certifications Completed</label>
        <input type="text" name="certification">
        <br><br>
        <input type="submit" name="submit" value="Submit">
        <input type="button" name="view" value="View" onclick="window.location.href='stuachieveretrieve.php'">
    </form>
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
                        <a href="#" class="logo-text">Home</a>
                    </div>
                </li>
                <li>
                    <div class="logo-text-container">
                        <img src="images/back.png" alt="" class="imh">
                        <a href="studentwelcomepage.php" class="logo-text">Back</a>
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


    <?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Database connection
    $conn = mysqli_connect('localhost', 'root', 'root', 'form');
    
    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Get form data
    $fname = $_POST['first_name'];
    $lname = $_POST['last_name']; // corrected to lowercase
    $regno = $_POST['reg_no'];
    $dept = $_POST['dept'];
    $journal = $_POST['journal']; // corrected to match form input name
    $conference = $_POST['conference']; // corrected to match form input name
    $awards = $_POST['awards']; // corrected to match form input name
    $courses = $_POST['courses'];
    $certification = $_POST['certification'];

    // SQL query to insert data into faculty database table
    $sql = "INSERT INTO studentachievements (`first_name`, `last_name`, `reg_no`,`dept`, `journal`, `conference`, `awards`,`courses`,`Certification`) 
            VALUES ('$fname','$lname', '$regno','$dept', '$journal', '$conference', '$awards','$courses','$certification')";

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