<?php
include "../connection/dbcon.php";
include "user_session.php";

$post_id = $_GET['post_id'];
if($user['restriction'] != 'Restrict'){

    if (isset($_POST['submit']) || isset($_GET['post_id'])){
    
        $id = $user['id'];
        
        $comment = $_POST['comment'];
        $replies = 0;
        $type = "Comment";
        $img_name = $_FILES['image']['name'];
        $img_size = $_FILES['image']['size'];
        $tmp_name = $_FILES['image']['tmp_name'];
    
        $img_upload_path = 'uploads/'.$img_name;
            move_uploaded_file($tmp_name, $img_upload_path);
        
        $insert_com = mysqli_query($conn, "INSERT INTO `comments`(`postid`, `commentorID`, `comment`, `image`, `replies`) VALUES ('$post_id', '$id', '$comment', '$img_name', '$replies')");
    
        if($insert_com){
            $post_row = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM publication WHERE post_id = '$post_id'"));
    
            $countCom = $post_row['comments'] + 1;
            $count = mysqli_query($conn, "UPDATE `publication` SET `comments` = '$countCom' WHERE post_id = '$post_id' ") or die('count failed');
            $_SESSION['id'] = $id;
            $poster_id = $post_row['user_id'];
            include "notification.php";
            $_SESSION['pst_id'] = $post_id;
            header("location: ../home/comment.php");
        } else{
            echo "error";
        }
    } else{
        echo "error";
    }
} else{
    $_SESSION['pst_id'] = $post_id;
    $message = "You can't Comment right now please  try again later";
    header("location: ../home/comment.php?err=$message");
}