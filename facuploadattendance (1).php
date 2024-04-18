<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Student Attendance</title>
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
                        <a href="facultywelcome.php" class="logo-text">Back</a>
                    </div>
                </li>
                <li>
                    <div class="logo-text-container">
                        <img src="images/logout1.png" alt="" class="imh">
                        <a href="facultylogin.php" class="logo-text">Logout</a>
                    </div>
                </li>
            </ul>    
        </div>
    </div>

    <div class="container">
        <h2>Upload Student Attendance</h2>
        <form action="atupload.php" method="post" enctype="multipart/form-data">
            <label for="custom-file-input" id="custom-file-label">Choose Excel File</label>
            <input type="file" id="custom-file-input" name="file" accept=".xls,.xlsx">
            <br><br>
            <input type="submit" value="Upload" name="submit">
        </form>
    </div>

    <script>
        document.getElementById("custom-file-label").addEventListener("click", function() 
        {
            document.getElementById("custom-file-input").click();
        });
    </script>
</body>
</html>


