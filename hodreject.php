<?php
// Check if regno is set and not empty
if (isset($_GET['regno']) && !empty($_GET['regno'])) {
    $regno = $_GET['regno'];

    // Database connection
    $conn = mysqli_connect('localhost', 'root', 'root', 'students');

    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Update status in the database to 'Rejected'
    $sql = "UPDATE odapply SET status = 'Rejected' WHERE regno = '$regno'";

    if (mysqli_query($conn, $sql)) {
        echo "Status updated successfully";
    } else {
        echo "Error updating status: " . mysqli_error($conn);
    }

    // Close connection
    mysqli_close($conn);
} else {
    echo "Invalid register number";
}
?>