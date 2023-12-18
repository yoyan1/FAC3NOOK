<?php
    include "../connection/dbcon.php";
    session_start();

    $user_id = $_SESSION['id'];

    if(isset($_POST['post']) || isset($_FILES['image'])){

        $post = $_POST['post'];
        $reaction = 0;
        $comments = 0;

        $img_name = $_FILES['image']['name'];
        $img_size = $_FILES['image']['size'];
        $tmp_name = $_FILES['image']['tmp_name'];
        $error = $_FILES['image']['error'];

        $img_upload_path = 'uploads/'.$img_name;
        move_uploaded_file($tmp_name, $img_upload_path);
        
        $insert = mysqli_query($conn, "INSERT INTO `publication`(`user_id`, `post`, `image`, `reaction`, `comments`) VALUES('$user_id', '$post', '$img_name', '$reaction', $comments)") or die("query failed");
        $_SESSION['id'] = $user_id;
        header("location: ../home/home.php");

        
    }else{
        $_SESSION['id'] = $user_id;
        header("location: ../home/home.php");
    }
