<?php
// Include the TCPDF library
require_once('tcpdf/tcpdf.php');

// Start the session
session_start();

// Check if database name, table name, and register number parameters are provided in the URL
if(isset($_GET['database']) && isset($_GET['table']) && isset($_GET['reg_no'])) {
    // Retrieve the database name, table name, and register number from the URL parameters
    $database_name = $_GET['database'];
    $table_name = $_GET['table'];
    $reg_no = $_GET['reg_no'];

    $servername = "localhost";
    $username = "root";
    $password = "root";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $database_name);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Fetch HTML content from session
    if(isset($_SESSION['pdf_content'])) {
        $html_content = $_SESSION['pdf_content'];

        // Create new PDF instance
        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

        // Set document information
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('Your Name');
        $pdf->SetTitle('Marks Report');
        $pdf->SetSubject('Marks Report');

        // Add a page
        $pdf->AddPage();

        // Set font
        $pdf->SetFont('helvetica', 'B', 20);

        // Output college name and logo
        $pdf->Image('C:/wamp64/www/GOOGLE/rmkcet.png', 7, 9, 15, '', '', '', '', false, 300, '', false, false, 0, false, false, false);
        $pdf->Cell(0, 10, 'R.M.K College of Engineering and Technology', 0, 1, 'C');

        // Add a spacer
        $pdf->Ln(15);

        // Set font for table headers
        $pdf->SetFont('helvetica', '', 15);

        // Output student's name and register number
        // This assumes that you have already obtained the student's name in the previous code
        // Retrieve the student's name from the database based on the register number
$sql_student = "SELECT NAME FROM $table_name WHERE `REGISTER NUMBER` = '$reg_no'";
$result_student = $conn->query($sql_student);

if ($result_student->num_rows > 0) {
    $row_student = $result_student->fetch_assoc();
    $student_name = $row_student['NAME'];
} else {
    $student_name = "Unknown"; // Set a default name if not found in the database
}

        $pdf->Cell(0, 10, 'Name: ' . $student_name, 0, 1, 'L');
        $pdf->Cell(0, 10, 'Register Number: ' . $reg_no, 0, 1, 'L');

        // Add a spacer
        $pdf->Ln(10);

        // Set font for table headers
        $pdf->SetFont('helvetica', '', 15);

        // Output marks data in PDF format
        // Write HTML content to PDF
        $pdf->writeHTML($html_content, true, false, true, false, '');

        // Close and output PDF document
        $pdf->Output('marks_report.pdf', 'D');
    } else {
        // If HTML content is not found in session
        echo "HTML content not found in session.";
    }
} else {
    // If database name, table name, or register number parameter is missing in the URL
    echo "Database name, table name, or register number parameter is missing in the URL.";
}
?>
