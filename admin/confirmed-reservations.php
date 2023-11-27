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
    <title>Confirmed Reservations</title>
    <link rel="stylesheet" href="path/to/your/styles.css">
    <!-- Add any other stylesheets or styling links here -->
    <style>
        /* Add your custom styles here */
        .container {
            margin-top: 50px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        .lead {
            font-size: 18px;
            font-weight: 500;
            margin-bottom: 20px;
        }
    </style>
</head>

<body>

    <div class="container">
        <h1 class="mb-4">Confirmed Reservations</h1>

        <?php
        if (isset($_SESSION['login'])) {

            // Fetch all reservations with a status of 'confirmed' and include user's name and role
            $fetchConfirmedReservationsQuery = "SELECT r.title, r.description, r.debut, r.end, r.status, u.login, u.role
                FROM `reservations` AS r
                JOIN `users` AS u ON r.id_users = u.id
                WHERE r.status = 'confirmed'";
                
            $confirmedReservationsResult = mysqli_query($conn, $fetchConfirmedReservationsQuery);

            if (mysqli_num_rows($confirmedReservationsResult) > 0) {
                // Display confirmed reservations
                echo '<div class="table-responsive">';
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
                echo '</tr>';
                echo '</thead>';
                echo '<tbody>';

                while ($reservation = mysqli_fetch_assoc($confirmedReservationsResult)) {
                    echo '<tr>';
                    echo '<td>' . $reservation['title'] . '</td>';
                    echo '<td>' . $reservation['description'] . '</td>';
                    echo '<td>' . $reservation['debut'] . '</td>';
                    echo '<td>' . $reservation['end'] . '</td>';
                    echo '<td>' . $reservation['login'] . '</td>';
                    echo '<td>' . $reservation['role'] . '</td>';
                    echo '<td>' . $reservation['status'] . '</td>';
                    echo '</tr>';
                }

                echo '</tbody>';
                echo '</table>';
                echo '</div>';
            } else {
                echo '<p class="lead">No confirmed reservations found.</p>';
            }
        } else {
            echo '<a class="lead" href="connection.php">Log in to view confirmed reservations</a>';
        }
        ?>

    </div>

</body>

</html>
