<?php
// Start session if not already started
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Check if user is not logged in
if (!isset($_SESSION['login']) || !$_SESSION['login']) {
    header('Location: connection.php');
    exit(); // Ensure that the script stops here after redirection
}

include '../includes/dbconnect.php';

// Assuming you have a database connection, you can fetch reservation data with user information
$userId = $_SESSION['id']; // Assuming you store user ID in the session

try {
    // Replace the following query with your actual query
    $query = "SELECT reservations.*, CONCAT(users.firstname, ' ', users.lastname) AS user_fullname
              FROM reservations
              JOIN users ON reservations.id_student = users.id
              WHERE id_student = ?";
    
    $stmt = $conn->prepare($query);
    $stmt->bind_param('i', $userId); // 'i' indicates an integer type
    $stmt->execute();
    
    $result = $stmt->get_result();
    $reservations = $result->fetch_all(MYSQLI_ASSOC);
} catch (mysqli_sql_exception $e) {
    echo "Error: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservation Data</title>
    <style>
        /* Add your styling for the table here */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>

<?php if (!empty($reservations)): ?>
    <table>
        <thead>
            <tr>
                <th>Title</th>
                <th>Description</th>
                <th>Start Time</th>
                <th>End Time</th>
                <th>Status</th>
                <th>User Full Name</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($reservations as $reservation): ?>
                <tr>
                    <td><?php echo $reservation['title']; ?></td>
                    <td><?php echo $reservation['description']; ?></td>
                    <td><?php echo $reservation['debut']; ?></td>
                    <td><?php echo $reservation['end']; ?></td>
                    <td><?php echo $reservation['status']; ?></td>
                    <td><?php echo $reservation['user_fullname']; ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php else: ?>
    <p>No reservations found.</p>
<?php endif; ?>

</body>
</html>
