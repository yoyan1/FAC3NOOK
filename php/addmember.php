<?php

if(isset($_POST['submit'])){
    include "../connection/dbcon.php";

    $fname = $_POST['name'];
    $uname = $_POST['uname'];
    $psw = md5($_POST['pass']);
    $role = $_POST['role'];

    $img_name = $_FILES['image']['name'];
    $img_size = $_FILES['image']['size'];
    $tmp_name = $_FILES['image']['tmp_name'];
    $error = $_FILES['image']['error'];

    $img_upload_path = 'uploads/'.$img_name;
    move_uploaded_file($tmp_name, $img_upload_path);
    
    $Insert = mysqli_query($conn, "INSERT INTO `user`(`fname`, `profile`, `address`, `birth_date`, `school`, `biography`, `username`, `password`, `role`, `restriction`) VALUES ('$fname', '$img_name', '', '', '', '', '$uname', '$psw', '$role', 0)");

    header("location: ../admin/members.php");
}