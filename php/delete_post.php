<?php
    session_start();
    include "../connection/dbcon.php";
    $id = $_SESSION['id'];

    if(isset($_GET['post_id'])){
        $post_id = $_GET['post_id'];

        $delete = mysqli_query($conn, "DELETE FROM publication WHERE post_id = '$post_id'") or die("query failed");

        if($delete){
            $_SESSION['id'] = $id;
            //Check if there's comment in this post

            $Select_cm = mysqli_query($conn, "SELECT * FROM comments WHERE postid = '$post_id'");

            if($Select_cm){

                //Delete all comments in this post

                $delete_cm = mysqli_query($conn, "DELETE FROM comments WHERE postid = '$post_id'");
                $row_cm = mysqli_fetch_assoc($Select_cm);
                $cm_id = $row_cm['id'];
                //Delete all reply from this comment

                $delete_rply = mysqli_query($conn, "DELETE FROM reply WHERE cm_id = '$cm_id'");
                $message = "Successfuly deleted";
                header("location: ../home/profile.php?suc=$message");

            } else{
                header("location: ../home/profile.php");
            }

        } else{
            echo("error");
        }
    } else{
        echo("error");
    }