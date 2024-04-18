<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OD Applications</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
            padding: 8px;
        }
        th {
            background-color: #f2f2f2;
        }
        .accept, .reject {
            cursor: pointer;
            padding: 5px 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
            background-color: #e6e6e6;
        }
        .accept:hover, .reject:hover {
            background-color: #d9d9d9;
        }
        .center {
            text-align: center;
        }
    </style>
</head>
<body>
    <h1>OD Applications</h1>
    <table>
        <tr>
            <th>Name</th>
            <th>Register Number</th>
            <th>Semester</th>
            <th>Start Date</th>
            <th>End Date</th>
            <th>Reason</th>
            <th>Action</th> <!-- Extra column for Accept/Reject -->
        </tr>
        <?php
        // Database connection
        $conn = mysqli_connect('localhost', 'root', 'root', 'students');
        
        // Check connection
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }

        // Retrieve data from database
        $sql = "SELECT * FROM odapply";
        $result = mysqli_query($conn, $sql);

        // Display data in table
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr id='".$row['regno']."'>";
                echo "<td>".$row['name']."</td>";
                echo "<td>".$row['regno']."</td>";
                echo "<td>".$row['sem']."</td>";
                echo "<td>".$row['startdate']."</td>";
                echo "<td>".$row['enddate']."</td>";
                echo "<td>".$row['reason']."</td>";
                echo "<td>";
                echo "<button class='accept' onclick='acceptApplication(\"".$row['regno']."\")'>Accept</button>";
                echo "<button class='reject' onclick='rejectApplication(\"".$row['regno']."\")'>Reject</button>";
                echo "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='7'>No applications found</td></tr>";
        }

        // Close connection
        mysqli_close($conn);
        ?>
    </table>

    <script>
    function acceptApplication(regno) {
        // Send AJAX request to update database
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                alert("OD Application accepted");
                // Remove the row from the table
                var row = document.getElementById(regno);
                row.parentNode.removeChild(row);
            }
        };
        xhttp.open("GET", "hodaccept.php?regno=" + regno, true);
        xhttp.send();
    }

    function rejectApplication(regno) {
        // Send AJAX request to update database
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                alert("OD Application rejected");
                // Remove the row from the table
                var row = document.getElementById(regno);
                row.parentNode.removeChild(row);
            }
        };
        xhttp.open("GET", "hodreject.php?regno=" + regno, true);
        xhttp.send();
    }
    </script>
</body>
</html>