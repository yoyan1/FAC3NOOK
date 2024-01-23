<?php
include "../connection/dbcon.php";
include "user_session.php";

$slct_tbl = mysqli_query($conn, "SELECT * FROM `mode` WHERE `uid` = '$id'") or die('failed');

if (mysqli_num_rows($slct_tbl) > 0){
    $theme = mysqli_fetch_assoc($slct_tbl);
    $type = $theme['theme'];

    if($type == 'dark'){
        $mode = 'light';
    } else{
        $mode = 'dark';
    }

    $update = mysqli_query($conn, "UPDATE `mode` SET `theme`= '$mode' WHERE `uid` = '$id'");

    header("location: ../home/home.php");
} else{

    $ins = mysqli_query($conn, "INSERT INTO `mode`(`uid`, `theme`) VALUES ('$id', 'dark')");
    header("location: ../home/home.php");
}