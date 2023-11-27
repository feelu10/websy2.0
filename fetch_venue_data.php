<?php
include 'includes/dbconnect.php';

// Check if venueId is set
if (isset($_POST['venueId'])) {
    // Sanitize and validate input
    $venueId = mysqli_real_escape_string($conn, $_POST['venueId']);

    // SQL query to fetch venue data
    $query = "SELECT * FROM venues WHERE id = $venueId"; // Fix the typo here
    $result = mysqli_query($conn, $query);

    if ($result) {
        // Fetch venue data
        $venueData = mysqli_fetch_assoc($result);

        // Display venue image path
        if ($venueData && isset($venueData['image_path'])) {
            // Concatenate the image path
            $imagePath = "admin/" . $venueData['image_path'];

            echo $imagePath;
        } else {
            echo "N/A";
        }
    } else {
        echo "Error executing the query: " . mysqli_error($conn);
    }
} else {
    echo "Venue ID not set.";
}
?>