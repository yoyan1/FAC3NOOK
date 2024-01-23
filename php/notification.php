<?php


$check_count = mysqli_query($conn, "SELECT * FROM notif_count WHERE user_id = '$poster_id'") or die("check count");
$row_notif = mysqli_fetch_assoc($check_count);

$notify = mysqli_query($conn, "INSERT INTO `notification`(`userID`, `from_id`, `postID`, `type`) VALUES ('$poster_id', '$id', '$post_id', '$type')") or die ("notify failed");
 
if($poster_id == $id ){

} else{
    if(mysqli_num_rows($check_count) == 1){
        $notif_count = $row_notif['count'] + 1;
        $notif_count_add = mysqli_query($conn, "UPDATE `notif_count` SET `count`= '$notif_count' WHERE `user_ID` = '$poster_id'")or die("notif add count failed");
        
    } else{
    
        $notif_count_add = mysqli_query($conn, "INSERT INTO `notif_count`(`user_ID`, `count`) VALUES ('$poster_id', 1)")or die("notif  count failed");
    }
}