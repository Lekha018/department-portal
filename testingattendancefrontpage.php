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
        <div>
            <label for="batch">Select Batch:</label><br>
            
            <input type="radio" id="batch1" name="batch" value="2021-2024">
            <label for="batch1">2020-2024</label><br>

            <input type="radio" id="batch2" name="batch" value="2022-2025">
            <label for="batch2">2021-2025</label><br>

            <input type="radio" id="batch3" name="batch" value="2023-2026">
            <label for="batch3">2022-2026</label><br>
            <br>
        </div>
        
        <div>
            <label for="section">Select Section:</label><br>
            <input type="radio" id="sectionA" name="section" value="A">
            <label for="sectionA">Section A</label><br>

            <input type="radio" id="sectionB" name="section" value="B">
            <label for="sectionB">Section B</label><br>

            <input type="radio" id="sectionC" name="section" value="C">
            <label for="sectionC">Section C</label><br>
        </div>

        <br>

        <label for="custom-file-input" id="custom-file-label">Choose Excel File</label>
        <input type="file" id="custom-file-input" name="file" accept=".xls,.xlsx">
        <br><br>

        <input type="submit" value="Upload" name="submit">
    </form>
</div>

    
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


