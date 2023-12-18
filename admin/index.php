<?php
    include "../connection/dbcon.php";
    include "../php/date.php";
    session_start();

    $id = $_SESSION['id'];

    $select = mysqli_query($conn, "SELECT * FROM user WHERE id = '$id'") or die ("query failed");
    $admin = mysqli_fetch_assoc($select);

    $_SESSION['id'] = $id;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <link rel="stylesheet" href="../stylesheet/admin.css">
    <link rel="stylesheet" href="../icon/fontawesome-free-6.4.2-web/css/all.min.css">
</head>
    <div class="main">
        <div class="left">
            <div class="container">
                <div class="name">
                    <h1>Facenook</h1>
                </div><hr>
                <div class="nav_bar">
                    
                    <a href=""><i class="fa-solid fa-user"></i> user</a>
                    <a href=""><i class="fa-solid fa-newspaper"></i> feed</a>
                    <a href=""><i class="fa-solid fa-right-from-bracket"></i> log out</a>
                </div><hr>
                <div class="management">
                    <h4>Facenook Management</h4>
                    <div class="list">
                        <a><i class="fa-solid fa-circle" style="color:red"></i> Human Resource</a>
                        <a><i class="fa-solid fa-circle" style="color:yellow"></i> Incident</a>
                        <a><i class="fa-solid fa-circle" style="color:skyblue"></i> Hazard</a>
                        <a><i class="fa-solid fa-circle" style="color:aqua"></i> Document</a>
                        <a><i class="fa-solid fa-circle" style="color:green"></i> Emergency</a>
                        <a><i class="fa-solid fa-circle" style="color:darkmagenta"></i> Action</a>
                        <a><i class="fa-solid fa-circle" style="color:orangered"></i> Training</a>
                        <a><i class="fa-solid fa-circle" style="color:maroon"></i> Journey</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="center">
            <div class="main_con">
                <div class="top">
                   <p>overview</p> 
                   <a href="#" onclick="addNew()"><i class="fa-solid fa-plus "></i> new user</a>
                </div>
                <?php if(isset($_GET['id'])){
                    $_SESSION['user_id'] = $_GET['id'];
                ?>
                <div class="edit">
                    <div class="head">
                        <h3>edit user role</h3>
                        <a href="index.php"><i class="fa-solid fa-close"></i></a>
                    </div>
                    <form action="">
                        <label for="role"> New role:</label>
                        <select name="role" id="role">
                            <option value="user">user</option>
                            <option value="admin">admin</option>
                        </select>
                        <button>Submit</i></button>
                    </form>
                </div>
                <?php }else{} ?>
                <div class="new_user" id="addNew" >
                    <div class="head">
                        <h4>Add new user</h4>
                        <a href="index.php"><i class="fa-solid fa-close"></i></a>
                    </div>
                    <form action="">
                        <div class="form_con">
                            <div>
                                <label for="name">Fullname</label><br>
                                <input type="text" name="fname" id="name">
                            </div>
                            <div>
                                <label for="uname">username</label><br>
                                <input type="text" name="uname" id="uname">
                            </div>
                            <div>
                                <label for="pass">password</label><br>
                                <input type="password" name="pass" id="pass">
                            </div>
                        </div>
                        <div>
                            <label for="role">Role</label>
                            <select name="role" id="role">
                                <option value="user">user</option>
                                <option value="admin">admin</option>
                            </select>
                        </div>
                        <button><i class="fa-solid fa-plus "></i> Add</button>
                    </form>
                </div>
                <div class="user">
                    <div class="head">
                        <h3>Users</h3>
                        <select name="" id="">
                            <option value="date">sort by date</option>
                            <option value="name">sort by name</option>
                            <option value="role">sort by roles</option>
                        </select>
                    </div>
                    <div class="scroll">
                        <?php  
                                $index = 0;
                                $sel_user = mysqli_query($conn, "SELECT * FROM user WHERE id !='$id' ") or die("query failed");
                                while($user_row = mysqli_fetch_assoc($sel_user)){
                                    $index++;
                                ?>
                            <div class="user_column">
                            <div class="user_info">
                                <div>
                                    <p><?=$index?></p>
                                </div>
                                <?php if($user_row['profile'] == ""){ ?>
                                    <img src="../image/default-profile.png" width="40px" alt="">
                                <?php } else{ ?>
                                    <img src="../php/uploads/<?=$user_row['profile']?>" width="40px" alt="">
                                    <?php } ?>
                                <div>
                                    <h5 style="width: 10rem"><?=$user_row['fname']?></h5>
                                    <h6><?=$user_row['username']?></h6>
                                </div>
                            </div>
                                <div>
                                    <p>password</p>
                                    <b><?=$user_row['password']?></b>
                                </div>
                                <div>
                                    <p>role</p>
                                    <b>user</b>
                                </div>
                                <div>
                                    <p>Action</p>
                                    <div class="action">
                                        <a href="index.php?id=<?=$user_row['id']?>" id="edit"><i class="fa-solid fa-pen-to-square"></i></a>
                                        <a href="index.php?del=<?=$user_row['id']?>" class="delete"><i class="fa-solid fa-trash"></i></a>
                                    </div>
                            </div>
                        </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
        <?php if(isset($_GET['del'])){
            $user_id = $_GET['del'];
             ?>

        <div class="confirm">
            <div>
                <p>Are you sure you want to delete this user?</p>
                <span>
                    <a href="../php/delete_user.php?user_id=<?=$user_id?>" class="yes">Yes</a>
                    <a href="index.php" >no</a>
                </span>
            </div>
        </div>
        <?php } else{} ?>
        <div class="right">
            <div class="footer">
                <div class="admin">
                    <a href="#notif"><i class="fa-regular fa-bell"></i><p>50+</p></a>
                    <img src="../image/IMG_20230321_212533.jpg" width="40px" alt="">
                    <p>admin</p>
                </div>
                <i class="fa-regular fa-bell"></i><hr>
                <div class="notif_con">
                    <?php $sel_post = mysqli_query($conn, "SELECT * FROM publication ORDER BY date DESC");
                        while($row_post = mysqli_fetch_assoc($sel_post)){
                            $post_id = $row_post['user_id'];
                            $date = $row_post['date'];
                            $Sel_user_post = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM user WHERE id = '$post_id' "))
                        ?>
                            <div class="notif" id="notif">
                                <p><?=$Sel_user_post['fname']?> post an update</p>
                                <p>"<?=$row_post['post']?>"</p>
                                <tt><?=getTimeLapse($date)?></tt>
                            </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</body>
<script src="../js/admin.js"></script>
</html>