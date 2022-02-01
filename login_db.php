<?php 

    require_once 'connection.php';

    session_start();

    if (isset($_POST['btn_login'])) {
        $email = $_POST['txt_email']; // textbox name 
        $password = $_POST['txt_password']; // password
        $role = $_POST['txt_role']; // select option role
        // $ip = $_POST['ip'];
  
        if (empty($email)) {
            $errorMsg[] = "Please enter email";
        } else if (empty($password)) {
            $errorMsg[] = "Please enter password";
        } else if (empty($role)) {
            $errorMsg[] = "Please select role";
        } else if ($email AND $password AND $role) {
            try {
                $select_stmt = $db->prepare("SELECT email, password, role FROM masterlogin WHERE email = :uemail AND password = :upassword AND role = :urole");
                $select_stmt->bindParam(":uemail", $email);
                $select_stmt->bindParam(":upassword", $password);
                $select_stmt->bindParam(":urole", $role);
                $select_stmt->execute(); 

                while($row = $select_stmt->fetch(PDO::FETCH_ASSOC)) {
                    $dbemail = $row['email'];
                    $dbpassword = $row['password'];
                    $dbrole = $row['role'];
                }
                if ($email != null AND $password != null AND $role != null) {
                    if ($select_stmt->rowCount() > 0) {
                        
                            if ($email == $dbemail AND $password == $dbpassword AND $role == $dbrole) {
                                switch($dbrole) {
                                    case 'admin':
                                        $_SESSION['admin_login'] = $email;
                                        $_SESSION['success'] = "Connexion réussi...";
                                        header("location: admin/acceuil.php");
                                    break;
                                    case 'formateur':
                                        $_SESSION['employee_login'] = $email;
                                        $_SESSION['success'] = "Connexion réussi...";
                                        header("location: employee/acceuil.php");
                                    break;
                                    case 'apprenant':
                                        if ($_POST['ip'] == "196.47.128.151" ) {
                                        $_SESSION['user_login'] = $email;
                                        $_SESSION['success'] = "Connexion réussi...";
                                        // header("location: user/user_home.php");
                                        header("location: face.php");
                                        }else {
                                            $_SESSION['error'] = "Vous n'êtes pas a Simplon";
                                            header("location: index.php");
                                        }
                                    break;
                                
                                    default:
                                        $_SESSION['error'] = "E-mail, mot de passe ou rôle incorrect";
                                        header("location: index.php");
                                
                            }
                            } else {
                                $_SESSION['error'] = "E-mail, mot de passe ou rôle incorrect";
                                header("location: index.php");
                            }
                        }else {
                            $_SESSION['error'] = "E-mail, mot de passe ou rôle incorrect";
                            header("location: index.php");
                        }
                      
                }
            } catch(PDOException $e) {
                $e->getMessage();
            }
        }
    }

?>

