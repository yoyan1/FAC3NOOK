<?php
include "connect.php";
session_start();

if(isset($_POST['submit'])){
    $id = $_SESSION['id'];
    $userid = $_SESSION['userid'];  
    $message = $_POST['msg'];

    $chat = mysqli_query($conn, "INSERT INTO `chat`(`sender_userid`, `reciever_userid`, `message`) VALUES ('$id', '$userid', '$message')") or die('QUERY FAILED');

    header("location: ../chat/index.php?userid=$userid");
}else{

    echo "error";

}