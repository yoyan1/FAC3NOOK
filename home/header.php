<?php
    include "../connection/dbcon.php";
    include "../php/date.php";
    include "../php/user_session.php";
   

    ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Facenook</title>
    <link rel="stylesheet" href="../stylesheet/home.css">
    <!-- font -->
    <link rel="stylesheet" href="../icon/fontawesome-free-6.4.2-web/css/all.min.css">

    <!-- ajax library -->
    <script src="../js/jquery.js"></script>
</head>
<body>

    <?php 
        
        $theme = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM `mode` WHERE uid = '$id'"));
        if($theme['theme'] == 'dark'){ ?>

    <style>
        :root{
            --background-color: #1b1b1b;;
            --font-color: #d8d0d0;
            --style-color:black;
            --input--color: #2e2d2d;
            --post-color: #2e2e2e;
            
            }
            
    </style>
    <?php } else{ ?>
        <style>
        :root{
            --font-color: #000000;
            --background-color: #e6e7e9c9; 
            --style-color: white;
            --input--color: #d3d9e4;
            --post-color: white; 
            }
            
    </style>
    <?php } ?>
    <div class="preloader">
        <div class="spinner">
            <div class="dot"></div>
            <div class="dot"></div>
            <div class="dot"></div>
            <div class="dot"></div>
            <div class="dot"></div>
        </div>
    </div>
    <?php if (isset($_GET['err'])) { ?>
        
        <div class="err">
            <i class="fa-regular fa-circle-xmark"></i>
            <p><?=$_GET['err']. "(Restricted)"?></p>
        </div>
    <?php } else{ }
        if (isset($_GET['suc'])) {?>
        <div class="suc">
            <i class="fa-regular fa-circle-check"></i>
            <p><?=$_GET['suc']?></p>
        </div>
    <?php } else{} ?>
    <header>
        <h1>facenook</h1>
        <div>
            <div class="profile">
                <!-- <div class="nav_but"> -->
                    <a href="#" onclick="showAll()">
                        <i class="fa-solid fa-comment-dots" id="notif"></i>
                        <?php $msg_count = mysqli_query($conn, "SELECT * FROM msg_count WHERE UID = '$id'");
                                $msg_disp_count = mysqli_fetch_assoc($msg_count);
                                if($msg_disp_count['count'] == 0){
                                    
                                } else{
                       ?>
                                   <span class="badge" ><?=$msg_disp_count['count']; }?></span>
                                   
                        
                    </a>
                    <a href="#" onclick="showNotif()" id="notif-wrap">
                        <i class="fa-solid fa-bell" id="notif"></i>
                        <?php $notify_count = mysqli_query($conn, "SELECT * FROM notif_count WHERE user_id = '$id'");
                                $display = mysqli_fetch_assoc($notify_count); 
                                 if($display['count'] == 0){
                                    
                                 } else{
                        ?>
                                    <span class="badge" ><?=(strlen($display['count']) > 2)? substr($display['count'],0,1)."+" : $display['count']; }?></span>
                                    
                    </a>
                <!-- </div> -->
              
                <?php if($user['profile'] == ""){ ?>
                <img src="../image/default-profile.png"   onclick="dropdown()" alt="" title="<?=$user['fname']?>">
                <?php } else{ ?>
                <img src="../php/uploads/<?=$user['profile']?>"  onclick="dropdown()" alt="" title="<?=$user['fname']?>">
                <?php }?>
                <a href="#" onclick="dropdown()" id="down"><i class="fa-solid fa-caret-down"></i></a>
                <a href="#" onclick="dropdown()" id="up" style="display: none;"><i class="fa-solid fa-caret-up"></i></a>
            </div>
            <div class="dropdown">
                <div>
                    <?php if($user['profile'] == ""){ ?>
                        <img src="../image/default-profile.png" height="50px" width="50px" alt="">
                    <?php } else{ ?>
                        <img src="../php/uploads/<?=$user['profile']?>" alt="" height="50px" width="50px">
                    <?php }?>
                </div>
                <div>
                    <h4><?=$user['fname']?></h4>
                    <p><?=$user['username']?></p>
                </div>
                    
                <div class="menu">
                    <a href="profile.php"> profile</a>
                    <a href="../input/edit.php" id="edit">edit profile</a>
                    <a href="../php/logout.php"> Log out</a>
                    <div>
                        <?php if($theme['theme'] == 'dark'){
                            echo "<a href='../php/theme.php' class='fa-solid fa-toggle-off' id='off'></a>";
                        } else{
                            echo "<a href='../php/theme.php' class='fa-solid fa-toggle-on' id='on'></a>";
                        }
                        ?>
                    </div>
                </div>
            </div>
            <div class="notif-dropdown" style="display:none;">
                <div class="notif-wrap">
                    <h1>Notifications</h1>
                    <b>New</b>
                    <?php $sel_notif = mysqli_query($conn, "SELECT * FROM `notification` LEFT JOIN publication ON publication.post_id = notification.postID   WHERE notification.userID = '$id' ORDER BY notif_date DESC");
                    if(mysqli_num_rows($sel_notif) > 0){
                        while($row_notif = mysqli_fetch_assoc($sel_notif)){
                                $SEL_u = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM user WHERE id = '".$row_notif['from_id']."'"));
                                $date_no = $row_notif['notif_date'];
                                
                                //Reaction type of Notification
                                if($row_notif['type'] == "Reaction" && $id != $SEL_u['id']){
                                    $SEL_react = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM `reactiondb` WHERE post_id = '".$row_notif['post_id']."'")); 
                                ?>
                                <a href="comment.php?post_id=<?=$row_notif['post_id']?>" class="row-notif">
                                    <div class="type_wrap">
                                        <?php if($SEL_u['profile'] == ""){ ?>
                                            <img src="../image/default-profile.png" height="50px" width="50px" alt="">
                                        <?php } else{ ?>
                                            <img src="../php/uploads/<?=$SEL_u['profile']?>" alt="" height="50px" width="50px">
                                            <?php }
                                            if($SEL_react['react'] == "haha"){
                                                echo "<span>😂</span>";
                                            } 
                                            elseif($SEL_react['react'] == "like"){
                                                echo "<span><i class='fa-solid fa-thumbs-up'></i></span>";
                                            }
                                            elseif($SEL_react['react'] == "heart"){
                                                echo "<span><i class='fa-solid fa-heart'></i></span>";
                                            }
                                            elseif($SEL_react['react'] == "wow"){
                                                echo "<span>😲</span>";
                                            } 
                                            elseif($SEL_react['react'] == "sad"){
                                                echo "<span>😥</span>";
                                            }
                                            else{
                                                echo "<span>😡</span>";
                                            }
                                        ?>
                                    </div>
                                    <div class="type">
                                        <p><b><?=$SEL_u['fname']?></b> reacted to your Post </p>
                                        <b class="hour"><?=getTimeLapse($date_no)?></b>
                                    </div>
                                </a>
                    <?php   }   //Comments
                                elseif($row_notif['type'] == "Comment" && $id != $SEL_u['id']){
                                    
                                ?>
                                <a href="comment.php?post_id=<?=$row_notif['post_id']?>" class="row-notif">
                                    <div class="type_wrap">
                                        <?php if($SEL_u['profile'] == ""){ ?>
                                            <img src="../image/default-profile.png" height="50px" width="50px" alt="">
                                        <?php } else{ ?>
                                            <img src="../php/uploads/<?=$SEL_u['profile']?>" alt="" height="50px" width="50px">
                                        <?php }?>
                                        <span><i class="fa-regular fa-comment"></i></span>
                                    </div>
                                    <div class="type">
                                        <p><b><?=$SEL_u['fname']?></b> Commented on your Post </p>
                                        <b class="hour"><?=getTimeLapse($date_no)?></b>
                                    </div>
                                </a>
                                <?php    } //REplies
                                elseif($row_notif['type'] == "Replied" && $id != $SEL_u['id']){
                                    $SEL_CM = mysqli_query($conn, "SELECT * FROM comments WHERE id = '".$row_notif['postID']."' ");
                                    $row_cm_notif = mysqli_fetch_assoc($SEL_CM);
                                    $UID = $SEL_u['id'];
                                    $SEL_rly = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM reply WHERE  reply_uid = '$UID' AND cm_id = '".$row_cm_notif['id']."'"));
                                    $SEL_pst = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM publication WHERE post_id = '".$row_cm_notif['postid']."'"));
                                    $SEL_u_frm_cm = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM user WHERE id = '".$SEL_pst['user_id']."'"));
                                    
                                    // Replies to your Comment on a post
                                    if($id == $row_cm_notif['commentorID'] && $SEL_pst['user_id'] != $SEL_u['id'] && $id != $SEL_rly['reply_uid'] && $SEL_pst['user_id'] != $id){ ?>

                                        <a href="reply.php?cm_id=<?=$row_cm_notif['id']?>" class="row-notif">
                                            <div class="type_wrap">
                                                <?php if($SEL_u['profile'] == ""){ ?>
                                                    <img src="../image/default-profile.png" height="50px" width="50px" alt="">
                                                <?php } else{ ?>
                                                    <img src="../php/uploads/<?=$SEL_u['profile']?>" alt="" height="50px" width="50px">
                                                <?php }?>
                                                <span><i class="fa-regular fa-comment"></i></span>
                                            </div>
                                        <div class="type">
                                            <p><b><?=$SEL_u['fname']?></b> Replied to your comment on a post</p>
                                            <b class="hour"><?=getTimeLapse($date_no)?></b>
                                        </div>
                                    </a>
                                    <?php   } 
                                        elseif($id == $row_cm_notif['commentorID'] && $SEL_pst['user_id'] == $SEL_u_frm_cm['id'] && $SEL_rly['reply_uid'] == $SEL_u_frm_cm['id']){
                                ?>
                                        <a href="reply.php?cm_id=<?=$row_cm_notif['id']?>" class="row-notif">
                                            <div class="type_wrap">
                                                <?php if($SEL_u['profile'] == ""){ ?>
                                                    <img src="../image/default-profile.png" height="50px" width="50px" alt="">
                                                <?php } else{ ?>
                                                    <img src="../php/uploads/<?=$SEL_u['profile']?>" alt="" height="50px" width="50px">
                                                <?php }?>
                                                <span><i class="fa-regular fa-comment"></i></span>
                                            </div>
                                        <div class="type">
                                            <p><b><?=$SEL_u['fname']?></b> Replied to your comment on her post  </p>
                                            <b class="hour"><?=getTimeLapse($date_no)?></b>
                                        </div>
                                    </a>
                                    
                                 <?php   } elseif($id != $row_cm_notif['commentorID'] && $id != $SEL_rly['reply_uid'] && $row_cm_notif['commentorID'] != $SEL_rly['reply_uid']){
                                ?>
                                        <a href="reply.php?cm_id=<?=$row_cm_notif['id']?>" class="row-notif">
                                            <div class="type_wrap">
                                                <?php if($SEL_u['profile'] == ""){ ?>
                                                    <img src="../image/default-profile.png" height="50px" width="50px" alt="">
                                                <?php } else{ ?>
                                                    <img src="../php/uploads/<?=$SEL_u['profile']?>" alt="" height="50px" width="50px">
                                                <?php }?>
                                                <span><i class="fa-regular fa-comment"></i></span>
                                            </div>
                                        <div class="type">
                                            <p><b><?=$SEL_u['fname']?></b> Replied to a comment on your post  </p>
                                            <b class="hour"><?=getTimeLapse($date_no)?></b>
                                        </div>
                                    </a>
                                    <?php   } elseif($id == $SEL_pst['user_id'] && $id == $row_cm_notif['commentorID']){
                                ?>
                                        <a href="reply.php?cm_id=<?=$row_cm_notif['id']?>" class="row-notif">
                                            <div class="type_wrap">
                                                <?php if($SEL_u['profile'] == ""){ ?>
                                                    <img src="../image/default-profile.png" height="50px" width="50px" alt="">
                                                <?php } else{ ?>
                                                    <img src="../php/uploads/<?=$SEL_u['profile']?>" alt="" height="50px" width="50px">
                                                <?php }?>
                                                <span><i class="fa-regular fa-comment"></i></span>
                                            </div>
                                        <div class="type">
                                            <p><b><?=$SEL_u['fname']?></b> Replied to your comment on your post  </p>
                                            <b class="hour"><?=getTimeLapse($date_no)?></b>
                                            
                                        </div>
                                    </a>
                                    <?php   } else{
                                ?>
                                        <a href="reply.php?cm_id=<?=$row_cm_notif['id']?>" class="row-notif">
                                            <div class="type_wrap">
                                                <?php if($SEL_u['profile'] == ""){ ?>
                                                    <img src="../image/default-profile.png" height="50px" width="50px" alt="">
                                                <?php } else{ ?>
                                                    <img src="../php/uploads/<?=$SEL_u['profile']?>" alt="" height="50px" width="50px">
                                                <?php }?>
                                                <span><i class="fa-regular fa-comment"></i></span>
                                            </div>
                                        <div class="type">
                                            <p><b><?=$SEL_u['fname']?></b> Replied to her comment on your post  </p>
                                            <b class="hour"><?=getTimeLapse($date_no)?></b>
                                            
                                        </div>
                                    </a>
                                
                            <?php } } } } else{
                            ?>
                                
                                <a href="" class="row-notif" style="min-width: 20rem">
                                            
                                        <div class="type">
                                            <p> No Notification  </p>
                                           
                                        </div>
                                    </a>
                            <?php } ?>
                </div>
            </div>
            
        </div>
       
    </header>
    
    <div class="message" style="display: none">
        <div class="msg">
            <a href="#" onclick="showAll()"><i class="fa-solid fa-arrow-left"></i> message</a>
        </div>
        <div class="all_list">
            <?php    $select = mysqli_query($conn, "SELECT * FROM user WHERE id != '$id' AND role = 'user' ") or die("query failed");
                     while($row = mysqli_fetch_assoc($select)){
                        $sender_id = $row['id'];
                        $msg_notif = mysqli_query($conn, "SELECT * FROM msg_notif WHERE frm_id = '$sender_id' AND to_id = '$id' ORDER BY id DESC") or die("connection failed");
                        $msg_db = mysqli_query($conn, "SELECT * FROM chat WHERE sender = '$sender_id' AND reciever = '$id' OR sender = '$id' AND reciever = '$sender_id' ORDER BY id DESC") or die("connection failed");
                        if (mysqli_num_rows($msg_notif) > 0){
                            $message = mysqli_fetch_assoc($msg_notif);
                            ?>
                                <div style="display: flex; justify-content: space-between;">
                                    <a href="../chat/index.php?userid=<?=$row['id']?>">
                                        <div class="list">
                                            <?php if($row['profile'] == ""){ ?>
                                                <img src="../image/default-profile.png" width="40px" height="40px" alt="">
                                            <?php } else{ ?>
                                                <img src="../php/uploads/<?=$row['profile']?>" width="40px" height="40px"  alt="">
                                            <?php } ?>
                                                <div>
                                                    <h4><?=$row['fname']?></h4>
                                                    <p style="color: var(--font-color); font-weight: 500"><span><?=mysqli_num_rows($msg_notif)?></span> <b><?=$message['message']?></b></p>
                                                </div>
                                        </div>
                                    </a>
                                </div>
                      <?php      
                        } elseif(mysqli_num_rows($msg_db) > 0){
                        $message = mysqli_fetch_assoc($msg_db);
                        
             ?>
            <div style="display: flex; justify-content: space-between;">
                <a href="../chat/index.php?userid=<?=$row['id']?>">
                    <div class="list">
                        <?php if($row['profile'] == ""){ ?>
                            <img src="../image/default-profile.png" width="40px" height="40px" alt="">
                        <?php } else{ ?>
                            <img src="../php/uploads/<?=$row['profile']?>" width="40px" height="40px"  alt="">
                        <?php } ?>
                            <div>
                                <h4><?=$row['fname']?></h4>
                                
                                <p><b>
                                    <?php
                                        if($message['sender'] == $id){

                                            echo "you: ", $message['message'];
                                        } else{
                                            echo $message['message'];
                                        }
                                    ?>
                                </b></p>
                            </div>
                    </div>
                </a>
             </div>
             <?php } else{} } ?>
            
        </div>
    </div>
     <!--Confirm Delete -->
    <?php if(isset($_GET['del'])){
            $get_post_id = $_GET['del'];
             ?>
   
        <div class="confirm">
            <div>
                <p>Are you sure you want to delete this user?</p>
                <span>
                    <a href="../php/delete_post.php?post_id=<?=$get_post_id?>" class="yes">Yes</a>
                    <a href="profile.php" >no</a>
                </span>
            </div>
        </div>
        <?php } else{} ?>
        
