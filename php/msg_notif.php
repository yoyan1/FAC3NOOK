<?php

$msg_notify = mysqli_query($conn, "INSERT INTO `msg_notif`(`frm_id`, `to_id`) VALUES ('$loguser', '$id')");

if ($msg_notify){

    $frm_count_msg = mysqli_query($conn, "SELECT * FROM `msg_count` WHERE `UID` = '$loguser'");

    if(mysqli_num_rows($frm_count_msg) > 0){
        
        $add_count = mysqli_query($conn, "UPDATE `msg_count` SET `count` += 1 WHERE `UID` = '$loguser'");
    } else{
        $ins_msg = mysqli_query($conn, "INSERT INTO `msg_count` (`UID`, `count`) VALUES ('$loguser', 1)");
    }
} else{
    echo "error";
}