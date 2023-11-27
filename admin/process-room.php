<?php
require '../includes/dbconnect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $roomName = $_POST['roomName'];
    $roomDescription = $_POST['roomDescription'];

    // File upload handling
    $imagePath = null;
    if (isset($_FILES["roomImage"]) && $_FILES["roomImage"]["error"] == 0) {
        $imagePath = "uploads/" . basename($_FILES["roomImage"]["name"]);
        move_uploaded_file($_FILES["roomImage"]["tmp_name"], $imagePath);
    }

    // Insert room into 'rooms' table
    $insertRoomQuery = "INSERT INTO `rooms` (`name`, `description`, `image_path`) VALUES ('$roomName', '$roomDescription', '$imagePath')";
    mysqli_query($conn, $insertRoomQuery);

    mysqli_close($conn);

    // Redirect with a 2-second delay
    echo '<meta http-equiv="refresh" content="2;url=dashboard.php?faculty=addroom">';
} else {
    header("Location:dashboard.php?faculty=addroom");
}
?>
