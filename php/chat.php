<?php
include "connect.php";
include "user_session.php";

if(isset($_POST['submit'])){
    
    $userid = $_SESSION['userid'];  
    $message = $_POST['msg'];

    $chat = mysqli_query($conn, "INSERT INTO `chat`(`sender_userid`, `reciever_userid`, `message`) VALUES ('$id', '$userid', '$message')") or die('QUERY FAILED');
    $msg_notify = mysqli_query($conn, "INSERT INTO `msg_notif`(`frm_id`, `to_id`) VALUES ('$id', '$userid')") or die('failed');

        if ($msg_notify){
        
            $frm_count_msg = mysqli_query($conn, "SELECT * FROM `msg_count` WHERE `UID` = '$id'");
        
            if(mysqli_num_rows($frm_count_msg) > 0){

                $add_count = mysqli_query($conn, "UPDATE `msg_count` SET `count` += 1 WHERE `UID` = '$id'");
            } else{
                $ins_msg = mysqli_query($conn, "INSERT INTO `msg_count` (`UID`, `count`) VALUES ('$id', 1)");
            }
        } else{
            echo "error";
        }
    header("location: ../chat/index.php?userid=$userid");
}else{

    echo "error";

}