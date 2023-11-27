<?php
require '../includes/dbconnect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if the status array is set in the POST data
    if (isset($_POST['status']) && is_array($_POST['status'])) {
        foreach ($_POST['status'] as $reservationId => $status) {
            // Assuming that the status can only be 'confirmed' or 'rejected'
            $status = mysqli_real_escape_string($conn, $status);
            $reservationId = intval($reservationId);
            $updateStatusQuery = "UPDATE `reservations` SET `status` = '$status' WHERE `id` = $reservationId";
            mysqli_query($conn, $updateStatusQuery);
        }
    }

    header("Location: pending-reservation.php");
    exit();
} else {
    header("Location: ../index.php");
    $_SESSION['message'] = "Invalid access!";
    $_SESSION['message_type'] = 'error';
    exit();
}
?>
