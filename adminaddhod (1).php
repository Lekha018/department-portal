<!DOCTYPE html>
<html lang="en">
  <head>
  <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hod Database</title>
    <link rel="stylesheet" href="facultypersonal.css">
  </head>
  <body>
    <div class="signup-box">
      <h1>Hod Database</h1>
      <form action="" method="POST">
        <label>First Name</label>
        <input type="text" name="first_name" >
        </br>
        <label>Last Name</label>
        <input type="text" name="last_name" >
        </br>
        <label>Faculty Id</label>
        <input type="text" name="reg_no" >
        </br>
        </br>
        <label>Age</label>
        <input type="user" name="age" >
        </br>
        </br>
        <label>Gender: </label>  
        <input type="text" name="gender" >    
        </br>
        </br>
        <label>Department</label>
        <input type="text" name="dept" >
        </br>
        </br>
        <label>Experience</label>
        <input type="text" name="experience" >
        </br>
        </br>
        <label>Interest</label>
        <input type="text" name="interest">
        </br>
        <label>Research</label>
        <input type="text" name="research" >
        </br>
        </br> 
        <button type="submit" class="btn">Submit</button>
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
                        <a href="adminwelcome.php" class="logo-text">Back</a>
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

    <?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Database connection
    $conn = mysqli_connect('localhost', 'root', 'root', 'hod');
    
    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Get form data
    $fname = $_POST['first_name'];
    $sname = $_POST['last_name']; // corrected to lowercase
    $id = $_POST['reg_no'];
    $age = $_POST['age'];
    $gender = $_POST['gender'];
    $dept = $_POST['dept'];
    $experience = $_POST['experience']; // corrected to match form input name
    $interest = $_POST['interest']; // corrected to match form input name
    $research = $_POST['research']; // corrected to match form input name

    // SQL query to insert data into faculty database table
    $sql = "INSERT INTO `hod database` (`first_name`,`last_name`, `reg_no`, `age`, `gender`, `dept`, `experience`, `interest`, `research`) 
            VALUES ('$fname','$sname','$id', '$age', '$gender', '$dept', '$experience', '$interest', '$research')";

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