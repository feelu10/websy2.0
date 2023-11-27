<!--PROFIL PAGE-->

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
    <!--TITLE-->
<?php include 'includes/dbconnect.php'; ?> 

<?php
    $login = $_SESSION['login'];
    $password = $_SESSION['password']; 
?>

<section class="container my-5">
    <main class="col">
        <h1>Profile</h1>
        <div class="row w-100">

            <!-- Article gauche -->
            <div class="col-sm bg-light align-items-end align-content-strech p-3 m-3">
                
                <form action="" method="post">
                    <div class="row mb-3 ">                
                        <h3 class="form_title center">My account</h3>
                        <i class="bi bi-person-circle"></i>
                    </div>
                    <div class="row my-3">
                        <label for="login" class="form-label">Login</label>
                        <input type="text" class="form-control" value="<?=$login?>" name="login" required>
                    </div>

                    <div class="row my-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" placeholder="Enter Password" name="password" required>
                    </div>
                    
                    <div class="row mt-4">
                        <input type="submit" class="form-control btn btn-dark mx-1 w-25"  name='submit' value="Change" >
                        <span class="small pt-1 text-secondary">Change Credentials</span>
                    </div>
                    <div class="row mt-4">
                        <input type="submit" class="form-control btn btn-outline-danger mx-1 w-25" name="delete" value="Delete" />
                        <span class="small pt-1 text-secondary">suppress my account</span>
                    </div>
                    
                <?php

                if(isset($_POST ['submit']) && isset ($_POST ['login']) && isset ($_POST ['password'])){

                    if (password_verify($_POST ['password'], $password)) { // vérification du mot de passe
                        $request = "UPDATE users SET login = '".$_POST ['login']."' WHERE login = '".$login."' ";
                        $result = mysqli_query($conn, $request);
                        $login = $_POST ['login'];
                        $_SESSION['login'] = $login;
                        $_SESSION['password'] = $password;
                        echo "<p type='alert' class='alert alert-success alert-dismissible fade show'>Modification done successfully!</p>";
                        session_destroy();
                        header('Location: index.php');
                        
                    } else {
                        echo "<p type='alert' class='alert alert-danger alert-dismissible fade show'>Password incorrect</p>";
                    }
                }
                else if (isset($_POST['delete'])) {
                    if (isset ($_POST ['password'])) {
                        if (password_verify($_POST['password'], $password)) {
                            $del = "DELETE FROM users WHERE login = '$login' ";
                            if ($conn->query($del) === TRUE) {
                                echo '<span type="alert" class="alert alert-danger alert-dismissible fade show">DELETE USER</span>';
                                session_destroy();
                                // header('Location: index.php'); 
                                // header('refresh:2, url=index.php');
                            } else {
                                echo "<p type='alert' class='alert alert-danger alert-dismissible fade show'>Deletion error</p>";
                            }
                        } else {
                            echo "<p type='alert' class='alert alert-danger alert-dismissible fade show'>Password incorrect</p>";
                        }
                    } else {
                        echo "<p type='alert' class='alert alert-danger alert-dismissible fade show'>Please enter your password.</p>";
                    }
                }

                ?>
                </form>
            </div>

            <div class="col-sm p-3 bg-light h-100 m-3">
                <form action="" method="post">
                    <div class="row mb-3">
                        <h3 class="form_title center">Change Password</h3>
                        <i class="bi bi-shield-lock"></i>
                    </div>
                    <div class="row mb-3">
                        <label for="password" class="form-label">Old Password</label>
                        <input type="password" class="form-control" placeholder="Enter old password" name="oldpassword" required>
                    </div>
                    <div class="row mb-3">
                        <label for="password" class="form-label">New password   </label>
                        <input type="password" class="form-control" placeholder="Enter new password" name="password1" required>
                    </div>
                    <div class="row mb-3">
                        <label for="password" class="form-label">Confirm Password</label>
                        <input type="password" class="form-control" placeholder="Confirm Password" name="password2">
                    </div>
                    <div class="row mb-3">
                        <input type="submit" class="form-control btn btn-dark w-25" id='submit' value="Submit" >

            <?php

                if(isset ($_POST ['oldpassword']) && isset ($_POST ['password1']) && isset ($_POST ['password2'])){
                    $oldpassword = $_POST ['oldpassword'];
                    $password1 = $_POST ['password1'];
                    $password2 = $_POST ['password2'];

                    if (password_verify($oldpassword, $password)) { 
                        if ($password1 == $password2) {
                            $password = password_hash($password1, PASSWORD_DEFAULT);

                            $request = "UPDATE users SET password = '".$password."' WHERE login = '".$login."' ";
                            $result = mysqli_query($conn, $request);
                            $_SESSION['password'] = $password;

                            echo "<p class'type='alert' class='alert alert-success alert-dismissible fade show'>Successfully Change Password</p>";

                        }
                        else {
                            echo "<p type='alert' class='alert alert-danger alert-dismissible fade show'>Passwords do not match</p>";
                        }
                    }
                    else {
                        echo "<p type='alert' class='alert alert-danger alert-dismissible fade show'>Incorrect Old Password</p>";
                    }
                }
            ?>
                    </div>
                </form>
            </div>
        </div> <!-- end row -->
    <main>
</section> <!--end container-->

<?php include '../includes/footer.php';?>