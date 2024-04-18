<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Student personal</title>
<link rel="stylesheet" href="stupersonaldisplay.css">

<style>
    h1 {
        text-align: center;
    }
    .form-container {
        width: 70%;
        margin: 0 auto;
    }
    .form-group {
        margin-bottom: 20px;
    }
    .form-group label {
        display: block;
        font-weight: bold;
    }
    .form-group input[type="text"] {
        width: 540px;
        padding: 8px;
        box-sizing: border-box;
        margin-left: 50px;
    }
</style>
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

<h1>Student Personal Details</h1>
<div class="form-container">
    <form>
    <?php
session_start();

// Check if session user is set
if(isset($_SESSION['sess_user'])) {
    $sessionUser = $_SESSION['sess_user'];
} else {
    // Redirect to login page or handle unauthorized access
    header("Location: login.php");
    exit();
}

// Database connection parameters
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "form";

// Create connection
$_con = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if ($_con === false) {
    die("ERROR: Could not connect. " . mysqli_connect_error());
}

// SQL query to retrieve data for the session user
$query = "SELECT first_name, last_name, reg_no, dob, address, con_number, user, personalemail, collname, dept, year, cgpa, highsc, msc, secsc, mscu, father, fmobile, mother, mmobile, sib FROM `register` WHERE first_name = '$sessionUser'";

// Execute query
$result = mysqli_query($_con, $query);

// Check if query executed successfully
if ($result) {
    // Check if there are any rows returned
    if(mysqli_num_rows($result) > 0) {
        
        $row = mysqli_fetch_assoc($result);

        $labels = array(
            'first_name' => 'First Name', 'last_name' => 'Last Name', 'reg_no' => 'Register Number',
            'dob' => 'Date of Birth', 'address' => 'Address', 'con_number' => 'Contact Number', 'user' => 'College Email id',
            'personalemail' => 'Personal Mail id', 'collname' => 'College Name', 'dept' => 'Department', 'year' => 'Year',
            'cgpa' => 'Current CGPA', 'highsc' => 'Higher Secondary School', 'msc' => 'Marks Secured', 'secsc' => 'Secondary School Name',
            'mscu' => 'Marks Secured', 'father' => 'Father Name', 'fmobile' => 'Father Mobile Number', 'mother' => 'Mother Name',
            'mmobile' => 'Mother Mobile Number', 'sib' => 'Sibling Name'
            // Add more custom labels for other columns as needed
        );

        // Output form fields for each column
        foreach ($row as $key => $value) {
            echo '<div class="form-group">';
            echo "<label for='$key'>" . ($labels[$key] ?? $key) . ":</label>"; // Use custom label if available, otherwise use column name
            echo "<input type='text' id='$key' name='$key' value='$value' readonly>";
            echo '</div>';
        }

    } else {
        echo "No data found for $sessionUser!";
    }
} else {
    echo "Error: " . mysqli_error($_con);
}

// Close database connection
mysqli_close($_con);
?>
