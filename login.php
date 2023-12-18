<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Facenook</title>
    <link rel="stylesheet" href="stylesheet/index.css">
    <link rel="stylesheet" href="stylesheet/login.css">
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
                <h2>Sign Up</h2>
                <form action="php/login.php" method="post" name="Form" onsubmit="return validated()">  
                    <?php if(isset($_GET['suc'])){ ?>
                      <p style="color: green; font-size: 12px;"><?=$_GET['suc']?></p>
                   <?php }else{}?>  
                   <?php if(isset($_GET['error'])){ ?>
                      <p style="color: red; font-size: 12px;"><?=$_GET['error']?></p>
                   <?php }else{}?>                 
                    <label for="uname">Username</label>
                    <input type="text" name="uname" id="uname">
                    <p style="color: red; font-size: 12px;" id="error"></p>
                    <label for="pass">Password</label>
                    <input type="password" name="psw" id="pass">
                    <p style="color: red; font-size: 12px;" id="error_pass"></p>
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
                    <label for="fname">Full name</label>
                    <input type="text" name="fname" id="fname">
                    <label for="uname">Username</label>
                    <input type="text" name="uname" id="uname">
                    <label for="pass">Password</label>
                    <input type="password" name="pass" id="pass">
                    <button type="submit">Sign up</button>
                </form>
    
                <p>Already have an account?<a href="#" onclick="signin()">Sign in</a></p>
            </div>
    
        </div>
    </main>
</body>
<script src="js/index.js"></script>
<script src="js/verify.js"></script>
</html>