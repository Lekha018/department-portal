<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Student Marks</title>
    <link rel="stylesheet" href="facuploadattendance.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f4f4f4;
        }
        .container {
            text-align: center;
            color: white;
        }
        #custom-file-input {
            display: none;
        }
        #custom-file-label {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            display: inline-block;
        }
        #custom-file-label:hover {
            background-color: #45a049;
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
    <div class="container">
    <h2>View Attendance</h2>
<form action="testattendancedisplay.php" method="post" enctype="multipart/form-data">
    <div>
        <label for="batch">Select Batch:</label><br>
        <select id="batch" name="batch">
            <option value="testmarkbatch2020_2024">2020-2024</option>
            <option value="testmarkbatch2021_2025">2021-2025</option>
            <option value="testmarkbatch2022_2026">2022-2026</option>
            <option value="testmarkbatch2022_2026">2023-2027</option>
        </select>
        <br>
    </div>

    <br>
    
    <div>
        <label for="sem">Select Semester:</label><br>
        <select id="sem" name="sem">
            <option value="1">Semester 1</option>
            <option value="2">Semester 2</option>
            <option value="3">Semester 3</option>
            <option value="4">Semester 4</option>
            <option value="5">Semester 5</option>
            <option value="6">Semester 6</option>
            <option value="7">Semester 7</option>
            <option value="8">Semester 8</option>
        </select>
    </div>

    <br>
    <div>
    <label for="month">Start Month:</label><br>
    <select id="month" name="month">
        <option value="January">January</option>
        <option value="February">February</option>
        <option value="March">March</option>
        <option value="April">April</option>
        <option value="May">May</option>
        <option value="June">June</option>
        <option value="July">July</option>
        <option value="August">August</option>
        <option value="September">September</option>
        <option value="October">October</option>
        <option value="November">November</option>
        <option value="December">December</option>
    </select>
</div>



    <br>

    <div>
        <label>Enter Year:</label><br>
            <input type = "text" name = "year" required>
        </div>
    <br>
    <input type="submit" value="Download" name="submit">
</form>

<script>
    document.getElementById("custom-file-label").addEventListener("click", function() {
        document.getElementById("custom-file-input").click();
    });
</script>

        
        

</body>
</html>