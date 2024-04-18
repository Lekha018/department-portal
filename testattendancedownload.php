<?php
// Include the TCPDF library
require_once('tcpdf/tcpdf.php');

// Start the session
session_start();

// Check if database name, table name, and month parameters are provided in the URL
if(isset($_GET['database']) && isset($_GET['table']) && isset($_GET['month'])) {
    // Retrieve the database name, table name, and month from the URL parameters
    $database_name = $_GET['database'];
    $table_name = $_GET['table'];
    $month = $_GET['month'];

    $servername = "localhost";
    $username = "root";
    $password = "root";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $database_name);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Fetch data from the database for the specified month
    $sql = "SELECT NAME, `REGISTER NUMBER`, `$month` FROM $table_name";
    $result = $conn->query($sql);

    // Create a new PDF instance
    $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

    // Set document information
    $pdf->SetCreator(PDF_CREATOR);
    $pdf->SetAuthor('Your Name');
    $pdf->SetTitle('Attendance Report');
    $pdf->SetSubject('Attendance Report');

    // Add a page
    $pdf->AddPage();

    // Set font
    $pdf->SetFont('helvetica', '', 10);

    // Add a table
    $html = '<table border="1">';
    $html .= '<tr><th>Name</th><th>Register Number</th><th>'.$month.'</th></tr>';

    // Loop through each row of the result set
    while($row = $result->fetch_assoc()) {
        // Output the student data
        $html .= '<tr>';
        $html .= '<td>' . $row['NAME'] . '</td>';
        $html .= '<td>' . $row['REGISTER NUMBER'] . '</td>';
        $html .= '<td>' . $row[$month] . '</td>';
        $html .= '</tr>';
    }

    $html .= '</table>';

    // Write the HTML content to the PDF
    $pdf->writeHTML($html, true, false, true, false, '');

    // Close connection
    $conn->close();

    // Output PDF document
    $pdf->Output('attendance_report.pdf', 'D');
} else {
    // If database name, table name, or month parameter is missing in the URL
    echo "Database name, table name, or month parameter is missing in the URL.";
}
?>
