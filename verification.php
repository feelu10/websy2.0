<!--VERIFICATION PAGE-->
<?php
    include 'includes/dbconnect.php'; 
    session_start();
        if(isset($_POST['login']) && isset($_POST['password'])) 
        {       
            $login = mysqli_real_escape_string($conn,htmlspecialchars($_POST['login'])); 
            $password = mysqli_real_escape_string($conn,htmlspecialchars($_POST['password']));

            if($login !== "" && $password !== "") 
            {
                $request = "SELECT count(*) FROM users where 
                login = '".$login."' "; 
                $exec_request = mysqli_query($conn,$request);
                $reponse = mysqli_fetch_array($exec_request); 
                $count = $reponse['count(*)'];

                if($count!=0) 
                {
                    $request = "SELECT password FROM users where login = '".$login."' ";
                    $exec_request = mysqli_query($conn,$request); 
                    $reponse = mysqli_fetch_array($exec_request); 
                    $passwordbdd = $reponse['password']; 
                    if(password_verify($password, $passwordbdd)){ 
                        $_SESSION['login'] = $login; 
                        $request = "SELECT * FROM users where login = '".$login."' ";
                        $exec_request = mysqli_query($conn,$request);
                        $reponse = mysqli_fetch_array($exec_request);

                        $_SESSION['password'] = $reponse['password'];
                        $_SESSION['id'] = $reponse['id'];

                        $fetch = "SELECT role FROM users WHERE login = '".$login."'";
                        $fetching = mysqli_query($conn, $fetch);
                        $result = mysqli_fetch_array($fetching);
                        $role = $result['role']; 
    
                        $_SESSION['role'] = $role;
                        $_SESSION['loginOK'] = true;   
    
                        // Redirect based on the role
                        switch ($role) {
                            case 'admin':
                                header('Location: admin/dashboard.php');
                                break;
                            case 'user':
                                header('Location: planning.php');
                                break;
                            case 'student':
                                header('Location: student/dashboard.php');
                                break;
                        }
                    }
                    else
                    {
                        header('Location: connection.php?erreur=1'); 
                    }
                }
                else
                {
                    header('Location: connection.php?erreur=1');
                }
            }
            else
            {
                header('Location: connection.php?erreur=2');
            }
        }
        else
        {
            header('Location: connection.php');
        }
        mysqli_close($conn);
    ?>