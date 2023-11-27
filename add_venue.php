<?php
include 'includes/dbconnect.php'; // Ensure this path is correct

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if file was uploaded without errors
    if (isset($_FILES["image"]) && $_FILES["image"]["error"] == 0) {
        $allowed = ["jpg" => "image/jpg", "jpeg" => "image/jpeg", "gif" => "image/gif", "png" => "image/png"];
        $filename = $_FILES["image"]["name"];
        $filetype = $_FILES["image"]["type"];
        $filesize = $_FILES["image"]["size"];
    
        // Verify file extension
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        if (!array_key_exists($ext, $allowed)) die("Error: Please select a valid file format.");
    
        // Verify file size - 5MB maximum
        $maxsize = 5 * 1024 * 1024;
        if ($filesize > $maxsize) die("Error: File size is larger than the allowed limit.");

        // Verify MYME type of the file
        if (in_array($filetype, $allowed)) {
            // Check whether file exists before uploading it
            if (file_exists("uploads/" . $filename)) {
                echo $filename . " is already exists.";
            } else {
                move_uploaded_file($_FILES["image"]["tmp_name"], "uploads/" . $filename);
                echo "Your file was uploaded successfully.";
                
                // Add to database
                $description = mysqli_real_escape_string($conn, $_POST['description']);
                $imagePath = "uploads/" . $filename;
                
                $sql = "INSERT INTO venues (image, description) VALUES ('$imagePath', '$description')";
                if (mysqli_query($conn, $sql)) {
                    echo "New record created successfully";
                } else {
                    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                }
            } 
        } else {
            echo "Error: There was a problem uploading your file. Please try again."; 
        }
    } else {
        echo "Error: " . $_FILES["image"]["error"];
    }
}
?>




<!DOCTYPE html>
<html>
<head>
    <title>Add Venue</title>
</head>
<body>
    <h2>Add New Venue</h2>
    <form action="add_venue.php" method="post" enctype="multipart/form-data">
        <label for="image">Image:</label>
        <input type="file" name="image" id="image">
        <label for="description">Description:</label>
        <textarea name="description" id="description"></textarea>
        <input type="submit" value="Upload">
    </form>
</body>
</html>
