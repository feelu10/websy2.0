<?php include 'includes/header.php';?>
<?php include 'includes/dbconnect.php';?> 

<main role="main" class="container">
    <?php
        $view=1;
        if(isset($_POST['login'],$_POST['password'],$_POST['firstname'],$_POST['lastname'])){
            $login = mysqli_real_escape_string($conn, htmlspecialchars($_POST['login']));
            $password = mysqli_real_escape_string($conn, htmlspecialchars($_POST['password']));
            $firstname = mysqli_real_escape_string($conn, htmlspecialchars($_POST['firstname']));
            $lastname = mysqli_real_escape_string($conn, htmlspecialchars($_POST['lastname']));

            $select = mysqli_query($conn,"SELECT * FROM users WHERE login='".$_POST['login']."'");

            if($_POST['login'] == ""){
                echo "<p type='alert' class='alert alert-danger alert-dismissible fade show'> Username field is empty.</p>";
            } 
            elseif(mysqli_num_rows($select)) {
                echo "<p type='alert' class='alert alert-danger alert-dismissible fade show'>This username already exists</p>";
            } 
            elseif($_POST['password'] == "" || $_POST['password2'] == ""){
                echo "<p type='alert' class='alert alert-danger alert-dismissible fade show'>
                Password field is empty.</p>";
            } 
            elseif ($_POST['password'] != $_POST['password2']) { 
                echo "<p type='alert' class='alert alert-danger alert-dismissible fade show'>
                Passwords do not match.</p>";
            } 
            else {
                $password = password_hash($password, PASSWORD_DEFAULT);
                if(!mysqli_query($conn, "INSERT INTO users (login, password, firstname, lastname) values('".$login."', '".$password."', '".$firstname."', '".$lastname."')")) {
                    echo "<p type='alert' class='alert alert-danger alert-dismissible fade show'>
                    An error has occurred: </p>".mysqli_error($conn);
                } else {
                    $view = 0;
                    header("refresh:2; url=connection.php"); 
                }
            }
            mysqli_close($conn); 
        }
        if($view == 1){ 
    ?>

<div class="col-6 ml-auto mr-auto">
    <form method="post" action="">
        <h1>Create an account</h1>
        
            <div class="col mb-3">
                <label for="firstname" class="form-label">Firstname</label>
                <input type="text" class="form-control" name="firstname" placeholder="Enter Firstname" required>
            </div>
            
            <div class="col mb-3">
                <label for="lastname" class="form-label">Lastname</label>
                <input type="text" class="form-control" name="lastname" placeholder="Enter Lastname" required>
            </div>
            
            <div class="col mb-3">
                <label for="login" class="form-label">Username</label>
                <input type="text" class="form-control" name="login" placeholder="Enter Username" required>
            </div>

            <div class="col mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" placeholder="Enter password" name="password" required>
            </div>

            <div class="col mb-3">
                <label for="password" class="form-label">Confirm password </label>
                <input type="password" class="form-control"  placeholder="Confirm password" name="password2" required>
            </div>


            <div class="col mb-3">
                <input type="submit" class="form-control submit" name="register" value="register">
            </div>
        </form>
    </div> <!-- /col -->

    <?php
        }
    ?>

</main> <!-- /main -->

<?php include 'includes/footer.php';?>
