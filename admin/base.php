<?php
require '../includes/dbconnect.php';

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../index.php");
    $_SESSION['message'] = "You can't access this page!";
    $_SESSION['message_type'] = 'error';
    exit();
}

$query = "SELECT * FROM users WHERE role IN ('user', 'student')";
$result = mysqli_query($conn, $query);

if ($result) {
    $users = mysqli_fetch_all($result, MYSQLI_ASSOC);
} else {
    echo "Error retrieving users: " . mysqli_error($conn);
    exit();
}

// Check for SweetAlert messages and display them
if (isset($_SESSION['sweet_alert'])) {
    echo "<script>
        Swal.fire({
            icon: '" . $_SESSION['sweet_alert']['type'] . "',
            title: '" . $_SESSION['sweet_alert']['title'] . "',
            text: '" . $_SESSION['sweet_alert']['text'] . "',
        });
    </script>";
    unset($_SESSION['sweet_alert']);
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11">
    <link rel="stylesheet" href="css/role.css">
</head>
<body>

<h2 style="text-align:center">Available Users</h2>

<table class="table table-striped">
    <thead>
        <tr>
            <th>User ID</th>
            <th>Username</th>
            <th>Role</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($users as $user): ?>
            <tr>
                <td><?php echo $user['id']; ?></td>
                <td><?php echo $user['login']; ?></td>
                <td>
                    <form action="update_role.php" method="post">
                        <input type="hidden" name="user_id" value="<?php echo $user['id']; ?>">
                        <select class="form-control" name="new_role">
                            <option value="user" <?php echo ($user['role'] == 'user') ? 'selected' : ''; ?>>User</option>
                            <option value="student" <?php echo ($user['role'] == 'student') ? 'selected' : ''; ?>>Student</option>
                        </select>
                        <button class="btn btn-primary" type="submit">Change Role</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<script src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>
</html>
