<?php
include "../connection/dbcon.php";
include "user_session.php";

if(isset($_GET['id'])){
    $clear = mysqli_query($conn, "DELETE FROM `msg_count` WHERE  `UID` = '$id'");
    
    if($clear){
    
    } else{
        echo "error";
    }
} else{
    echo "error";
}