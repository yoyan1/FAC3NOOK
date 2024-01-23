<?php
include "../connection/dbcon.php";
include "user_session.php";

if(isset($_GET['id'])){
    $clear = mysqli_query($conn, "UPDATE `notif_count` SET `count`= 0 WHERE `user_id` = '$id'");
    
    if($clear){
        
    } else{
        echo "error";
    }
} else{
    echo "error";
}