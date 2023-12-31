<?php
// Start session and check user authentication
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'user') {
    header("Location: some_error_page.php", true, 303);
    $_SESSION['message'] = "You can't access this page!";
    $_SESSION['message_type'] = "error";
    exit();
}

// Database connection
include '../includes/dbconnect.php';

// Assuming you have user's login in session
$login = $_SESSION['login'];

// Fetch user data based on login
$query = "SELECT * FROM users WHERE login = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param('s', $login);
$stmt->execute();
$result = $stmt->get_result();
$userData = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
    <link rel="stylesheet" src="../css/style_outsiders.css">
<head>
    <!-- Meta tags, Bootstrap, CSS, Fonts -->
    <title>User Profile</title>
    <!-- Add your stylesheet link here -->
</head>
<body>
<div class="profile-container">
    <div class="profile-photo" onclick="document.getElementById('photoUpload').click()">
        <img id="profileImage" src="img/sample-stamp-vector-16166069.jpg" alt="User Profile Photo" onerror="imageError()">
        <input type="file" id="photoUpload" style="display: none;" onchange="handlePhotoUpload()" accept="image/*">
        <div class="upload-note">Click to upload photo</div>
    </div>
    <button id="removePhotoButton" class="remove-photo-button" onclick="removePhoto()">Remove Photo</button>
    <div class="user-info">
        <h2 id="userName">
            John Doe 
            <span id="statusIndicator" class="status-indicator status-active"></span>
        </h2>
        <div class="status">
            <select id="statusSelect" onchange="setStatus()">
                <option value="Online">Active</option>
                <option value="Idle">Idle</option>
                <option value="Invisible">Invisible</option>
            </select>
            <button onclick="setStatus()">Set Status</button>
        </div>
        <ul class="user-links">
            <li><a href="requested-reservation.html">Requested Reservation</a></li>
            <li><a href="account.html">Account</a></li>
            <li><a href="overall-transaction.html">Overall Transaction</a></li>
        </ul>
    </div>
</div>

<script>
    function setStatus() {
        var selectedStatus = document.getElementById('statusSelect').value;
        var statusIndicatorSpan = document.getElementById('statusIndicator');
        statusIndicatorSpan.className = 'status-indicator ' + selectedStatus.toLowerCase();
    }

    function handlePhotoUpload() {
        var file = document.getElementById('photoUpload').files[0];
        if (file) {
            // Add security checks here for file type, size etc.
            var reader = new FileReader();
            reader.onloadend = function() {
                document.getElementById('profileImage').src = reader.result;
                document.querySelector('.upload-note').style.display = 'none';
                document.getElementById('removePhotoButton').style.display = 'block';
            }
            reader.readAsDataURL(file);
        }
    }

    function removePhoto() {
        document.getElementById('profileImage').src = 'path_to_default_photo.jpg';
        document.querySelector('.upload-note').style.display = 'block';
        document.getElementById('removePhotoButton').style.display = 'none';
    }

    function imageError() {
        document.getElementById('profileImage').style.display = 'none';
        document.getElementById('altText').style.display = 'block';
    }
</script>
</body>
</html>
