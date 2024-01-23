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
                    $browser = $_SERVER['HTTP_USER_AGENT'];
                    $sel_brow_type = mysqli_query($conn, "SELECT * FROM `browse_type` WHERE user = '$id' AND `type` = '$browser'");
                    if(mysqli_num_rows($sel_brow_type) == 0){
                        mysqli_query($conn, "INSERT INTO `browse_type`(`user`, `type`, `status`) VALUES ('$id' , '$browser', 'ONLINE')");
                         
                    } else{
                        mysqli_query($conn, "UPDATE `browse_type` SET `type`= '$browser', `status`= 'ONLINE' WHERE user = '$id' AND `type` = '$browser'");
                    }
                    if($user['restriction'] == 'Banned'){
                        header("Location: ../login.php?error=Your account has Banned try again Later");
                    } else{
                    header("location: ../home/home.php");
                    }
                }else{
                   
                        $_SESSION['adminid'] = $user['id'];
    
                        header("location: ../admin/index.php");
                   
                }
            } else {
                header("Location: ../login.php?error=Incorrect username or pasword ");
                exit();
            }