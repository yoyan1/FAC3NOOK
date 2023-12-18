<?php
 session_start();
 include '../connection/dbcon.php';
 $logUser = $_SESSION['id'];

 $id = $_GET['userid'];
 $row = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM user WHERE id = '$id'"));

$check_data = "SELECT * FROM chat WHERE sender = '$logUser' OR sender = '$id' ORDER BY id ASC";
$run_query = mysqli_query($conn, $check_data) or die("Error");
$user = mysqli_fetch_assoc($run_query);


if(isset($_POST['submit']) && isset($_POST['msg'])){
    $message = $_POST['msg'];
    mysqli_query($conn,"INSERT INTO `chat`(`sender`, `reciever`, `message`) VALUES ('$logUser', '$id', '$message')") or die('QUERY FAILED');
    $_SESSION['id'] = $logUser;
    header("location: ../chat/index.php?userid=$id");
}else{

    

}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Facenook</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
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
    <div class="wrapper">
        <a href="../home/home.php" class="back">Go Back</a>
        <div class="title"><img src="../php/uploads/<?=$row['profile']?>" height="50px" width="50px" class="image"> <p class="name"><?=$row['fname']?></p></div>
       
        <div class="form" id="form"><?php
        while($chat = mysqli_fetch_assoc($run_query)){
                $reciever = $chat['reciever'];
                ?>
            <div class="convo">
                    <?php
                        if( $reciever == $logUser){
                        ?>
                    <div class="bot-inbox inbox" style="padding: 5px 10px">
                        <img src="../php/uploads/<?=$row['profile']?>" height="40px" width="40px" style="border-radius:100%" class="icon">
                        <div class="msg-header">
                            <p><?=$chat['message']?></p>
                        </div>
                    </div>
                    <?php } 
                    if( $id == $reciever){ ?>
                    <div class="user-inbox inbox"><div class="msg-header"><p><?=$chat['message']?></p></div></div><?php }?>
                </div>
                    <?php } 
                    ?>
                    </div>
                <div class="typing-field">
                <div class="input-data">
                    <form action=" " method="POST">
                        <input  type="text" placeholder="Type something here.." name="msg" required>
                        <button id="send-btn" name="submit">Send</button>
                    </form>
                </div>
        </div>
    </div>

    <script>
        var loader = document.querySelector(".preloader");

        window.addEventListener("load", function(){
        loader.style.display = "none";

        })
        
        wimdow.onload = function () {
            const chat = document.getELementById("form");
            chat.scrollTop = chat.scrollHeight;
        }
    </script>
    
</body>
</html>