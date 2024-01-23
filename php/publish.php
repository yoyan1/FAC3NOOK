<?php
    include "../connection/dbcon.php";
    include "user_session.php";

    $user_id = $_SESSION['id'];
    if($user['restriction'] != 'Restrict'){

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
            
            $insert = mysqli_query($conn, "INSERT INTO `publication`(`user_id`, `post`, `image`, `reaction`, `comments`, `warning`) VALUES('$user_id', '$post', '$img_name', '$reaction', $comments, '')") or die("query failed");
            $_SESSION['id'] = $user_id;
            $message = "Publish successfuly";
            header("location: ../home/home.php?suc=$message");
            
            
        }else{
            $_SESSION['id'] = $user_id;
            header("location: ../home/home.php");
        }
    } else{
        $message = "You can't Post rigth now please  try again later";
        header("location: ../home/home.php?err=$message");
    }
