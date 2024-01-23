<?php
session_start();
include "connection/dbcon.php";
$browser = $_SERVER['HTTP_USER_AGENT'];
    $lastON = mysqli_query($conn, "SELECT * FROM browse_type LEFT JOIN user ON user.id = browse_type.user WHERE type = '$browser' AND status = 'ONLINE'") or die("failed");
    if(mysqli_num_rows($lastON) > 0){
        $row = mysqli_fetch_assoc($lastON);
        $_SESSION['id'] = $row['id'];
        header("location: home/home.php");
    } else{

    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Facenook</title>
    <link rel="stylesheet" href="stylesheet/index.css">
</head>
<body>
    <div class="preloader">
        <div class="spinner">
            <div class="dot"></div>
            <div class="dot"></div>
            <div class="dot"></div>
            <div class="dot"></div>
            <div class="dot"></div>
        </div>
    </div>
    <main>
        <div class="container">
            <div class="signup">
                <h2>Sign in</h2>
                <form action="php/login.php" method="post">            
                    <label for="uname">Username</label>
                    <input type="text" name="uname" id="uname">
                    <label for="pass">Password</label>
                    <input type="password" name="psw" id="pass">
                    <button type="submit">Sign in</button>
                </form>
    
                <p>Don't have an account?<a href="#" onclick="signup()">Sign up</a></p>
            </div>
            <div class="wrapper">
                <div style="width: 10px; height: 10px;  background: #1F82F6; padding: 15px; border-radius: 10px;">
                    <div style="width: 10px; height: 10px; border-radius: 100%; background: white;"></div>
                </div>
                <h1>Information Security and Management</h1>
                <p>welcome to our very own website</p>
                <h2>facenook</h2>
                <div class="imgwrppr">
                    <img src="image/undraw_team_up_re_84ok.svg" alt="">
                </div>
            </div>
            <div class="getStarted">
                <h2>Get started</h2>
                <p>create your own website</p>
                <form action="php/register.php" method="post">
                    <?php if(isset($_GET['error'])){ ?>
                        <p style="color: red; font-size: 12px;"><?=$_GET['error']?></p>
                   <?php }else{} ?>    
                    <label for="fname">Full name</label>
                    <input type="text" name="fname" id="fname">
                    <p style="color: red; font-size: 12px;" id="name_er"></p>
                    <label for="uname">Username</label>
                    <input type="text" name="uname" id="uname">
                    <p style="color: red; font-size: 12px;" id="user_er"></p>
                    <label for="pass">Password</label>
                    <input type="password" name="pass" id="pass">
                    <p style="color: red; font-size: 12px;" id="pass_er"></p>
                    <button type="submit">Sign up</button>
                </form>
    
                <p>Already have an account?<a href="#" onclick="signin()">Sign in</a></p>
            </div>
    
        </div>
    </main>
</body>
<script src="js/verify.js"></script>
<script src="js/index.js"></script>
</html>