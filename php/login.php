<?php
        include "../connection/dbcon.php";
        session_start();

        $username = $_POST['uname'];
        $password =md5($_POST['psw']);
        $sql = "SELECT * FROM user WHERE username='$username' AND password='$password'";
        $result = mysqli_query($conn, $sql);

            if(mysqli_num_rows($result)) {   
                         
                $user = mysqli_fetch_assoc($result);
                $role = $user['role'];

                if($role == "user"){
                    $_SESSION['id'] = $user['id'];
                    $id = $user['id'];

                    header("location: ../home/home.php"); 
                }else{
                    $_SESSION['id'] = $user['id'];
                    $id = $user['id'];

                    header("location: ../admin/index.php");
                }
            } else {
                header("Location: ../login.php?error=Incorrect username or pasword ");
                exit();
            }