<?php include '../includes/dbconnect.php'; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="styles.css">
    <title>Student Registration</title>
</head>

<body class="bg-light">

    <div class="container mt-5">
        <?php
        $view = 1;
        if (isset($_POST['login'], $_POST['password'], $_POST['firstname'], $_POST['lastname'], $_POST['year'], $_POST['course'])) {
            $login = mysqli_real_escape_string($conn, htmlspecialchars($_POST['login']));
            $password = mysqli_real_escape_string($conn, htmlspecialchars($_POST['password']));
            $firstname = mysqli_real_escape_string($conn, htmlspecialchars($_POST['firstname']));
            $lastname = mysqli_real_escape_string($conn, htmlspecialchars($_POST['lastname']));
            $year = mysqli_real_escape_string($conn, htmlspecialchars($_POST['year']));
            $course = mysqli_real_escape_string($conn, htmlspecialchars($_POST['course']));

            $select = mysqli_query($conn, "SELECT * FROM users WHERE login='" . $_POST['login'] . "'");

            if ($_POST['login'] == "") {
                echo "<div class='alert alert-danger' role='alert'>Username field is empty.</div>";
            } elseif (mysqli_num_rows($select)) {
                echo "<div class='alert alert-danger' role='alert'>This username already exists</div>";
            } elseif ($_POST['password'] == "" || $_POST['password2'] == "") {
                echo "<div class='alert alert-danger' role='alert'>Password field is empty.</div>";
            } elseif ($_POST['password'] != $_POST['password2']) {
                echo "<div class='alert alert-danger' role='alert'>Passwords do not match.</div>";
            } else {
                $password = password_hash($password, PASSWORD_DEFAULT);
                $role = "student"; // Default role for all students

                if (!mysqli_query($conn, "INSERT INTO users (login, password, role, firstname, lastname, year, course) VALUES ('" . $login . "', '" . $password . "', '" . $role . "', '" . $firstname . "', '" . $lastname . "', '" . $year . "', '" . $course . "')")) {
                    echo "<div class='alert alert-danger' role='alert'>An error has occurred: " . mysqli_error($conn) . "</div>";
                } else {
                    $view = 0;
                    header("refresh:2; url:connection.php");
                }
            }
            mysqli_close($conn);
        }
        if ($view == 1) {
        ?>

            <div class="col-md-6 mx-auto">
                <form method="post" action="" class="bg-white p-4 rounded shadow">

                    <h1 class="text-center mb-4">Student Registration</h1>

                    <div class="form-group">
                        <label for="firstname">Firstname</label>
                        <input type="text" class="form-control" name="firstname" placeholder="Enter Firstname" required>
                    </div>

                    <div class="form-group">
                        <label for="lastname">Lastname</label>
                        <input type="text" class="form-control" name="lastname" placeholder="Enter Lastname" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="year">Year</label>
                        <input type="text" class="form-control" name="year" placeholder="Enter Year" required>
                    </div>

                    <div class="form-group">
                        <label for="course">Course</label>
                        <input type="text" class="form-control" name="course" placeholder="Enter Course" required>
                    </div>

                    <div class="form-group">
                        <label for="login">Username</label>
                        <input type="text" class="form-control" name="login" placeholder="Enter Username" required>
                    </div>

                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" placeholder="Enter password" name="password" required>
                    </div>

                    <div class="form-group">
                        <label for="password2">Confirm Password</label>
                        <input type="password" class="form-control" placeholder="Confirm password" name="password2" required>
                    </div>

                    <button type="submit" class="btn btn-primary btn-block">Register</button>
                </form>
            </div> <!-- /col -->

        <?php
        }
        ?>
    </div>

    <!-- Add Bootstrap and any additional scripts or scripts tags as needed -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
