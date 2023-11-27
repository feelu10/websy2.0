<?php
session_start();
require '../includes/dbconnect.php';

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    $_SESSION['sweet_alert'] = [
        'type' => 'error',
        'title' => "Access Denied",
        'text' => "You can't access this page!"
    ];
    header("Location: ../index.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = $_POST['user_id'];
    $new_role = $_POST['new_role'];

    // Update the user's role in the database
    $update_query = "UPDATE users SET role = '$new_role' WHERE id = $user_id";
    $update_result = mysqli_query($conn, $update_query);

    if ($update_result) {
        // Successful role update
        $_SESSION['sweet_alert'] = [
            'type' => 'success',
            'title' => "Success",
            'text' => "User role updated successfully!"
        ];
    } else {
        // Failed role update
        $_SESSION['sweet_alert'] = [
            'type' => 'error',
            'title' => "Error",
            'text' => "Error updating user role: " . mysqli_error($conn)
        ];
    }

    // Delay the redirect by 2 seconds
    sleep(2);

    header("Location: dashboard.php?faculty=users");
} else {
    // Redirect if not a POST request
    $_SESSION['sweet_alert'] = [
        'type' => 'error',
        'title' => "Error",
        'text' => "Invalid request method!"
    ];
    header("Location: dashboard.php?faculty=users");
}
?>
