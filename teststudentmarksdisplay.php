<?php
session_start(); // Start the session

// Assuming you have collected the batch and examination details from the form
$batch = isset($_POST['batch']) ? $_POST['batch'] : '';
$semester = isset($_POST['sem']) ? $_POST['sem'] : '';
$regno = isset($_POST['reg_no']) ? $_POST['reg_no'] : '';
$examination = isset($_POST['exam']) ? $_POST['exam'] : '';

if (!empty($batch) && !empty($examination)) {
    // Adjusting batch format to match database naming convention
    $batch_start_year = substr($batch, 0, 4);
    $batch_end_year = substr($batch, 5);
    $next_year = (int)$batch_start_year + 1;
    $database_suffix = $next_year . '_' . $batch_end_year;

    // Construct database name and marks table name based on batch and examination
    $database_name = $batch;
    $marks_table_name = $examination;

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

    $sql_query_subjects = "SELECT sub_name FROM subject WHERE sem_id = '$semester'";
    $result_subjects = $conn->query($sql_query_subjects);

    if ($result_subjects->num_rows > 0) {
        // Subjects found for the specified semester
        $subjects = array();
        while ($row = $result_subjects->fetch_assoc()) {
            $subjects[] = $row['sub_name'];
        }

        // Constructing the SQL query to fetch marks for the specified examination type
        $marks_table_name = $examination;
        $column_names = implode(", ", array_map(function($subject) { return "`$subject`"; }, $subjects));
        $sql_query_marks = "SELECT NAME, `REGISTER NUMBER`, $column_names FROM $marks_table_name WHERE `REGISTER NUMBER` = $regno";
        
        $result_marks = $conn->query($sql_query_marks);
        
        $html_content = '';
        if ($result_marks->num_rows > 0) {
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
            $html_content .= "<h2>Student Marks</h2>";
            $html_content .= "<table>";
            $html_content .= "<tr>";
            $html_content .= "<th>Name</th>";
            $html_content .= "<th>Register Number</th>";
            foreach ($subjects as $subject) {
                $html_content .= "<th>$subject</th>";
            }
            $html_content .= "</tr>";
            while ($row = $result_marks->fetch_assoc()) {
                $html_content .= "<tr>";
                $html_content .= "<td>{$row['NAME']}</td>";
                $html_content .= "<td>{$row['REGISTER NUMBER']}</td>";
                foreach ($subjects as $subject) {
                    $html_content .= "<td>{$row[$subject]}</td>";
                }
                $html_content .= "</tr>";
            }
            $html_content .= "</table>";
            // Store HTML content in a session variable
            $_SESSION['pdf_content'] = $html_content;
            // Redirect to the download page
            header("Location: testmarkdownload1.php?database=" . urlencode($database_name) . "&table=" . urlencode($marks_table_name) . "&reg_no=" . urlencode($regno));
            exit(); // Stop execution after redirection
        } else {
            echo "No results found";
        }
    } else {
        echo "No subjects found for the specified semester";
    }

    // Closing the database connection
    $conn->close();
} else {
    echo "Please select semester and examination type";
}
?>
