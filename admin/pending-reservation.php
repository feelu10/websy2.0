<?php
require '../includes/dbconnect.php';

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../index.php");
    $_SESSION['message'] = "You can't access this page!";
    $_SESSION['message_type'] = 'error';
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pending Reservations</title>
    <link rel="stylesheet" href="css/pending.css">
</head>

<body>

    <div class="container">
        <h1 class="mb-4">Pending Reservations</h1>

        <?php
        if (isset($_SESSION['login'])) {

            // Fetch all reservations with a status of 'pending' and include user's name and role
            $fetchPendingReservationsQuery = "SELECT r.id, r.title, r.description, r.debut, r.end, r.status, u.login, u.role
                FROM `reservations` AS r
                JOIN `users` AS u ON r.id_users = u.id
                WHERE r.status = 'pending'";
                
            $pendingReservationsResult = mysqli_query($conn, $fetchPendingReservationsQuery);

            if (mysqli_num_rows($pendingReservationsResult) > 0) {
                // Display pending reservations
                echo '<div class="table-responsive">';
                echo '<form method="post" action="update_status.php" id="status-form">'; // Assuming the update_status.php file handles form submission
                echo '<table class="table table-bordered table-striped table-hover">';
                echo '<thead class="thead-dark">';
                echo '<tr>';
                echo '<th scope="col">Title</th>';
                echo '<th scope="col">Description</th>';
                echo '<th scope="col">Start Time</th>';
                echo '<th scope="col">End Time</th>';
                echo '<th scope="col">User</th>';
                echo '<th scope="col">Role</th>';
                echo '<th scope="col">Status</th>';
                echo '<th scope="col">Action</th>';
                echo '</tr>';
                echo '</thead>';
                echo '<tbody>';

                while ($reservation = mysqli_fetch_assoc($pendingReservationsResult)) {
                    echo '<tr>';
                    echo '<td>' . $reservation['title'] . '</td>';
                    echo '<td>' . $reservation['description'] . '</td>';
                    echo '<td>' . $reservation['debut'] . '</td>';
                    echo '<td>' . $reservation['end'] . '</td>';
                    echo '<td>' . $reservation['login'] . '</td>';
                    echo '<td>' . $reservation['role'] . '</td>';
                    echo '<td>' . $reservation['status'] . '</td>';
                    echo '<td>';
                    echo '<select class="status-form" name="status[' . $reservation['id'] . ']" onchange="document.getElementById(\'status-form\').submit();">';
                    echo '<option value="confirmed">Confirmed</option>';
                    echo '<option value="rejected">Rejected</option>';
                    echo '</select>';
                    echo '</td>';
                    echo '</tr>';
                }

                echo '</tbody>';
                echo '</table>';
                echo '</form>';
                echo '</div>';
            } else {
                echo '<p class="lead">No pending reservations found.</p>';
            }
        } else {
            echo '<a class="lead" href="connection.php">Log in to view pending reservations</a>';
        }
        ?>

    </div>

</body>

</html>
