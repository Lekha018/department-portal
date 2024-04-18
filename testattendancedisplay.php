<?php
session_start(); // Start the session

// Retrieve input values from the form
$batch = isset($_POST['batch']) ? $_POST['batch'] : '';
$semester = isset($_POST['sem']) ? $_POST['sem'] : '';
$month = isset($_POST['month']) ? $_POST['month'] : null;

if (!empty($batch) && !empty($semester) && !is_null($month)) {
    // Adjusting batch format to match database naming convention
    $batch_start_year = substr($batch, 0, 4);
    $batch_end_year = substr($batch, 5);
    $next_year = (int)$batch_start_year + 1;
    $database_suffix = $next_year . '_' . $batch_end_year;

    // Construct database name and marks table name based on batch and examination
    $database_name = $batch;
    $table = "attendance";

    // Establishing a database connection
    $servername = "localhost";
    $username = "root";
    $password = "root";
    $database = $database_name;

    $conn = new mysqli($servername, $username, $password, $database);

    // Checking the connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Sanitize input
    $month = $conn->real_escape_string($month);

    // Construct the SQL query to retrieve attendance for the specified month
    $sql_query_marks = "SELECT NAME, `REGISTER NUMBER`, `$month` FROM `attendance`";

    // Execute the query
    $result_marks = $conn->query($sql_query_marks);

    // Close the database connection
    $conn->close();

    // Fetch and process the results
    if ($result_marks->num_rows > 0) {
        // Store year, semester, and month in session variables
        $_SESSION['year'] = $batch;
        $_SESSION['semester'] = $semester;
        $_SESSION['month'] = $month;

        // Store HTML content for the table
        $html_content = '';
        $html_content .= "<style>
            table {
                border-collapse: collapse;
                width: 100%;
            }
            th, td {
                border: 1px solid #dddddd;
                text-align: left;
                padding: 8px;
            }
            th {
                font-size: 11px; /* Adjust font size for table headers */
            }
            td {
                font-size: 9px; /* Adjust font size for table cells */
            }
            tr:nth-child(even) {
                background-color: #f2f2f2;
            }
        </style>";
        $html_content .= "<h2>Student Attendance for $month</h2>";
        $html_content .= "<p>Year: $batch</p>";
        $html_content .= "<p>Semester: $semester</p>";
        $html_content .= "<table>";
        // Add table header and rows with data
        while ($row = $result_marks->fetch_assoc()) {
            $html_content .= "<tr>";
            $html_content .= "<td>" . $row['NAME'] . "</td>";
            $html_content .= "<td>" . $row['REGISTER NUMBER'] . "</td>";
            $html_content .= "<td>" . $row[$month] . "</td>";
            $html_content .= "</tr>";
        }
        $html_content .= "</table>";

        // Store HTML content in a session variable
        $_SESSION['pdf_content'] = $html_content;
        // Redirect to the download page
        header("Location: testattendancedownload.php?database=" . urlencode($database_name) . "&table=" . urlencode($table) . "&month=" . urlencode($month));
        exit(); // Stop execution after redirection
    } else {
        echo "No attendance data found for the selected month.";
    }
} else {
    echo "Please select semester, examination type, and month.";
}
?>
