<?php

session_start();
    if(isset($_SESSION['id'])){
        $id = $_SESSION['id'];

        $query = mysqli_query($conn, "SELECT * FROM user WHERE id = '$id' ") or die("query failed");
        $user = mysqli_fetch_assoc($query);

        $_SESSION['id'] = $id;
    } else{
        header("location: ../login.php");
    }