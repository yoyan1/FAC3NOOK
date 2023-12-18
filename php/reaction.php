<?php
include "../connection/dbcon.php";
session_start();


    if(isset($_GET['like'])){
        $post_id = $_GET['like'];
        $reaction = "like";
    } else if(isset($_GET['heart'])){
        $post_id = $_GET['heart'];
        $reaction = "heart";
    } else if(isset($_GET['haha'])){
        $post_id = $_GET['haha'];
        $reaction = "haha";
    } else if(isset($_GET['wow'])){
        $post_id = $_GET['wow'];
        $reaction = "wow";
    } else if(isset($_GET['sad'])){
        $post_id = $_GET['sad'];
        $reaction = "sad";
    } else if(isset($_GET['angry'])){
        $post_id = $_GET['angry'];
        $reaction = "angry";
    } else{
        echo "error";
    }
    $id = $_SESSION['id'];

    $post_row = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM publication WHERE id = '$post_id'"));
    $react_row = mysqli_query($conn, "SELECT * FROM reactiondb WHERE reactor_id = '$id' AND post_id = '$post_id'") or die('check failed');
    $checkReact = mysqli_fetch_assoc($react_row);

    if(mysqli_num_rows($react_row) == 0){
        $countReact = $post_row['reaction'] + 1;
       
        $count = mysqli_query($conn, "UPDATE `publication` SET `reaction` = '$countReact' WHERE id = '$post_id' ") or die('count failed');
        $addReaction = mysqli_query($conn, "INSERT INTO `reactiondb`(`post_id`, `reactor_id`, `react`) VALUES ('$post_id', '$id', '$reaction')") or die("add failed");
        $_SESSION['id'] = $id;
        header("location: ../home/home.php");

    } else{
        $countReact = $post_row['reaction'] - 1;
        if($checkReact['react'] == $reaction){
            $count = mysqli_query($conn, "UPDATE `publication` SET `reaction` = '$countReact'  WHERE id = '$post_id' ") or die('count decrease failed');
            $deleteReaction = mysqli_query($conn, "DELETE FROM `reactiondb` WHERE reactor_id = '$id'") or die("delete failed");
            $_SESSION['id'] = $id;
            header("location: ../home/home.php");
        } else{
            $react_id = $checkReact['id'];
            $changeReact = mysqli_query($conn, "UPDATE `reactiondb` SET  react = '$reaction' WHERE id = '$react_id'")or die("update failed");
            $_SESSION['id'] = $id;
            header("location: ../home/home.php");
        }
    }
