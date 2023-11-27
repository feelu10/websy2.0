<?php
// Include your database connection file
include '../includes/dbconnect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve user ID and current status from the POST request
    $userId = $_POST['userId'];
    $currentStatus = $_POST['currentStatus'];

    // Determine the new status
    $newStatus = ($currentStatus === 'available') ? 'naavailable' : 'available';

    // Check if the status needs to be updated
    if ($currentStatus !== $newStatus) {
        try {
            // Update the user's status in the database
            $updateQuery = "UPDATE users SET status = ? WHERE login = ?";
            $updateStmt = $conn->prepare($updateQuery);
            $updateStmt->bind_param('ss', $newStatus, $userId);  
            $updateStmt->execute();

            // Redirect back to student_reservation.php
            header('Location: dashboard.php?faculty=profiles');
            exit();  // Ensure that the script stops here after redirection
        } catch (mysqli_sql_exception $e) {
            echo "Error: " . $e->getMessage();
        }
    } else {
        echo "Status is already " . ucfirst($newStatus);
    }
} else {
    // Handle invalid requests (GET requests, etc.)
    http_response_code(400);
    echo "Invalid request";
}
var_dump($userId);
var_dump($updateStmt);
var_dump($newStatus);
?>
