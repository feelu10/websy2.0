<?php
include '../includes/dbconnect.php';

// Check if roomId is set
if (isset($_POST['roomId'])) {
    $roomId = mysqli_real_escape_string($conn, $_POST['roomId']);

    // SQL query to fetch room data
    $query = "SELECT * FROM rooms WHERE id = $roomId";
    $result = mysqli_query($conn, $query);

    if ($result) {
        // Fetch room data
        $roomData = mysqli_fetch_assoc($result);

        // Display room image path
        if ($roomData && isset($roomData['image_path'])) {
            // Concatenate the image path
            $imagePath = "../admin/" . $roomData['image_path'];

            echo $imagePath;
        } else {
            echo "N/A";
        }

    } else {
        echo "Error executing the query: " . mysqli_error($conn);
    }
} else {
    echo "Room ID not set.";
}
?>