<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student signup and login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
    <h1>Personal Details</h1>
    <form id="personal-details-form" method="POST" action="">
        <label for="first_name">First Name:</label>
        <input type="text" id="first_name" name="first_name" required><br>

        <label for="last_name">Last Name:</label>
        <input type="text" id="last_name" name="last_name" required><br>

        <label for="reg_no">Register Number:</label>
        <input type="text" id="reg_no" name="reg_no" required><br>

        <label for="dob">Date of Birth :</label>
        <input type="text" id="dob" name="dob" required><br>

        <label for="address">Address :</label>
        <input type="text" id="address" name="address" required><br>

        <label for="con_number">Contact Number:</label>
        <input type="text" id="con_number" name="con_number" required><br>

        <!-- Add more fields dynamically -->
        <label for="user"> College Email id :</label>
        <input type="text" id="user" name="user" required><br>

        <label for="personalemail">Personal mail id :</label>
        <input type="text" id="personalemail" name="personalemail" required><br>

        <label for="collname">College Name:</label>
        <input type="text" id="collname" name="collname" required><br>

        <label for="dept">Department :</label>
        <input type="text" id="dept" name="dept" required><br>

        <label for="year">Year :</label>
        <input type="text" id="year" name="year" required><br>

        <label for="cgpa">Current CGPA :</label>
        <input type="text" id="cgpa" name="cgpa" required><br>

        <label for="highsc">Higher Secondary School Name :</label>
        <input type="text" id="highsc" name="highsc" required><br>

        <label for="msc">Marks Secured :</label>
        <input type="text" id="msc" name="msc" required><br>

        <label for="secsc">Secondary School Name:</label>
        <input type="text" id="secsc" name="secsc" required><br>

        <label for="mscu">Marks Secured :</label>
        <input type="text" id="mscu" name="mscu" required><br>

        <label for="father">Father's Name:</label>
        <input type="text" id="father" name="father" required><br>

        <label for="fmobile">Father's Mobile Number :</label>
        <input type="text" id="fmobile" name="fmobile" required><br>

        <label for="mother">Mother's Name:</label>
        <input type="text" id="mother" name="mother" required><br>

        <label for="mmobile">Mother's Mobile Number :</label>
        <input type="text" id="mmobile" name="mmobile" required><br>

        <label for="sib">Sibling Name :</label>
        <input type="text" id="sib" name="sib" required><br>

        <input type="submit" name="" value="Submit">
        
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
                        <a href="web.page" class="logo-text">Home</a>
                    </div>
                </li>
                <li>
                    <div class="logo-text-container">
                        <img src="images/back.png" alt="" class="imh">
                        <a href="adminaddandupdatestudent.php" class="logo-text">Back</a>
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
    $conn = mysqli_connect('localhost', 'root', 'root', 'form');
    
    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Get form data
    $fname = $_POST['first_name'];
    $lname = $_POST['last_name'];
    $regno = $_POST['reg_no'];
    $dob = $_POST['dob'];
    $address = $_POST['address'];
    $number = $_POST['con_number'];
    $user = $_POST['user'];
    $personalemail = $_POST['personalemail'];
    $collname = $_POST['collname'];
    $dept = $_POST['dept'];
    $year = $_POST['year'];
    $cgpa = $_POST['cgpa'];
    $highsc = $_POST['highsc'];
    $msc = $_POST['msc'];
    $secsc = $_POST['secsc'];
    $mscu = $_POST['mscu'];
    $father = $_POST['father'];
    $fmobile = $_POST['fmobile'];
    $mother = $_POST['mother'];
    $mmobile = $_POST['mmobile'];
    $sib = $_POST['sib'];

    // SQL query to insert data into students table
    $sql = "INSERT INTO register (first_name, last_name, reg_no, dob, address, con_number, user, personalemail, collname, dept, year, cgpa, highsc, msc, secsc, mscu,father, fmobile, mother, mmobile, sib) 
            VALUES ('$fname', '$lname','$regno','$dob','$address', '$number','$user', '$personalemail', '$collname','$dept','$year','$cgpa','$highsc','$msc', '$secsc', '$mscu', '$father', '$fmobile', '$mother', '$mmobile','$sib')";

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