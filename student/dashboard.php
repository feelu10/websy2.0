<?php
session_start();

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'student') {
    header("Location: ../index.php");
    $_SESSION['message'] = "You can't access this page!";
    $_SESSION['message_type'] = 'error';
    exit();
}

?>
<?php
// Define the list of excluded pages
$excludedPages = ['faculty'];

// Get the current page from the URL query parameter
$currentPage = isset($_GET['faculty']) ? $_GET['faculty'] : '';

// Check if the current page is one of the excluded pages
$hideZCS = in_array($currentPage, $excludedPages);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <link rel="stylesheet" href="../assets/css/msg.css">
  <link rel="stylesheet" type="text/css" href="assets/css/style.css">
  <title>Student Dashboard</title>
</head>
<body>
  <div class="sidenav" id="sidenav">
    <i class="fas fa-bars toggle-btn" onclick="toggleSidenav()"></i>
    <ul>
    <h4 style="margin-left:2rem">Dashboard</h4>
      <li><a href="dashboard.php?faculty=planning" onclick="setActive(this)"><i class="fas fa-calendar"></i>Calendar</a></li>
      <li><a href="dashboard.php?faculty=reservation-form" onclick="setActive(this)"><i class="fas fa-plus"></i> Make Reservation</a></li>
      <li><a href="dashboard.php?faculty=view" onclick="setActive(this)"><i class="fas fa-book"></i>Requested reservation</a></li>
      <li><a href="dashboard.php?faculty=setting" onclick="setActive(this)"><i class="fas fa-eye"></i>Overview</a></li>
      <li><a href="dashboard.php?faculty=profiles" onclick="setActive(this)"><i class="fas fa-user-circle"></i>Profiles</a></li>
      <div class="logout-container" style="position: absolute; right: 70px; bottom: 20px; width: 100%;">
        <a href="../logout.php" class="logout-link" style="text-align: center; display: block; padding: 10px; color: white;">
            <i class="fas fa-sign-out-alt"></i> Logout
        </a>
    </div>
      <!-- Add more menu items as needed -->
    </ul>
  </div>

  <div class="main">
  <?php 
            if (isset($_SESSION['message'])): 
            ?>
            <div class="message <?= $_SESSION['message_type'] === 'success' ? 'success' : '' ?>"> 
              <?= $_SESSION['message'] ?>
            </div>
            <?php 
            unset($_SESSION['message']);
            unset($_SESSION['message_type']);
            endif; 
          ?>
        <?php
          // Handle dynamic content based on the current page
          if (isset($_GET['faculty'])) {
            switch ($_GET['faculty']) {
              case 'planning':
                include('assets/calendar.php');
                break;
              case 'reservation-form':
                include('student_reservation.php');
                break;
              case 'view':
                include('view.php');
                break;
              case 'setting':
                include('setting.php');
                break;
              case 'profiles':
                include('../profil.php');
                break;
            }
          }
        ?>  
    </div>
<script src="assets/js/script.js"></script>
</body>
</html>


