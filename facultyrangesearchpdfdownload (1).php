<?php
// Database connection
$dsn = "mysql:host=localhost;dbname=reg";
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
    // Retrieve the start and end dates provided by the user
    $coursefromdate = $_POST["coursefromdate"];
    $coursetodate = $_POST["coursetodate"];

    // Query to search for faculty records within the specified date range (evaluating month and year only)
    $stmt = $db->prepare("SELECT * FROM `facultyrangeachievements` WHERE DATE_FORMAT(STR_TO_DATE(coursefromdate, '%M-%d-%Y'), '%Y-%m') >= DATE_FORMAT(STR_TO_DATE(?, '%M-%d-%Y'), '%Y-%m') AND DATE_FORMAT(STR_TO_DATE(coursetodate, '%M-%d-%Y'), '%Y-%m') <= DATE_FORMAT(STR_TO_DATE(?, '%M-%d-%Y'), '%Y-%m')");
    $stmt->execute([$coursefromdate, $coursetodate]);

    $faculties = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if($faculties) {
        // Generate PDF
        require_once('tcpdf/tcpdf.php');

        // Create a new PDF document
        $pdf = new TCPDF();

        // Set document information
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('Your Name');
        $pdf->SetTitle('Faculty Achievements Report');
        $pdf->SetSubject('Faculty Achievements');
        $pdf->SetKeywords('TCPDF, PDF, database, PHP');

        // Add a page
        $pdf->AddPage();

        // Add title and address
        $html = '<h1 style="text-align:center;"><b>R.M.K COLLEGE OF ENGINEERING AND TECHNOLOGY</b></h1>';
        $html .= '<h2 style="text-align:center;"><b>(AN AUTONOMOUS INSTITUTION)</b></h2>';
        $html .= '<p style="text-align:center;"><b>R.S.M Nagar, Puduvoyal, Gummidipoondi Taluk, Thiruvallur District - 601206</b></p>';

        // Display heading above the table including coursefromdate and coursetodate
        $heading = 'Faculty Achievements Report - Course from ' . $coursefromdate . ' to ' . $coursetodate;
        $html .= '<h1 style="text-align:center;">' . $heading . '</h1>';

        // Construct HTML table
        $html .= '<table border="1">';
        $html .= '<thead>'; // Add thead element for table heading
        $html .= '<tr>';
        $html .= '<th style="text-align:center;">First Name</th>'; // Center align text
        $html .= '<th style="text-align:center;">Last Name</th>'; // Center align text
        $html .= '<th style="text-align:center;">Faculty Id</th>'; // Center align text
        $html .= '<th style="text-align:center;">Department</th>'; // Center align text
        $html .= '<th style="text-align:center;">Courses and Certification</th>'; // Center align text
        $html .= '<th style="text-align:center;">Journal Paper</th>'; // Center align text
        $html .= '<th style="text-align:center;">Conference Paper</th>'; // Center align text
        $html .= '<th style="text-align:center;">Awards</th>'; // Center align text
        $html .= '<th style="text-align:center;">Course From Date</th>'; // Center align text
        $html .= '<th style="text-align:center;">Course To Date</th>'; // Center align text
        $html .= '</tr>';
        $html .= '</thead>';
        $html .= '<tbody>'; // Add tbody element for table body

        foreach($faculties as $faculty) {
            $html .= '<tr>';
            $html .= '<td style="text-align:center;">' . $faculty['first_name'] . '</td>'; // Center align text
            $html .= '<td style="text-align:center;">' . $faculty['last_name'] . '</td>'; // Center align text
            $html .= '<td style="text-align:center;">' . $faculty['reg_no'] . '</td>'; // Center align text
            $html .= '<td style="text-align:center;">' . $faculty['dept'] . '</td>'; // Center align text
            $html .= '<td style="text-align:center;">' . $faculty['coursesandcertification'] . '</td>'; // Center align text
            $html .= '<td style="text-align:center;">' . $faculty['journalpaper'] . '</td>'; // Center align text
            $html .= '<td style="text-align:center;">' . $faculty['conferencepaper'] . '</td>'; // Center align text
            $html .= '<td style="text-align:center;">' . $faculty['awards'] . '</td>'; // Center align text
            $html .= '<td style="text-align:center;">' . $faculty['coursefromdate'] . '</td>'; // Center align text
            $html .= '<td style="text-align:center;">' . $faculty['coursetodate'] . '</td>'; // Center align text
            $html .= '</tr>';
        }

        $html .= '</tbody>'; // Close tbody element
        $html .= '</table>';

        // Write HTML table to PDF
        $pdf->writeHTML($html, true, false, true, false, '');

        // Set filename including coursefromdate and coursetodate
        $filename = "faculty_achievements_" . $coursefromdate . "_to_" . $coursetodate . "_report.pdf";

        // Set appropriate headers for PDF download
        header('Content-Type: application/pdf');
        header('Content-Disposition: attachment; filename="' . $filename . '"');

        // Output the PDF content
        echo $pdf->Output($filename, 'D'); // 'D' parameter forces download
    } else {
        echo "No faculty records found within the specified date range.";
    }
}
?>






