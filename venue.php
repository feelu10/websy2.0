<?php
include 'includes/dbconnect.php'; // Ensure this path is correct
include 'includes/header.php'; 

// Fetch data from the database
$query = "SELECT image, description FROM venues";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Manage Venue</title>
    <!-- Include additional head tags -->
</head>
<body>
    <h1>Venues</h1>
    <?php while($row = mysqli_fetch_assoc($result)): ?>
        <div>
            <img src="<?php echo $row['image']; ?>" alt="Venue Image">
            <p><?php echo $row['description']; ?></p>
        </div>
    <?php endwhile; ?>
</body>
</html>

<?php include("includes/footer.php"); ?>
