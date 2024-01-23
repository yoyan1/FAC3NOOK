<?php
if (isset($_POST['submit']) || isset($_GET['cm_id'])){

    include "../connection/dbcon.php";
    include "user_session.php";

    $id = $user['id'];
    $cm_id = $_GET['cm_id'];
    $reply = $_POST['reply'];
    $type = "Replied";
    $img_name = $_FILES['image']['name'];
    $img_size = $_FILES['image']['size'];
    $tmp_name = $_FILES['image']['tmp_name'];

    $img_upload_path = 'uploads/'.$img_name;
        move_uploaded_file($tmp_name, $img_upload_path);
    
    $insert_reply = mysqli_query($conn, "INSERT INTO `reply`(`cm_id`, `reply_uid`, `reply`, `image`) VALUES ('$cm_id', '$id', '$reply', '$img_name')");

    if($insert_reply){
        $sel_com = mysqli_query($conn, "SELECT * FROM comments WHERE id = '$cm_id'");
        $row_com = mysqli_fetch_assoc($sel_com);
        $pst_id = $row_com['postid'];
        $post_id = $cm_id;
        $post_row = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM publication WHERE post_id = '$pst_id'"));

        $countCom = $post_row['comments'] + 1;
        $countReply = $row_com['replies'] + 1;
        $count = mysqli_query($conn, "UPDATE `publication` SET `comments` = '$countCom' WHERE post_id = '$pst_id' ") or die('count comments failed');
        $count_rep = mysqli_query($conn, "UPDATE `comments` SET `replies` = '$countReply' WHERE id = '$cm_id' ") or die('count replies failed');
        $_SESSION['id'] = $id;
        $uid = $post_row['user_id'];
        if($id == $row_com['commentorID']){
            
            $poster_id = $post_row['user_id'];
            include "notification.php";
        } 
        elseif ($id == $row_com['commentorID'] && $uid == $id) {
            
        } 
        elseif ($id == $uid){
            $poster_id = $row_com['commentorID'];
            include "notification.php";
        }
        else{
            $poster_id = $row_com['commentorID'];
            $notify_u = mysqli_query($conn, "INSERT INTO `notification`(`userID`, `from_id`, `postID`, `type`) VALUES ('$uid', '$id', '$post_id', '$type')") or die ("notify failed");
            include "notification.php";
            $check_count_cm = mysqli_query($conn, "SELECT * FROM notif_count WHERE user_id = '$uid'") or die("check count");
            $row_notif_cm = mysqli_fetch_assoc($check_count_cm);
            
                if(mysqli_num_rows($check_count_cm) == 1){
                    $notif_count_m = $row_notif['count'] + 1;
                    $notif_count_add = mysqli_query($conn, "UPDATE `notif_count` SET `count`= '$notif_count' WHERE `user_ID` = '$uid'")or die("notif add count failed");
    
                } else{
                
                    $notif_count_add = mysqli_query($conn, "INSERT INTO `notif_count`(`user_ID`, `count`) VALUES ('$uid', 1)")or die("notif  count failed");
                }
        }
        
        header("location: ../home/reply.php?cm_id=$cm_id");
    } else{
        echo "error";
    }
} else{
    echo "error";
}