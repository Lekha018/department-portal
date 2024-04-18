<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Faculty Record</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>View Faculty Record Range</h1>
        <form action="facultyrangesearchpdfdownload.php" method="POST">
            <label for="coursefromdate">Course From Date:</label>
            <input type="text" id="coursefromdate" name="coursefromdate" required>
            <label for="coursetodate">Course To Date:</label>
            <input type="text" id="coursetodate" name="coursetodate" required>
            <button type="submit" name="search">Download</button>
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
                        <a href="hodwelcome.php" class="logo-text">Back</a>
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
</body>
</html>