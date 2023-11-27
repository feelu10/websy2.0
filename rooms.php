<?php
include 'includes/dbconnect.php'; 
include 'includes/header.php'; 

$query = "SELECT image, description FROM rooms";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Manage Rooms</title>
</head>
<body>
    <h1>Rooms</h1>
    <?php while($row = mysqli_fetch_assoc($result)): ?>
        <div>
            <img src="<?php echo $row['image']; ?>" alt="Room Image">
            <p><?php echo $row['description']; ?></p>
        </div>
    <?php endwhile; ?>
</body>
</html>

<?php include("includes/footer.php"); ?>
