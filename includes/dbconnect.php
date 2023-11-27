<!--DBCONNECT BLOC-->
<?php

$conn = mysqli_connect('localhost', 'root', '', 'School'); 
if(!$conn) {
    echo "Connection Wasn't Establish.";
    exit;
}
?>
