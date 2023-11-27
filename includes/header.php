<?php session_start() ?>

<!--HEADER BLOC-->
<!DOCTYPE html>
<html lang="fr">
<head>
    <!-- Required meta tags -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">    
    <!--BOOTSTRAP-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <!--CSS-->
    <link rel="stylesheet" href="css/style.css" media="screen" type="text/css" />
    <link rel="stylesheet" href="css/carousel.css" type="text/css" />
    <link rel="stylesheet" href="css/animations.css" media="screen" type="text/css" />
    <!--FONT-->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,700,800" rel="stylesheet">
    <script src="https://kit.fontawesome.com/12c357b92c.js" crossorigin="anonymous"></script>
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

    <!--TITLE-->
    <title>Event Planning Management</title>
</head>

<body>
    <header>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                <a class="navbar-brand" href="index.php">Home</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown"
                        aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavDropdown">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link fas fa-calendar" href="planning.php">Calendar</a>
                        </li>
                        <?php if (!isset($_SESSION['login'])) : ?>

                        <ul class="navbar-nav">
                            <!-- Settings Dropdown moved to the right -->
                            <!-- Settings Dropdown -->
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                    Login/Register
                                </a>
                                    <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                        <li><a class="dropdown-item" href="connection.php">Login<i class="fas fa-sign-in-alt pl-1"></i></a></li>
                                        <li><a class="dropdown-item" href="registration.php">Register<i class="fas fa-user-plus pl-1"></i></a></li>
                                    </ul>
                            </li>
                        </ul>
                        <?php endif; ?>
                        <?php if (isset($_SESSION['login'])) : ?>
                        <li class="nav-item"> 
                            <a class="nav-link " href="reservation-form.php">Reserve now</a>
                        </li>
                        <!-- New Dropdown Menu for Venue, Rooms, Personnel -->
                        <!-- <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                               data-bs-toggle="dropdown" aria-expanded="false">
                                Manage
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="venue.php">Venue</a></li>
                                <li><a class="dropdown-item" href="rooms.php">Rooms</a></li>
                                <li><a class="dropdown-item" href="personnel.php">Personnel</a></li>
                            </ul>
                        </li> -->
                    </ul>
                    <ul class="navbar-nav">
                        <!-- Settings Dropdown moved to the right -->
                        <!-- Settings Dropdown -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                                Settings
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                <li><a class="dropdown-item" href="profil.php">Profile<i class="fa-regular fa-user pl-1"></i></a></li>

                                <!-- Manage Venues Dropdown -->
                                <li class="nav-item dropdown">
                                    <ul class="dropdown-menu" aria-labelledby="navbarDropdownVenues">
                                        <li><a class="dropdown-item" href="add_venue.php">Add Venue</a></li>
                                        <li><a class="dropdown-item" href="delete_venue.php">Delete Venue</a></li>
                                    </ul>
                                </li>

                                <li><a class="dropdown-item" href="logout.php">Logout<i class="fa-solid fa-power-off pl-1"></i></a></li>
                            </ul>
                        </li>
                     <?php endif; ?>
                    </ul>
                </div> <!-- /navbar-collapse -->
            </div> <!-- /container-fluid -->
        </nav>
    </header>