<?php
include "../connection/dbcon.php";
session_start();

$browser = $_SERVER['HTTP_USER_AGENT'];
$id = $_SESSION['id'];

$action = mysqli_query($conn, "UPDATE `browse_type` SET `type`= '$browser', `status`= 'OFFLINE' WHERE user = '$id' AND `type` = '$browser'");
if($action){

    header("location: ../login.php");
} else{

    $_SESSION['id'] = $id;
    header("location: ../home/home.php");
}