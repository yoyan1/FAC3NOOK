<?php
include "../connection/dbcon.php";

if(isset($_GET['key'])){
    $id = $_GET['key'];
    $role = $_POST['role'];
    $action = $_POST['action'];

    if($action == 'Warning'){
        $row = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM user WHERE id = '$id'"));
        $warning = $row['restriction'] + 1;

        $change = mysqli_query($conn, "UPDATE `user` SET `role` = '$role', `restriction`='$warning' WHERE id = '$id'");
    } elseif ($action == 'unrestrict' || $action == 'unbanned') {
        $reset = 0;
        $change = mysqli_query($conn, "UPDATE `user` SET `role` = '$role', `restriction`='$reset' WHERE id = '$id'");
    }else{
        $change = mysqli_query($conn, "UPDATE `user` SET `role` = '$role', `restriction`='$action' WHERE id = '$id'");
    }

    if($change){
        header("location: ../admin/members.php");

    } else{
        echo "<script>alert('Error')</script>";
        header("location: ../admin/members.php");
    }
}