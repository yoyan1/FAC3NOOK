<?php
include "../connection/dbcon.php";

if(isset($_GET['key'])){
    $id = $_GET['key'];

    $row_post = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM publication WHERE post_id = '$id'"));
    $user_id = $row_post['user_id'];
    $action = $_POST['action'];

    if($action == 'Warning'){
        $row = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM user WHERE id = '$user_id'"));
        $warning = $row['restriction'] + 1;

        $change_user = mysqli_query($conn, "UPDATE `user` SET `restriction`='$warning' WHERE id = '$id'");
        $change = mysqli_query($conn, "UPDATE `publication` SET `warning`='Warned' WHERE post_id = '$id'");
    } 
    elseif($action == "Delete post"){
        $change = mysqli_query($conn, "DELETE FROM `publication` WHERE  `post_id` = '$id'") or die("delete failed");
    }
    else{
       echo "error";
    }

    if($change){
        header("location: ../admin/users_post.php");

    } else{
        echo "<script>alert('Error')</script>";
    }
}