<?php
// Database connection
$dsn = "mysql:host=localhost;dbname=students";
$username = "root";
$password = "root";

try {
    $db = new PDO($dsn, $username, $password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo "Database error: " . $e->getMessage();
    exit;
}

if(isset($_POST["search"])) {
    // Retrieve the month, year, and section provided by the user
    $month = $_POST["frommonth"];
    $year = $_POST["fromyear"];
    $section = $_POST["section"];

    // Prepare the SQL query based on the provided conditions
    $sql = "SELECT * FROM `studentachievements` WHERE MONTH(STR_TO_DATE(fromdate, '%M')) = ? OR YEAR(STR_TO_DATE(fromdate, '%Y')) = ? OR section = ?";
    $stmt = $db->prepare($sql);
    $stmt->execute([$month, $year, $section]);

    $students = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if($students) {
        // Display student records
        ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Student Records</title>
            <style>
                table {
                    border-collapse: collapse;
                    width: 100%;
                }
                th, td {
                    border: 1px solid black;
                    padding: 8px;
                    text-align: left;
                }
                th {
                    background-color: #f2f2f2;
                }
            </style>
        </head>
        <body>
        <div class="table-container">
            <h1>Student Records</h1>
            <table>
                <tr>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Register Number</th>
                    <th>Academic Year</th>
                    <th>Semester</th>
                    <th>Section</th>
                    <th>Technical Event</th>
                    <th>Non-Technical Event</th>
                    <th>Month</th>
                    <th>Year</th>
                    <th>Place of Prize/Participation</th>
                    <th>Name of the Institution</th>
                    <th>Certificate Link (Upload)</th>
                    <th>Company Name-Internship</th>
                    <th>Title of the Training</th>
                    <th>No of Days Attended</th>
                    <th>From Date</th>
                    <th>To Date</th>
                    <th>Certificate Link (Internship)</th>
                </tr>
                <?php foreach($students as $student): ?>
                    <tr>
                        <td><?php echo $student['firstname']; ?></td>
                        <td><?php echo $student['lastname']; ?></td>
                        <td><?php echo $student['registernumber']; ?></td>
                        <td><?php echo $student['academicyear']; ?></td>
                        <td><?php echo $student['semester']; ?></td>
                        <td><?php echo $student['section']; ?></td>
                        <td><?php echo $student['technicalevent']; ?></td>
                        <td><?php echo $student['nontechnicalevent']; ?></td>
                        <td><?php echo $student['month']; ?></td>
                        <td><?php echo $student['year']; ?></td>
                        <td><?php echo $student['prize']; ?></td>
                        <td><?php echo $student['institutename']; ?></td>
                        <td><?php echo $student['certificatelink']; ?></td>
                        <td><?php echo $student['internshipcompany']; ?></td>
                        <td><?php echo $student['trainingtitle']; ?></td>
                        <td><?php echo $student['daysattended']; ?></td>
                        <td><?php echo $student['fromdate']; ?></td>
                        <td><?php echo $student['todate']; ?></td>
                        <td><?php echo $student['internshipcertificate']; ?></td>
                    </tr>
                <?php endforeach; ?>
            </table>
        </div>
        <a href="stuachtesting.php?frommonth=<?php echo $month; ?>&fromyear=<?php echo $year; ?>&section=<?php echo $section; ?>" target="_blank">Download PDF</a>
        </body>
        </html>
        <?php
    } else {
        echo "No student records found within the specified conditions.";
    }
}
?>