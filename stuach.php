<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Students Achievements</title>
    <link rel="stylesheet" href="style.css">
    <style>
        .form-group{
            margin-left:20%;
            margin-bottom: 10px; /* Added margin-bottom for spacing between form fields */
        }
        label {
            display: inline-block;
            width: 150px; /* Adjust width as needed */
            font-weight: bold;
        }
        .container{
            margin-left:33%;
        }
        input[type="text"],
        input[type="month"],
        select {
            width: calc(100% - 150px); /* Adjust width to fill remaining space after label */
            padding: 5px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            margin-left: 10px; /* Added margin for spacing between label and input */
        }
        select {
            height: 35px; /* Set the height of the select box */
        }
        #academicyear,
        #semester,
        #section,
        #frommonth,
        #prize {
            width: calc(165% - 156px); /* Adjust width to fill remaining space after label and considering margin */
            margin-left:34%;
        }
        .submit-button {
            margin-left: 450px; /* Match margin-left of label for submit button alignment */
        }
    </style>
</head>
<body>
    <h1>Students Achievements</h1>
    <div class="container" id="form-group">
            <!-- Student details fields -->
            <form method="POST" action="">
                <div class="form-group">
                    <label for="firstname">First Name:</label>
                    <input type="text" id="firstname" name="firstname" required>
                </div>
                <div class="form-group">
                    <label for="lastname">Last Name:</label>
                    <input type="text" id="last-name" name="lastname" required>
                </div>
                <div class="form-group">
                    <label for="registernumber">Register Number:</label>
                    <input type="text" id="registernumber" name="registernumber" required>
                </div>
                <div class="form-group">
                    <label for="academicyear">Academic Year:</label>
                    <select name="academicyear" id="academicyear">
                    <option value="">select academic year</option>
                    <option value="2024-2028">2024-2028</option>
                    <option value="2023-2027">2023-2027</option>
                    <option value="2022-2026">2022-2026</option>
                    <option value="2021-2025">2021-2025</option>
                    
                    </select>
                </div>
                <div class="form-group">
                <label for="semester">Semester:</label>
                <select id="semester" name="semester" required>
                  <option value="">Select Semester</option>
                  <option value="1">1</option>
                  <option value="2">2</option>
                  <option value="3">3</option>
                  <option value="4">4</option>
                  <option value="5">5</option>
                  <option value="6">6</option>
                  <option value="7">7</option>
                  <option value="8">8</option>
                </select>
                </div> 
                <div class="form-group">
                <label for="section">Section:</label>
                <select id="section" name="section" required>
                <option value="">Select Section</option>
                <option value="A">A</option>
                <option value="B">B</option>
                <option value="C">C</option>
                <option value="D">D</option>
                </select>
                </div>
                <div class="form-group">
                    <label for="tech">Technical Event:</label>
                    <input type="text" id="tech" name="technicalevent">
                </div>
                <div class="form-group">
                    <label for="nontech">Non-Technical Event:</label>
                    <input type="text" id="nontech" name="nontechnicalevent">
                </div>
                <div class="form-group">
                    <label for="frommonth">Month:</label>
                    <select id="frommonth" name="month" >
                    <option value="">Select Month</option>
                    <option value="01">January</option>
                    <option value="02">February</option>
                    <option value="03">March</option>
                    <option value="04">April</option>
                    <option value="05">May</option>
                    <option value="06">June</option>
                    <option value="07">July</option>
                    <option value="08">August</option>
                    <option value="09">September</option>
                    <option value="10">October</option>
                    <option value="11">November</option>
                    <option value="12">December</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="year">Year:</label>
                    <input type="year" id="year" name="year">
                </div>
                <div class="form-group">
                    <label for="prize">Place Of Prize/Participation:</label>
                    <select id="prize" name="prize">
                    <option value="">Select prize</option>
                    <option value="First">First</option>
                    <option value="Second">Second</option>
                    <option value="Third">Third</option>
                    <option value="Participation">Participation</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="institute">Name Of The Institution:</label>
                    <input type="text" id="institute" name="institutename">
                </div>
                <div class="form-group">
                    <label for="certificatelink">Certificate Link(Upload):</label>
                    <input type="text" id="certificatelink" name="certificatelink">
                </div>
                <div class="form-group">
                    <label for="internship">Company Name-Internship:</label>
                    <input type="text" id="internship" name="internshipcompany">
                </div>
                <div class="form-group">
                    <label for="title">Title Of The Training</label>
                    <input type="text" id="title" name="trainingtitle">
                </div>
                <div class="form-group">
                    <label for="days">No Of Days Attended:</label>
                    <input type="text" id="days" name="daysattended">
                </div>
                <div class="form-group">
                    <label for="from">From</label>
                    <input type="text" id="from" name="fromdate">
                </div>
                <div class="form-group">
                    <label for="to">To:</label>
                    <input type="text" id="to" name="todate">
                </div>
                <div class="form-group">
                    <label for="certificateinternship">Certificate Link(Upload):</label>
                    <input type="text" id="certificateinternship" name="internshipcertificate">
                </div>
                <button class="submit-button" type="submit">Submit</button>
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
                
                
            </ul>    
        </div>
    </div>
    <?php

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Database connection
    $conn = mysqli_connect('localhost', 'root', 'root', 'students');
    
    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Get form data and sanitize it
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $registernumber = $_POST['registernumber'];
    $academicyear = $_POST['academicyear'];
    $semester = $_POST['semester'];
    $section = $_POST['section'];
    $technicalevent = $_POST['technicalevent'];
    $nontechnicalevent = $_POST['nontechnicalevent'];
    $month = $_POST['month'];
    $year = $_POST['year'];
    $prize = $_POST['prize'];
    $institutename = $_POST['institutename'];
    $certificatelink = $_POST['certificatelink'];
    $internshipcompany = $_POST['internshipcompany'];
    $trainingtitle = $_POST['trainingtitle'];
    $daysattended = $_POST['daysattended'];
    $fromdate = $_POST['fromdate'];
    $todate = $_POST['todate'];
    $internshipcertificate = $_POST['internshipcertificate'];

    // Prepare SQL statement
    $sql = "INSERT INTO studentachievements (firstname, lastname, registernumber, academicyear, semester, section, technicalevent, nontechnicalevent, month, year, prize, institutename, certificatelink, internshipcompany, trainingtitle, daysattended, fromdate, todate, internshipcertificate) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    
    // Create prepared statement
    $stmt = mysqli_prepare($conn, $sql);
    
    // Bind parameters to placeholders
    mysqli_stmt_bind_param($stmt, "sssssssssssssssssss", $firstname, $lastname, $registernumber, $academicyear, $semester, $section, $technicalevent, $nontechnicalevent, $month, $year, $prize, $institutename, $certificatelink, $internshipcompany, $trainingtitle, $daysattended, $fromdate, $todate, $internshipcertificate);
    
    // Execute statement
    if (mysqli_stmt_execute($stmt)) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

    // Close statement
    mysqli_stmt_close($stmt);

    // Close connection
    mysqli_close($conn);
}
?>

    <script src="stuachscript.js"></script>
</body>
</html>