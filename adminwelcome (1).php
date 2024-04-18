<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <div class="header">
        <?php
        session_start();

        if(isset($_SESSION['sess_user'])) {
            $student_name = $_SESSION['sess_user'];
            echo "<h1>Welcome $student_name!</h1>";
        } else {
            header("Location: adminpanel.php"); // Redirect to login page if not logged in
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
                        <a href="web.php" class="logo-text">Home</a>
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

            <!-- Placeholder content -->
            <div class="personal-details">
                <a href="adminaddandupdatestudent.php">
                    <p>Update Student Personal<p>
                </a>
            </div>

            <div class="achievements">
                <a href="adminaddandupdatefaculty.php">
                    <p>Update Faculty personal</p>
                </a>
            </div>

            <div class="marks">
                <a href="adminaddandupdatehod.php">
                    <p>Update HOd personal</p>
                </a>
            </div>
            <div class="attendance">
                <a href="adminpersonal.php">
                    <p>Admin personal database</p>
                
                </a>
            </div>

        



</body>
</html>
