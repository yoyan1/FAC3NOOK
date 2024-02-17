<?php

session_start();
    if(isset($_SESSION['id'])){
        $id = $_SESSION['id'];

        $query = mysqli_query($conn, "SELECT * FROM user WHERE id = '$id' ") or die("query failed");
        $user = mysqli_fetch_assoc($query);

        $online = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM `browse_type` WHERE user = '$id'"));

        if($online['status'] == 'OFFLINE'){
            header("location: ../login.php");
        } else{
            
        }

        $_SESSION['id'] = $id;
    } else{
        header("location: ../login.php");
    }