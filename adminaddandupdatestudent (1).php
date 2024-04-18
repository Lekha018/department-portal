<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Record Search</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Add and Search Student Record</h1>
        <form action="adminaddstudent.php">
            <button type="submit" name="addstudent">Add Student</button>
        </form>
        <form action="adminsearchstudent.php" method="POST">
            <label for="reg_no">Registration Number:</label>
            <input type="text" id="reg_no" name="reg_no" required>
            <button type="submit" name="search">Search</button>
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

</body>
</html>
