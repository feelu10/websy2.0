<!-- RESERVATION PAGE -->

<?php
    session_start();           
    if (!$_SESSION ['login']) {
        header('Location: connection.php');
    }
    session_abort();
?>

<?php include 'includes/header.php'; ?>
<?php include 'includes/dbconnect.php'; ?>

<?php

    if (isset($_GET['id'])) 
    {
        $id = (int)$_GET['id'];

        $request = "SELECT reservations.title, reservations.description, DATE_FORMAT(reservations.debut, '%d-%m-%Y %H') as debut, DATE_FORMAT(reservations.end, '%d-%m-%Y %H') as end, users.login FROM reservations INNER JOIN users ON reservations.id_users = users.id WHERE reservations.id = $id";
        $exect_request = mysqli_query($conn, $request);
        $reservations = mysqli_fetch_assoc($exect_request);
        list($date, $hour_d) = explode(" ", $reservations['debut']);
        list($date, $hour_f) = explode(" ", $reservations['end']);
    }

?>

        <main role="main">

            <div class="container my-5">
                <div>
                    <h2 class="text-center"><?php echo $reservations['title']; ?></h2>
                </div>
                <div class="table-responsive w-50 m-auto">
                    <h4 class="lead text-center bg-light py-3">Reservation details</h4>
                    <table class="table">                        
                        <tr><td class="text-left"><b>Reserved by user </b></td><td class="text-left"><?=$reservations['login']?></td></tr>
                        <tr><td class="text-left"><b>event title </b></td><td class="text-left"><?=$reservations['title']?></td></tr>
                        <tr><td class="text-left"><b>Description of the event </b></td><td class="text-left"><?=$reservations['description']?></td></tr>
                        <tr><td class="text-left"><b>Start of the event </b></td><td class="text-left"><?=$hour_d?> h </td></tr>
                        <tr><td class="text-left"><b>End of the event </b></td><td class="text-left"><?=$hour_f?> h </td></tr>
                    </table>
                </div> <!-- /div table-responsive -->
            </div> <!-- /container -->
        </main>
        <?php include("includes/footer.php")?>
