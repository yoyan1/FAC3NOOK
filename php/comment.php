<?php
if (isset($_POST['submit']) || isset($_GET['post_id'])){

    include "../connection/dbcon.php";
    session_start();
    $id = $_SESSION['id'];
    $post_id = $_GET['post_id'];
    $comment = $_POST['comment'];
    $replies = 0;

    $img_name = $_FILES['image']['name'];
    $img_size = $_FILES['image']['size'];
    $tmp_name = $_FILES['image']['tmp_name'];

    $img_upload_path = 'uploads/'.$img_name;
        move_uploaded_file($tmp_name, $img_upload_path);
    
    $insert_com = mysqli_query($conn, "INSERT INTO `comments`(`post_id`, `commentorID`, `comment`, `image`, `replies`) VALUES ('$post_id', '$id', '$comment', '$img_name', '$replies')");

    if($insert_com){
        $post_row = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM publication WHERE id = '$post_id'"));

        $countCom = $post_row['comments'] + 1;
        $count = mysqli_query($conn, "UPDATE `publication` SET `comments` = '$countCom' WHERE id = '$post_id' ") or die('count failed');
        $_SESSION['id'] = $id;
        header("location: ../home/comment.php?post_id=$post_id");
    } else{
        echo "error";
    }
} else{
    echo "error";
}