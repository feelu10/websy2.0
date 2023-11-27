<!-- PLANNING PAGE -->

<?php include 'includes/header.php'; ?>
<?php include 'includes/dbconnect.php'; ?> 

<!-- <?php
    //var_dump($_SESSION);
    $userRole = $_SESSION['role'] ;
    $requete = "SELECT u.id , u.login , r.title , r.description , r.debut , r.end FROM users AS u INNER JOIN reservations AS r ON u.id = r.id_users";
    $queryevent = mysqli_query($conn,$requete);
    $resultat = mysqli_fetch_all($queryevent);
    //var_dump($resultat);
    $format= date('Y-m-d  H');
    $requetedate = "SELECT reservations.debut, reservations.title,reservations.id, users.login FROM reservations INNER JOIN users ON reservations.id_users = users.id";
    $querydate = mysqli_query($conn, $requetedate);
    $resultatdate = mysqli_fetch_all($querydate);
    $tableaudatecount = count($resultatdate);
    
    //echo $format;
    /* var_dump($resultatdate); */
    /* die(); */
    $stopitnow = false;
    $stopnope = false;
?> -->


<main role="main">
    <div class="container my-5 shadow">
        <div class="table-responsive">

        <table class="table table-hover align-middle text-center table-borderless table-sm">
    <?php
    date_default_timezone_set('Asia/Manila');
    $daysOfWeek = array("Mon", "Tues", "Wed", "Thurs", "Fri", "Sat", "Sun");
    $today = date("w"); // numeric representation of the day (Monday = 1)

    for ($i = 0; $i < 6; $i++) { // Get the number of the days of the current week
        $thisWeek[$i] = date("d", mktime(0, 0, 0, date("n"), date("d") - $today + $i, date("y")));
    }

    $j = 0;
    $h = 8;
    $dayCases = 0;
    ?>
    <h1>Schedule of <?php echo $day_week = date('Y', time()); ?></h1>
    <h2>Week <?php echo $day_week = date('W', time()); ?></h2>

    <table class="table table-condensed" style="table-layout: fixed">
        <?php
        echo '<thead class="table-light"><tr>';
        ?>
        <tr>
            <th class="vide"></th>
            <?php
            foreach ($daysOfWeek as $day) {
                echo '<th class="day">' . ucfirst(strtolower($day)) . '. ' . date('d/m', strtotime($day . ' this week')) . '</th>';
            }
            ?>
        </tr>
        </thead>
        <tbody>
        <?php
        echo "<tbody>";

        while ($h != 20) {
            $reuse = false;
            echo "<tr>";
            if ($dayCases == 0) {
                echo "<td id='tdheure'><b>" . date("h A", strtotime($h . ":00")) . "</b></td>";
                $dayCases++;
            }
            $r = 0;

            $dayCases = 1;
            while ($dayCases < 8 && $dayCases != 0) {
                while ($r < $tableaudatecount) {
                    $stopitnow = true;
                    $datehour = date("G", strtotime($resultatdate[$r][0]));
                    $dateday = date("N", strtotime($resultatdate[$r][0]));
                    $titleres = $resultatdate[$r][1];
                    $idres = $resultatdate[$r][2];
                    $login = $resultatdate[$r][3];

                    if ($dateday == $dayCases && $datehour == $h) {
                        $extrait_title = substr($titleres, 0, 16);
                        $extrait_login = substr($login, 0, 10);
                        if ($userRole === 'admin' || $userRole === 'student') {
                            echo "<td class='resa text-wrap' id='reserved'> <b>" . $extrait_title . ".</b><br> by " . $extrait_login . ".<br><a href='reservation.php?id=" . $idres . "'><i class='fa-solid fa-2x fa-eye'></i></a></td>";
                        }else {
                            // Display the regular content because no data is available
                            echo "<td class='disabled-resa text-wrap' id='reserved'> <i>Booked</i></td>";
                        }                       
                         $stopnope = true;
                    } else {
                        $stopitnow = false;
                    }

                    $r++;
                }
                if ($stopitnow == false && $stopnope == false) {
                    echo "<td id='dispo'><a href='reservation-form.php'>Free</a></td>";
                    if ($dayCases == 5) {
                        echo "<td id='closed'>closed</td>";
                        $dayCases++;
                    }
                    if ($dayCases == 6) {
                        echo "<td id='closed'>closed</td>";
                        $dayCases++;
                    }
                }
                $r = 0;
                $dayCases++;
                $stopitnow = false;
                $stopnope = false;
                if ($dayCases == 8) {
                    $dayCases = 0;
                }
            }
            echo "</tr>";
            $dayCases = 0;
            $h++;
        }
        echo '</tbody>';
        ?>
    </table>
</table>

        </div>
    </div>
</main>

<?php include("includes/footer.php")?>