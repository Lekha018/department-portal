<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Student Data</title>
<link rel="stylesheet" href="markdisplaystyle.css">
<style>
    table {
        border-collapse: collapse;
        width: 100%;
    }
    th, td {
        border: 1px solid #ddd;
        padding: 8px;
        text-align: left;
    }
    th {
        background-color: none;
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
<div class = "markdisplay">
<?php
// Assuming you have a database connection established already
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

session_start();

if(isset($_SESSION['sess_user'])) {
    $student_name = $_SESSION['sess_user'];

    // Retrieving data from the database
    $query = "SELECT first_name, last_name, reg_no, sem1, sem2, sem3, sem4, sem5, sem6, sem7, sem8 FROM attendance WHERE first_name = '$student_name'";
    $result = mysqli_query($_con, $query);

    if(mysqli_num_rows($result) > 0) {

        echo "<table>";

// Displaying data rows
echo "<table style='width: 70%;'>";
echo "<style>";
echo "table {";
echo "  width: 50%;"; /* Adjust the width as needed */
echo "  margin: 0 auto;"; /* Center the table horizontally */
echo "  text-align: center;"; /* Align text center */
echo "}";
echo "th, td {";
echo "  text-align: center;";
echo "  color: white;"; /* Align text center */
echo "}";
echo "</style>";
while ($row = mysqli_fetch_assoc($result)) {
    echo "<tr>";
    if(!isset($headerPrinted)) {
        echo "<div style='text-align: center; padding-left: 2px; color: white;'>"; // Open div for center alignment with custom padding

        echo "<h2>Name: " . $row['first_name'] . " " . $row['last_name'] . "</h2>";
        echo "<h2>Register Number: " . $row['reg_no'] . "</h2>";
        echo "</div>"; // Close div for center alignment 
        $headerPrinted = true;
    }
    
    
    echo "<table>";

// Subjects as row headers
echo "<tr><th>Semester</th><th>Attendance percentage</th></tr>";

// Internal Assessment 1

echo "<tr><th>Semester 1</th>";
echo "<td>" . $row['sem1'] . "</td>";
echo "</tr>";

echo "<tr><th>Semester 2</th>";
echo "<td>" . $row['sem2'] . "</td>";
echo "</tr>";

echo "<tr><th>Semester 3</th>";
echo "<td>" . $row['sem3'] . "</td>";
echo "</tr>";

echo "<tr><th>Semester 4</th>";
echo "<td>" . $row['sem4'] . "</td>";
echo "</tr>";

// Internal Assessment 2
echo "<tr><th>Semester 5</th>";
echo "<td>" . $row['sem5'] . "</td>";
echo "</tr>";

echo "<tr><th>Semester 6</th>";
echo "<td>" . $row['sem6'] . "</td>";
echo "</tr>";

echo "<tr><th>Semester 7</th>";
echo "<td>" . $row['sem7'] . "</td>";
echo "</tr>";

echo "<tr><th>Semester 8</th>";
echo "<td>" . $row['sem8'] . "</td>";
echo "</tr>";

echo "</table>";

}

echo "</table>";
// Get the buffered content and clean the buffer
    } else {
        echo "No data found!";
    }
 } else{
    header("Location: admin.php"); // Redirect to login page if not logged in
    exit();
}

// Close database connection
mysqli_close($_con);
?>
</div>
</body>
</html>
