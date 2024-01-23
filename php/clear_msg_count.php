<?php
include "../connection/dbcon.php";
include "user_session.php";

if(isset($_GET['id'])){
    $clear = mysqli_query($conn, "UPDATE `msg_count` SET `count`= 0 WHERE `UID` = '$id'");
    
    if($clear){
    
    } else{
        echo "error";
    }
} else{
    echo "error";
}