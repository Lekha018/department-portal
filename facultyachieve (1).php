<!DOCTYPE html>
<html lang="en">
  <head>
  <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Faculty Achievements</title>
    <link rel="stylesheet" href="facultyachieve.css">
  </head>
  <body>
    <div class="signup-box">
      <h1>Faculty Achievements</h1>
      <form action="" method="POST">
        <label>First Name</label>
        <input type="text" name="first_name" >
        </br>
        <label>Last Name</label>
        <input type="text" name="last_name" >
        </br>
        </br>
        <label>Faculty Id</label>
        <input type="text" name="reg_no" >
        </br>
        <label>Department</label>
        <input type="text" name="dept" >
        </br>
        <label>Journal Paper</label>
        <input type="text" name="journalpaper" >
        </br>
        <label>Conference Paper</label>
        <input type="text" name="conferencepaper">
        </br>
        <label>Awards Received</label>
        <input type="text" name="awards" >
        </br>
        <label>Courses and Certification</label>
        <input type="text" name="coursesandcertification" >
        </br>
        <button type="submit" class="btn">Submit</button>
        <input type="button" name="view" value="View" onclick="window.location.href='facachieveretrieve.php'">
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
                        <a href="web.php" class="logo-text">Home</a>
                    </div>
                </li>
                <li>
                    <div class="logo-text-container">
                        <img src="images/back.png" alt="" class="imh">
                        <a href="facultywelcome.php" class="logo-text">Back</a>
                    </div>
                </li>
                <li>
                    <div class="logo-text-container">
                        <img src="images/logout1.png" alt="" class="imh">
                        <a href="facultylogin.php" class="logo-text">Logout</a>
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
    $sname = $_POST['last_name']; // corrected to lowercase
    $id = $_POST['reg_no'];
    $dept = $_POST['dept'];
    $journal = $_POST['journalpaper']; // corrected to match form input name
    $conference = $_POST['conferencepaper']; // corrected to match form input name
    $AwardsReceived = $_POST['awards']; // corrected to match form input name
    $CoursesandCertification = $_POST['coursesandcertification'];

    // SQL query to insert data into faculty database table
    $sql = "INSERT INTO `facultyachievements` (`first_name`,`last_name`, `reg_no`,`dept`, `journalpaper`, `conferencepaper`, `awards`,`coursesandcertification`) 
            VALUES ('$fname','$sname', '$id','$dept', '$journal', '$conference', '$AwardsReceived','$CoursesandCertification')";

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