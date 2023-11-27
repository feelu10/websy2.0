<?php
include 'includes/dbconnect.php';
session_start();

if (isset($_POST['Title']) && isset($_POST['date']) && isset($_POST['start_time']) && isset($_POST['end_time']) && isset($_POST['description'])) {
    $Title = mysqli_real_escape_string($conn, htmlspecialchars($_POST['Title']));
    $date = $_POST['date'];
    $selectedStudentId = $_POST['student_in_charge'];
    $selectedId = $_POST['selected_id']; 
    $selectedType = $_POST['reservation_type'];
    $hour_d = $_POST['start_time'];
    $hour_f = $_POST['end_time'];
    $date_d = [$date, $hour_d];
    $date_d = implode(" ", $date_d);
    $date_f = [$date, $hour_f];
    $date_f = implode(" ", $date_f);
    $description = mysqli_real_escape_string($conn, htmlspecialchars($_POST['description']));
    $date = date("w", strtotime($date));

    if ($date == 0 || $date == 6) {
        echo '<p class="red">There are no reservations on weekends, please choose another date</p>';
        exit();
    }

    if ($hour_d >= $hour_f) {
        echo '<p class="red">The slot must be at least 1 hour, or the start time must be before the end time</p>';
        exit();
    }

    $test = "SELECT COUNT(*) FROM reservations WHERE (debut <= '$date_d' AND '$date_d' < end) OR (debut < '$date_f' AND '$date_f' <= end)";
    $result = mysqli_query($conn, $test);

    if (!$result) {
        die('Error: ' . mysqli_error($conn));
    }

    $reponse = mysqli_fetch_array($result);
    $count = $reponse['COUNT(*)'];

    if ($count == 0) {
        $id = $_SESSION['id'];

        if ($selectedType === 'venue') {
            $sql = "INSERT INTO reservations (Title, description, debut, end, id_users, venue_id, id_student) VALUES (?, ?, ?, ?, ?, ?, ?)";
        } elseif ($selectedType === 'room') {
            $sql = "INSERT INTO reservations (Title, description, debut, end, id_users, room_id, id_student) VALUES (?, ?, ?, ?, ?, ?, ?)";
        }
        var_dump($selectedId);  // Check the value of $sql

        if (!empty($sql)) {
            $stmt = mysqli_prepare($conn, $sql);
            mysqli_stmt_bind_param($stmt, "ssssiii", $Title, $description, $date_d, $date_f, $id, $selectedId, $selectedStudentId);
            $result = mysqli_stmt_execute($stmt);

            if ($result) {
                $_SESSION['message'] = '<h3 class="green lead">Reservation made, Wait for confirmation</h3>';
                header('Location: reservation-form.php');
                exit();
            } else {
                $_SESSION['message'] = '<h3 class="red lead">Error: ' . mysqli_error($conn) . '</h3>';
                header('Location: reservation-form.php');
                exit();
            }
        } else {
            $_SESSION['message'] = '<h3 class="red lead">Error: SQL query is empty</h3>';
            header('Location: reservation-form.php');
            exit();
        }
    } else {
        $_SESSION['message'] = '<p class="red lead">Slot already taken</p>';
        header('Location: reservation-form.php');
        exit();
    }
}
?>
