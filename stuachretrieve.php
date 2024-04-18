<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Record</title>
    <link rel="stylesheet" href="style.css">
    <style>
        #semester,
        #section,
        #frommonth,
        #tomonth {
            width: calc(165% - 156px); /* Adjust width to fill remaining space after label and considering margin */
            margin-left:34%;
            
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
        label {
            display: inline-block;
            width: 150px; /* Adjust width as needed */
            font-weight: bold;
        }
        .container{
            margin-left:34%;
            margin-top:3%;
        }
        .submit-button {
            margin-left: 400px; /* Match margin-left of label for submit button alignment */
        }
        .form-group{
            margin-left:20%;
            margin-bottom: 10px; /* Added margin-bottom for spacing between form fields */
        }
        label {
            display: inline-block;
            width: 150px; /* Adjust width as needed */
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>View Student Record </h1>
        <form action="stuachretrievequery.php" method="POST">
    <div class="form-group">
    <label for="academicyear">Academic Year:</label>
    <input type="text" id="academicyear" name="academicyear" required>
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
    <label for="frommonth">From Month:</label>
    <select id="frommonth" name="frommonth" >
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
    <label for="fromyear">From Year (YYYY):</label>
    <input type="text" id="fromyear" name="fromyear" pattern="\d{4}" title="Please enter a valid year (YYYY)" >
    </div>
    <div class="form-group">
    <label for="tomonth">To Month:</label>
    <select id="tomonth" name="tomonth">
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
    <label for="toyear">To Year (YYYY):</label>
    <input type="text" id="toyear" name="toyear" pattern="\d{4}" title="Please enter a valid year (YYYY)" >
    </div>
    <button type="submit" name="search" class="submit-button">Get Details</button>
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