<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Application Status</title>
    <style>
       body{
        background-color:pink;
       }
        
        form {
            width: 30%;
            height:60%;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            margin-left:35%;
            margin-top:10%;
            background-color:#7FFFD4;
        }
        h1 {
            text-align: center;
        }
        label {
            display: block;
            margin-bottom: 10px;
        }
        input[type="text"],
        input[type="submit"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            box-sizing: border-box;
        }
        
    </style>
</head>
<body>
    <h1>View Application Status</h1>
    <form action="" method="post">
        <label for="regno">Enter Register Number:</label>
        <input type="text" id="regno" name="regno" required>
        <input type="submit" value="View Status">
    </form>

    <?php
    // Check if form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Check if regno is set and not empty
        if (isset($_POST['regno']) && !empty($_POST['regno'])) {
            $regno = $_POST['regno'];

            // Database connection
            $conn = mysqli_connect('localhost', 'root', 'root', 'students');

            // Check connection
            if (!$conn) {
                die("Connection failed: " . mysqli_connect_error());
            }

            // Retrieve status from the database
            $sql = "SELECT status FROM odapply WHERE regno = '$regno'";
            $result = mysqli_query($conn, $sql);

            if (mysqli_num_rows($result) > 0) {
                $row = mysqli_fetch_assoc($result);
                echo "Status: " . $row['status'];
            } else {
                echo "No application found with this register number";
            }

            // Close connection
            mysqli_close($conn);
        } else {
            echo "Please enter a register number";
        }
    }
    ?>
</body>
</html>