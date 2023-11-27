<?php
session_start();

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../index.php");
    $_SESSION['message'] = "You can't access this page!";
    $_SESSION['message_type'] = 'error';
    exit();
}

?>
<?php
// Define the list of excluded pages
$excludedPages = [
  'faculty'
];

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
  <link rel="stylesheet" href="css/dash.css">
  <title>Dashboard</title>
</head>
<body>
  <div class="sidenav" id="sidenav">
    <i class="fas fa-bars toggle-btn" onclick="toggleSidenav()"></i>
    <ul>
    <h4 style="margin-left:2rem">Admin Dashboard</h4>
      <li><a href="dashboard.php?faculty=users" onclick="setActive(this)"><i class="fas fa-users"></i> users</a></li>
      <li><a href="dashboard.php?faculty=addvenue" onclick="setActive(this)"><i class="fas fa-plus"></i> Add Venue</a></li>
      <li><a href="dashboard.php?faculty=addroom" onclick="setActive(this)"><i class="fas fa-book"></i> Add Room</a></li>
      <li><a href="dashboard.php?faculty=pending-reservation" onclick="setActive(this)"><i class="fas fa-cog"></i> Pending-reservation</a></li>
      <li><a href="dashboard.php?faculty=rejected-reservations" onclick="setActive(this)"><i class="fas fa-cog"></i>Reject-reservations</a></li>
      <li><a href="dashboard.php?faculty=confirmed-reservations" onclick="setActive(this)"><i class="fas fa-cog"></i>Confirmed-reservations</a></li>
      <li><a href="dashboard.php?faculty=register_student" onclick="setActive(this)"><i class="fas fa-cog"></i> Register_student</a></li>
      <li><a href="dashboard.php?faculty=setting" onclick="setActive(this)"><i class="fas fa-cog"></i> Settings</a></li>
      <li><a href="dashboard.php?faculty=profiles" onclick="setActive(this)"><i class="fas fa-user-circle"></i>Profiles</a></li>
      <li><a href="../logout.php" onclick="setActive(this)"><i class="fas fa-sign-out-alt"></i>Logout</a></li>
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
              case 'users':
                include('base.php');
                break;
              case 'addvenue':
                include('addvenue.php');
                break;
              case 'addroom':
                include('addroom.php');
                break;
              case 'pending-reservation':
                include('pending-reservation.php');
                break;
              case 'rejected-reservations':
                include('rejected-reservations.php');
                break;
              case 'confirmed-reservations':
                include('confirmed-reservations.php');
                break;
              case 'register_student':
                include('register_student.php');
                break;
              case 'setting':
                include('setting.php');
                break;
              case 'profiles':
                include('profiles.php');
                break;
            }
          }
        ?>  
    </div>
  <script>
    function toggleSidenav() {
      const sidenav = document.getElementById('sidenav');
      const main = document.querySelector('.main');
      const toggleBtn = document.querySelector('.toggle-btn');

      if (sidenav.classList.contains('sidenav-minimized')) {
        sidenav.classList.remove('sidenav-minimized');
        sidenav.style.width = '250px';
        main.style.marginLeft = '250px';
        toggleBtn.style.right = '10px';
      } else {
        sidenav.classList.add('sidenav-minimized');
        sidenav.style.width = '50px';
        main.style.marginLeft = '50px';
      }
    }

    function setActive(link) {
      const links = document.querySelectorAll('.sidenav li a');
      links.forEach((item) => {
        item.parentElement.classList.remove('active');
      });
      link.parentElement.classList.add('active');
    }
  </script>
  <script src="../assets/js/msg.js"></script>
</body>
</html>
