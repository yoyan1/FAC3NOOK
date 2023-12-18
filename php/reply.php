<?php
if (isset($_POST['submit']) || isset($_GET['c_id'])){

    include "../connection/dbcon.php";
    session_start();
    $id = $_SESSION['id'];
    $cm_id = $_GET['cm_id'];
    $reply = $_POST['reply'];

    $img_name = $_FILES['image']['name'];
    $img_size = $_FILES['image']['size'];
    $tmp_name = $_FILES['image']['tmp_name'];

    $img_upload_path = 'uploads/'.$img_name;
        move_uploaded_file($tmp_name, $img_upload_path);
    
    $insert_reply = mysqli_query($conn, "INSERT INTO `reply`(`cm_id`, `reply_uid`, `reply`, `image`) VALUES ('$cm_id', '$id', '$reply', '$img_name')");

    if($insert_reply){
        $sel_com = mysqli_query($conn, "SELECT * FROM comments WHERE id = '$cm_id'");
        $row_com = mysqli_fetch_assoc($sel_com);
        $post_id = $row_com['post_id'];
        $post_row = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM publication WHERE id = '$post_id'"));

        $countCom = $post_row['comments'] + 1;
        $countReply = $row_com['replies'] + 1;
        $count = mysqli_query($conn, "UPDATE `publication` SET `comments` = '$countCom' WHERE id = '$post_id' ") or die('count comments failed');
        $count_rep = mysqli_query($conn, "UPDATE `comments` SET `replies` = '$countReply' WHERE id = '$cm_id' ") or die('count replies failed');
        $_SESSION['id'] = $id;
        header("location: ../home/reply.php?cm_id=$cm_id");
    } else{
        echo "error";
    }
} else{
    echo "error";
}