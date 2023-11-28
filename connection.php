<?php include 'includes/header.php';?>
<?php include 'includes/dbconnect.php';?> 

<?php

if (isset($_POST['submit'])) {
    $user = $_POST['login'];
    $success = $user->connect($_POST['login'], $_POST['password']);

    $status = $user->getStatus();
    if ($status == "login") {
        $alert = "<p class='alert alert-danger alert-dismissible fade show'>This login does not exist.</p>";
    } elseif ($status == "Mot de passe") {
        $alert = "<p class='alert alert-danger alert-dismissible fade show'>Check your password.</p>";
    } elseif ($status == "connecté") {
    $alert = "<p class='alert alert-success alert-dismissible fade show'>
    Connection successful. welcome@'.$user->getLogin().'<br> 
    <a href='template.php?page=profil'>Visit your profile</a>";
    }

    if ($success == 1) {
    $_SESSION['login'] = $user;
    }
}
?>

<main role="main" class="container py-5"> 
        <div class="col-6 mx-auto py-3 bg-light"> 

            <form action="verification.php" method="POST">
                <h1>Login</h1>

                <?php if (isset($alert)) : ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <?php echo $alert; ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php endif; ?>
                
                <div class="col pb-3">
                    <label for="login" class="form-label">Username</label>
                    <input id="login" class="form-control" type="text" placeholder="Enter username" name="login" required>
                </div>

                <div class="col pb-3">
                    <label for="password" class="form-label">Password</label>
                    <input id="password" class="form-control" type="password" placeholder="Enter the password" name="password" required>
                </div>
                
                <div class="col pb-3">
                    <input class="form-control submit" type="submit" id='submit' value='Log In'  style="margin-bottom: 5px;">
                    <p>You don't have an account yet? <a href="registration.php">Sign up</a></p>
                </div>
                <?php

                if(isset($_GET['erreur'])){
                    $err = $_GET['erreur'];
                    if($err==1 || $err==2)
                        echo "<p class='alert alert-danger alert-dismissible fade show'>Incorrect Credentials !</p>";
                }?>
                
            </form>
        </div>
    </div>    

</main> <!-- /main -->

<?php include 'includes/footer.php';?>
