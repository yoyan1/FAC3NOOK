<?php
    session_start();
    include "../connection/dbcon.php";
    $admin = $_SESSION['id'];

    if(isset($_GET['user_id'])){
        $id = $_GET['user_id'];

        $delete = mysqli_query($conn, "DELETE FROM user WHERE id = '$id'") or die("query failed");

        if($delete){
            $_SESSION['id'] = $admin;
            header("location: ../admin/index.php");

        } else{
            echo("error");
        }
    } else{
        echo("error");
    }