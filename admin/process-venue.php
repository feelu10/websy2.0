<?php
require '../includes/dbconnect.php'; // Include your database connection file

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $venueName = mysqli_real_escape_string($conn, $_POST['venueName']);
    $venueDescription = mysqli_real_escape_string($conn, $_POST['venueDescription']);

    // File upload handling
    $targetDirectory = "uploads/";
    $targetFile = $targetDirectory . basename($_FILES["image"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

    // Check if the file is an actual image
    if (isset($_POST["submit"])) {
        $check = getimagesize($_FILES["image"]["tmp_name"]);
        if ($check === false) {
            echo "Error: File is not an image.";
            $uploadOk = 0;
        }
    }

    // Check file size
   // Check file size
   if ($_FILES["image"]["size"] > 5 * 1024 * 1024) {
    echo "Error: File size exceeds the limit.";
    $uploadOk = 0;
}

// Allow only certain file formats
$allowedExtensions = array("jpg", "jpeg", "png", "gif");
if (!in_array($imageFileType, $allowedExtensions)) {
    echo "Error: Only JPG, JPEG, PNG, and GIF files are allowed.";
    $uploadOk = 0;
}

if ($uploadOk == 0) {
    echo "Error: Your file was not uploaded.";
} else {
    // If everything is ok, try to upload the file
    if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile)) {
        echo "The file " . htmlspecialchars(basename($_FILES["image"]["name"])) . " has been uploaded successfully.";

        // Insert venue into 'venues' table with the associated image, name, and description
        $insertVenueQuery = "INSERT INTO `venues` (`image`, `name`, `description`) VALUES ('$targetFile', '$venueName', '$venueDescription')";
        mysqli_query($conn, $insertVenueQuery);

        mysqli_close($conn); // Close the database connection

        // Redirect with a 2-second delay
        echo '<meta http-equiv="refresh" content="2;url=dashboard.php?faculty=addvenue">';
    } else {
        echo "Error: There was an error uploading your file.";
    }
}
} else {
// Redirect if not a POST request
header("Location:dashboard.php?faculty=addvenue");
}
?>