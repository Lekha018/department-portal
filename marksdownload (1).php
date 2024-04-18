<?php
// Include the TCPDF library
require_once('tcpdf/tcpdf.php');

// Establish database connection
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "form";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if reg_no parameter is provided in the URL
if(isset($_GET['reg_no'])) {
    // Retrieve the register number from the URL parameter
    $reg_no = $_GET['reg_no'];

   // Fetch student's name and register number from the database based on the register number
   $sql_student = "SELECT * FROM admin WHERE reg_no = '$reg_no'";
   $result_student = $conn->query($sql_student);
   $row_student = $result_student->fetch_assoc();
   $student_name = $row_student['first_name']. " " . $row_student['last_name'];

   $result = $conn->query($sql_student);

// Check for errors in the query
if (!$result) {
    die("Error executing query: " . $conn->error);
}

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
    $pdf->Cell(0, 10, 'Name: ' . $student_name, 0, 1, 'L');
    $pdf->Cell(0, 10, 'Register Number: ' . $reg_no, 0, 1, 'L');

    // Add a spacer
    $pdf->Ln(10);

    // Set font for table headers
    $pdf->SetFont('helvetica', '', 15);

    // Output marks data in PDF format
    if ($result->num_rows > 0) {
        $content = '<table border="1" style="border-collapse: collapse; width: 100%;">';
        $content .= '<tr><th style="padding: 10px;">Subject</th><th style="padding: 10px;">Internal Assessment 1</th><th style="padding: 10px;">Internal Assessment 2</th><th style="padding: 10px;">Model Examination</th></tr>';

        // Output marks data row by row
        while($row = $result->fetch_assoc()) {
            // Output marks for each subject
            $content .= '<tr>';
            $content .= '<td style="padding: 15px; text-align: center;">Compiler Design</td>';
            $content .= '<td style="padding: 15px; text-align: center;">' . ($row['marks_subject1'] != 0 ? $row['marks_subject1'] : '-')  . '</td>';
            $content .= '<td style="padding: 15px; text-align: center;">' . ($row['sub1'] != 0 ? $row['sub1'] : '-') . '</td>';
            $content .= '<td style="padding: 15px; text-align: center;">' . ($row['s1'] != 0 ? $row['s1'] : '-') . '</td>';
            $content .= '</tr>';
            
            $content .= '<tr style="padding: 10px; text-align: center;">';
            $content .= '<td style="padding: 10px; text-align: center;">Cryptography and Network Analysis</td>';
            $content .= '<td style="padding: 10px; text-align: center;">' . ($row['marks_subject2'] != 0 ? $row['marks_subject2'] : '-') . '</td>';
            $content .= '<td style="padding: 10px; text-align: center;">' . ($row['sub2'] != 0 ? $row['sub2'] : '-') . '</td>';
            $content .= '<td style="padding: 10px; text-align: center;">' . ($row['s2'] != 0 ? $row['s2'] : '-') . '</td>';
            $content .= '</tr>';

            $content .= '<tr>';
            $content .= '<td style="padding: 15px; text-align: center;">Machine Learning</td>';
            $content .= '<td style="padding: 15px; text-align: center;">' . ($row['marks_subject3'] != 0 ? $row['marks_subject3'] : '-') . '</td>';
            $content .= '<td style="padding: 15px; text-align: center;">' . ($row['sub3'] != 0 ? $row['sub3'] : '-') . '</td>';
            $content .= '<td style="padding: 15px; text-align: center;">' . ($row['s3'] != 0 ? $row['s3'] : '-') . '</td>';
            $content .= '</tr>';

            $content .= '<tr>';
            $content .= '<td style="padding: 15px; text-align: center;">Internet of Things</td>';
            $content .= '<td style="padding: 15px; text-align: center;">' . ($row['marks_subject4'] != 0 ? $row['marks_subject4'] : '-') . '</td>';
            $content .= '<td style="padding: 15px; text-align: center;">' . ($row['sub4'] != 0 ? $row['sub4'] : '-') . '</td>';
            $content .= '<td style="padding: 15px; text-align: center;">' . ($row['s4'] != 0 ? $row['s4'] : '-') . '</td>';
            $content .= '</tr>';

            $content .= '<tr>';
            $content .= '<td style="padding: 10px; text-align: center;">Google Cloud Computing</td>';
            $content .= '<td style="padding: 10px; text-align: center;">' . ($row['marks_subject5'] != 0 ? $row['marks_subject5'] : '-') . '</td>';
            $content .= '<td style="padding: 10px; text-align: center;">' . ($row['sub5'] != 0 ? $row['sub5'] : '-') . '</td>';
            $content .= '<td style="padding: 10px; text-align: center;">' . ($row['s5'] != 0 ? $row['s5'] : '-') . '</td>';
            $content .= '</tr>';
            
            // Similarly, repeat for other subjects (3, 4, 5)
        }
    
        $content .= '</table>';
    
        // Write HTML content to PDF
        $pdf->writeHTML($content, true, false, true, false, '');
    } else {
        $pdf->Cell(0, 10, 'No marks data found for the given register number.', 0, 1);
    }
    
    // Set font for the footer
    $pdf->SetFont('helvetica', 'I', 15);

    // Fetch the institution address
    $institution_address = 'R.S.M. Nagar, Puduvoyal-601 206, Gummidipondi Taluk, Thiruvallur Dist. Phone:91 44-6790 0679, Fax:91 44-6790 0611. www.rmkcet.ac.in, email:principal@rmkcet.ac.in';

    // Output the footer content in three lines
    $pdf->Ln(40);
    $pdf->Ln(20);
    $pdf->Ln(30);
    $pdf->Ln(20);
    $pdf->Line($pdf->GetX(), $pdf->GetY(), $pdf->GetX() + 210, $pdf->GetY());
    $pdf->Ln(10);
    $pdf->Cell(0, 5, 'R.S.M. Nagar, Puduvoyal-601 206, Gummidipondi Taluk,', 0, 1, 'C');
    $pdf->Cell(0, 5, 'Thiruvallur Dist. Phone:91 44-6790 0679, Fax:91 44-6790 0611.', 0, 1, 'C');
    $pdf->Cell(0, 5, 'www.rmkcet.ac.in, email:principal@rmkcet.ac.in', 0, 1, 'C');

    // Close and output PDF document
    $pdf->Output('marks_report.pdf', 'D');
} else {
    // If reg_no parameter is not provided in the URL
    echo "Register number parameter is missing in the URL.";
}

// Close database connection
$conn->close();
?>