</body>

<script src="../js/home.js"></script>
<script src="../js/reaction.js"></script>
<script >


var notif = document.querySelector(".notif-dropdown");

// $(document).ready(function () {
//     function showNotif(){
//         var notif_disp = notif.style.display;
//         if(notif_disp == 'none'){
//             notif.style.display = 'block';
//             notif.style.height = "31rem";
//         } else{
//             notif.style.display ='none';
//             notif.style.height = '0';
//         }
    
//         
//     }
// })
function showNotif(){
    var notif_disp = notif.style.display;

    if(notif_disp == 'none'){
        setTimeout(function () {
            notif.style.display = 'block';
            notif.style.height = "31rem";
        }, 10)
    } else{
        setTimeout(function () {
            notif.style.display ='none';
            notif.style.height = '0';
    }, 10)
        // $('#notif-wrap').load('#notif-wrap');
    }

    fetch('../php/clear.php?id', {}).then(function () {
        document.querySelector('.badge').style.display = 'none';
    })
}
function showAll() {
   
   var msgDisplay = message.style.display;

   if(msgDisplay == "none"){
           message.style.display = "block";
       fetch('../php/clear_msg_notif.php?id', {
        
       }).then(function () {
           document.querySelector('.badge').style.display = 'none';
       })

   } else{
           message.style.display = "none";
   }

}
</script>
</html>