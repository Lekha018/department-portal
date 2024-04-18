<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hod Dashboard</title>
    <link rel="stylesheet" href="style.css">
    <style>
           .achievements, .personal-details, {
    float: right; /* Float the blocks to the right */
    clear: right; /* Clear the float to avoid overlap */
    margin: 10px; /* Adjust margin as needed */
}
.achievements {
    background: #260477;
    backdrop-filter: blur(5px);
    background-color: rgba(255, 255, 255, 0.2);
    padding: 20px;
    width: 200px;
    height: 80px;
}

.personal-details, {
    background: #8FBC8F;
    padding: 20px;
    width: 200px;
    height: 80px;
    margin-left:60%;
}

, .achievements{
    padding: 2px;
}
.personal-details {

    background-color: #260477;
    background: rgba(255, 255, 255, 0.2);
    backdrop-filter: blur(5px);
    float: left;
    border-radius: 20px;
    padding: 20px;
    width: 200px;
    margin: 60px;
    height: 80px;
    margin-left: 170px;
    text-align: center;
    color: white;
}
.personal-details a{
    text-decoration: none;
}

.achievements{
    border-radius: 20px;
    background-color: #260477; /* Set background color */
    background: rgba(255, 255, 255, 0.2); /* Set background with blur effect */
    backdrop-filter: blur(5px); /* Apply blur effect */
    float: right;
    padding: 20px;
    color: white;
    width: 200px;
    margin: 60px;
    height: 200px;
    text-align: center;
}

.achievements a{
    text-decoration: none;
}



.achievements p,
.personal-details p {
    color: white; /* Set text color */
    font-size: 26px;
    text-align: center; /* Set font size */
}
.achievements{
    background-color: #260477;
    background: rgba(255, 255, 255, 0.2);
    backdrop-filter: blur(5px);
    float: right;
    padding: 20px;
    width: 200px;
    height: 80px;
    color: white;
    text-align: center;
    margin: 60px;
}


    </style>
</head>
<body>

    <div class="header">
        <?php
        session_start();

        if(isset($_SESSION['sess_user'])) {
            $student_name = $_SESSION['sess_user'];
            echo "<h1>Welcome $student_name!</h1>";
        } else {
            header("Location: hodlogin.php"); // Redirect to login page if not logged in
            exit();
        }
        ?>
        
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
                        <img src="images/logout1.png" alt="" class="imh">
                        <a href="hodlogin.php" class="logo-text">Logout</a>
                    </div>
                </li>
            </ul>    
        </div>
    </div>
    
            <!-- Placeholder content -->
            <br><br><br>
            <div class="personal-details">
                <a href="hodpersonal.php">
                    <p>Personal Details<p>
                </a>
            </div>
            <br>

            <div class="achievements">
                <a href="hodachieve.php">
                    <p>Achievements</p>
                </a>
            </div>
            <div class="personal-details">
                <a href="facultyhodachievementsrangesearch.php">
                    <p>View Faculty Achievements</p>
                </a>
            </div><br>
            <div class="achievements">
                <a href="stuachretrieve.php">
                    <p>View Student Achievements</p>
                </a>
            </div>
            <div class="personal-details">
                <a href="testattendancestudentviewbutton.php">
                    <p>View Attendance</p>
                </a>
            </div>
            <div class="achievements">
                <a href="odseehod.php">
                    <p>View OD status</p>
                </a>
            </div>

</body>
</html>
