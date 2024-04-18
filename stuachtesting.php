<?php
// Enable error reporting
error_reporting(E_ALL);

// Include the TCPDF library
require_once('tcpdf/tcpdf.php');

// Database connection
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "students";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve the data from the form
    $academicyear = $_POST['academicyear'];
    $semester = $_POST['semester'];
    $section = $_POST['section'];
    $frommonth = $_POST['frommonth'];
    $fromyear = $_POST['fromyear'];
    $tomonth = $_POST['tomonth'];
    $toyear = $_POST['toyear'];

    // Prepare the SQL query
    $sql = "SELECT * FROM `studentachievements` WHERE YEAR(STR_TO_DATE(fromdate, '%Y')) >= ? AND YEAR(STR_TO_DATE(fromdate, '%Y')) <= ? AND MONTH(STR_TO_DATE(fromdate, '%M')) >= ? AND MONTH(STR_TO_DATE(fromdate, '%M')) <= ? AND semester = ? AND section = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssss", $fromyear, $toyear, $frommonth, $tomonth, $semester, $section);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if there are any results
    if ($result->num_rows > 0) {
        // Debugging statement
        echo "PDF generation started...";

        // Create new PDF instance
        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

        // Set document information
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('Your Name');
        $pdf->SetTitle('Student Achievements Report');
        $pdf->SetSubject('Student Achievements Report');

        // Add a page
        $pdf->AddPage();

        // Set font
        $pdf->SetFont('helvetica', 'B', 20);

        // Output heading
        $pdf->Cell(0, 10, 'Student Achievements Report', 0, 1, 'C');

        // Add a spacer
        $pdf->Ln(10);

        // Set font for table headers
        $pdf->SetFont('helvetica', '', 12);

        // Output table headers
        $pdf->Cell(30, 10, 'First Name', 1, 0, 'C');
        $pdf->Cell(30, 10, 'Last Name', 1, 0, 'C');
        $pdf->Cell(30, 10, 'Register Number', 1, 0, 'C');
        // Add more headers as needed

        // Output student achievements data
        while ($row = $result->fetch_assoc()) {
            $pdf->Ln();
            $pdf->Cell(30, 10, $row['firstname'], 1, 0, 'C');
            $pdf->Cell(30, 10, $row['lastname'], 1, 0, 'C');
            $pdf->Cell(30, 10, $row['registernumber'], 1, 0, 'C');
            // Add more data cells as needed
        }

        // Close and output PDF document
        $pdf->Output('student_achievements_report.pdf', 'D');

        // Debugging statement
        echo "PDF generation completed.";
    } else {
        echo "No records found for the specified criteria.";
    }
}

// Close database connection
$conn->close();
?>