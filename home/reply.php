<?php
    include "../connection/dbcon.php";
    include "../php/date.php";
    session_start();

    $id = $_SESSION['id'];

    $query = mysqli_query($conn, "SELECT * FROM user WHERE id = '$id' ") or die("query failed");
    $user = mysqli_fetch_assoc($query);

    $_SESSION['id'] = $id;
    if(isset($_GET['cm_id'])){
        $cm_id = $_GET['cm_id'];
        $select_com = mysqli_query($conn, "SELECT * FROM `comments` WHERE id = '$cm_id'") or die('select failed');
        $row_com = mysqli_fetch_assoc($select_com);
        $postID = $row_com['post_id'];
        $sel_post = mysqli_query($conn, "SELECT * FROM publication WHERE id = '$postID'") or die("query failed");
        $row_post = mysqli_fetch_assoc($sel_post);
        $user_id = $row_post['user_id'];
        $sel_user = mysqli_query($conn, "SELECT * FROM user WHERE id = '$user_id'");
        $row_user = mysqli_fetch_assoc($sel_user);
        $date = $row_post['date'];
        $_SESSION['post_id'] = $row_post['id'];

    } else{
        echo "error";
    }

    ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Facenook</title>
    <link rel="stylesheet" href="../stylesheet/home.css">
    <link rel="stylesheet" href="../stylesheet/reply.css">
    <!-- <script src="https://kit.fontawesome.com/ee4c203372.js"></script> -->
    <link rel="stylesheet" href="../icon/fontawesome-free-6.4.2-web/css/all.min.css">
</head>
<body>
    <div class="preloader">
        <div class="spinner">
            <div class="dot"></div>
            <div class="dot"></div>
            <div class="dot"></div>
            <div class="dot"></div>
            <div class="dot"></div>
        </div>
    </div>
    <header>
        <h1>facenook</h1>
        <div>
            <div class="profile">
                <h3><?=$user['fname']?></h3>
                <?php if($user['profile'] == ""){ ?>
                <img src="../image/default-profile.png" alt="">
                <?php } else{ ?>
                <img src="../php/uploads/<?=$user['profile']?>" alt="">
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
                <a href="home.php?profile"> profile</a>
                <a href="../input/edit.php" id="edit">edit profile</a>
                <a href="../login.php"> Log out</a>
                <div>
                    <i class="fa-solid fa-toggle-off" id="off" style="display: block;" onclick="darkMode()"></i>
                    <i class="fa-solid fa-toggle-on" id="on" style="display: none;" onclick="lightMode()"></i>
                </div>
            </div>
            
        </div>
        </div>
       
    </header>
    <main>
        <div class="feed_container">
            <div class="left">
                <div class="left_wrap">
                    <div class="nav">
                        <a href="">    
                            <div class="nav_profile">
                            <?php if($user['profile'] == ""){ ?>
                                <img src="../image/default-profile.png" width="40px" height="40px" alt="">
                                <?php } else{ ?>
                                    <img src="../php/uploads/<?=$user['profile']?>" width="40px" height="40px" alt="">
                                <?php } ?>
                                <div>
                                    <h4><?=$user['fname']?></h4>
                                    <p>Web developer</p>
                                </div>
                            </div>
                        </a>
                        <a href="home.php" class="a1"><i class="fa-solid fa-house"></i> News feed</a>
                        <a href="home.php?profile" class="a1"><i class="fa-solid fa-user"></i> profile</a>
                        <a href="#" onclick="showAll()" class="a1"><i class="fa-solid fa-comment-dots"></i> message</a>
                    </div>
                    <div class="about">
                        <p>Welcome to</p>
                        <h1>Facenook</h1>
                        <img src="../image/undraw_mobile_content_xvgr.svg" width="150px" alt="">
                    </div>
                </div>
                </div>
            <div class="center">
                <div class="feed_con">
                                <div class="newsfeed">
                                    <div class="nav_profile">
                                    <?php if($row_user['profile'] == ""){ ?>
                                        <img src="../image/default-profile.png" width="40px" height="40px" alt="">
                                    <?php } else{ ?>
                                        <img src="../php/uploads/<?=$row_user['profile']?>" width="40px" height="40px" alt="">
                                        <?php } ?>
                                        <div class="name_wrap">
                                            <a href="home.php?user=<?=$row_user['id']?>"><?=$row_user['fname']?></a>
                                            <p><?=getTimeLapse($date)?></p>
                                        </div>

                                    </div>
                                    <div class="user_post">
                                        <p><?=$row_post['post']?></p>
                                        <img src="../php/uploads/<?=$row_post['image']?>" alt="">
                                    </div>
                                    <div class="reaction_container">
                                        <div class="reaction_icon">
                                            <span href="#" id="like" >
                                                <?php   $post_id =  $row_post['id'];
                                                        $react_row = mysqli_query($conn, "SELECT * FROM reactiondb WHERE reactor_id = '$id' AND post_id = '$post_id'");
                                                        $reaction = mysqli_fetch_assoc($react_row);
                                                        $reactionType = $reaction['react'];

                                                        if($reactionType == "like"){?>
                                                            <i class="fa-solid fa-thumbs-up" style="color: #005eff;"></i>
                                                    <?php } else if($reactionType == "heart"){?>
                                                                <img src="../reaction/heart.gif" width="30px" alt="" id="reaction">
                                                    <?php } else if($reactionType == "haha"){?>
                                                                <img src="../reaction/haha.gif" width="30px" alt="" id="reaction">
                                                    <?php } else if($reactionType == "wow"){?>
                                                                <img src="../reaction/wow.gif" width="30px" alt="" id="reaction">
                                                    <?php } else if($reactionType == "sad"){?>
                                                                <img src="../reaction/sad.gif" width="30px" alt="" id="reaction">
                                                    <?php } else if($reactionType == "angry"){?>
                                                                <img src="../reaction/angry.gif" width="30px" alt="" id="reaction">
                                                    <?php } else { ?>
                                                                <i class="fa-regular fa-thumbs-up"></i>
                                                    <?php } ?>
                                                <div class="reaction_list" >
                                                    <form  class="reaction_wrap" >
                                                        <a href="../php/reaction.php?like=<?=$post_id?>"><img src="../reaction/like.gif" width="50px" alt=""> </a>
                                                        <a href="../php/reaction.php?heart=<?=$post_id?>"><img src="../reaction/heart.gif" width="50px" alt=""></a>
                                                        <a href="../php/reaction.php?haha=<?=$post_id?>"><img src="../reaction/haha.gif" width="50px" alt=""></a>
                                                        <a href="../php/reaction.php?wow=<?=$post_id?>"><img src="../reaction/wow.gif" width="50px" alt=""></a>
                                                        <a href="../php/reaction.php?sad=<?=$post_id?>"><img src="../reaction/sad.gif" width="50px" alt=""></a>
                                                        <a href="../php/reaction.php?angry=<?=$post_id?>"><img src="../reaction/angry.gif" width="50px" alt=""></a>
                                                    </form>
                                                </div>
                                                <?php if($row_post['reaction'] > 0){ 
                                                        echo $row_post['reaction'];
                                                     } else{}?>
                                            </span>
                                            <a href="comment.php?post_id=<?=$post_id?>" id="cm">
                                                <i class="fa-regular fa-comment"></i>
                                                <?php if($row_post['comments'] > 0){ 
                                                        echo $row_post['comments'];
                                                     } else{}?>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="comment_con">
                                        <div class="comment_wrap">
                                            <?php 
                                                        $commentorID = $row_com['commentorID'];
                                                        $select_user_com = mysqli_query($conn, "SELECT * FROM user WHERE id = '$commentorID'");
                                                        $row_user_com = mysqli_fetch_assoc($select_user_com);
                                                ?>
                                            <div class="commenter">
                                            <?php if($row_user_com['profile'] == ""){ ?>
                                                <img src="../image/default-profile.png" width="40px" height="40px" alt="">
                                            <?php } else{ ?>
                                                <img src="../php/uploads/<?=$row_user_com['profile']?>" width="40px" height="40px" alt="">
                                                <?php } ?>
                                                <div class="text_wrap">
                                                    <a href="home.php?user=<?=$row_user_com['id']?>"><?=$row_user_com['fname']?></a>
                                                    <h5><?=$row_com['comment']?></h5>
                                                    <img src="../php/uploads/<?=$row_com['image']?>" width="150px" alt="">
                                                </div>
                                            </div>
                                            <div class="action_com">
                                                <p><?=getTimeLapse($row_com['date'])?></p> 
                                                <a href="">Reply</a>
                                            </div>
                                            <div class="reply_con">
                                                <?php $sel_reply = mysqli_query($conn, "SELECT * FROM reply WHERE cm_id = '$cm_id'");  
                                                        while($row_reply = mysqli_fetch_assoc($sel_reply)){ 
                                                            $user_reply_ID = $row_reply['reply_uid'];
                                                            $select_user_reply = mysqli_query($conn, "SELECT * FROM user WHERE id = '$user_reply_ID'");
                                                            $row_user_reply = mysqli_fetch_assoc($select_user_reply);
                                                            ?>
                                                    <div class="reply">
                                                        <?php if($row_user['profile'] == ""){ ?>
                                                            <img src="../image/default-profile.png" width="40x" height="40px" alt="">
                                                        <?php } else{ ?>
                                                            <img src="../php/uploads/<?=$row_user_reply['profile']?>" width="40px" height="40px" alt="">
                                                            <?php } ?>
                                                            <div class="text_wrap">
                                                                <a href="home.php?user=<?=$row_user_reply['id']?>"><?=$row_user_reply['fname']?> </a>
                                                                <h5><?=$row_reply['reply']?></h5>
                                                            </div>
                                                    </div>
                                                    <div class="action_com">
                                                        <p><?=getTimeLapse($row_reply['date'])?></p>
                                                        <a href="">Reply</a>
                                                    </div>
                                                    <?php } ?>
                                                        <form action="../php/reply.php?cm_id=<?=$cm_id?>" method="POST" enctype="multipart/form-data" class="comment">
                                                                <?php if($user['profile'] == ""){ ?>
                                                                    <img src="../image/default-profile.png" width="40px" height="40px" alt="">
                                                                <?php } else{ ?>
                                                                    <img src="../php/uploads/<?=$user['profile']?>" width="40px" height="40px" alt="">
                                                                <?php } ?>
                                                                    <input type="text" name="reply" id="" placeholder="reply..">
                                                                    <label for="img"><i class="fa-solid fa-image"></i></label>
                                                                    <input type="file" name="image" id="img" style="display: none;">
                                                                    <label for="post"><i class="fa-solid fa-paper-plane" style="color: #1F82F6;"></i></label>
                                                                    <button id="post" style="display: none;" name="submit"></button>
                                                    </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                </div>
                
            </div>
            <div class="right">
                <div class="right_wrapper">
                    <div class="bio">
                        <h4>Biography</h4>
                        <p><?=$user['biography']?></p>
                        <!-- <a href=""><b>Read more</b> <i class="fa-solid fa-chevron-down"></i></a> -->
                        <div class="more">
                            <p><i class="fa-solid fa-location-dot"></i> <?=$user['address']?></p>
                            <p><i class="fa-solid fa-cake-candles"></i> <?=$user['birth_date']?></p>
                            <p><i class="fa-solid fa-school"></i> <?=$user['school']?></p>
                            
                        </div>
                        <div class="social">
                            <b>Social</b>
                            <div>
                                <a target="_blank" href="https://www.google.com" class="social-con containerone"><i id="social_icon" class="fa-brands fa-google"></i></a>
                                <a target="_blank" href="https://www.facebook.com" class="social-con containertwo"><i id="social_icon" class="fa-brands fa-square-facebook"></i></a>
                                <a target="_blank" href="https://www.instagram.com" class="social-con containerthree"><i id="social_icon" class="fa-brands fa-instagram"></i></a>
                                <a target="_blank" href="https://www.twitter.com" class="social-con containerfour"><i id="social_icon" class="fa-brands fa-twitter"></i></a>
                                <a target="_blank" href="https://www.github.com" class="social-con containerfive"><i id="social_icon" class="fa-brands fa-github"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="user">
                        <div class="wrap">
                            <b>Who to Know?</b>
                            <a href="#" onclick="showAll()">Show all</a>
                        </div>
                        <div class="velocity">
                           <?php    $select = mysqli_query($conn, "SELECT * FROM user WHERE id != '$id' AND role = 'user' ") or die("query failed");
                                    while($row = mysqli_fetch_assoc($select)){
                            ?>
                            <a href="home.php?user=<?=$row['id']?>">
                                <div style="display: flex; justify-content: space-between;">
                                    <div class="list">
                                    <?php if($row['profile'] == ""){ ?>
                                        <img src="../image/default-profile.png" width="40px" height="40px" alt="">
                                    <?php } else{ ?>
                                        <img src="../php/uploads/<?=$row['profile']?>" width="40px" height="40px"  alt="">
                                    <?php } ?>
                                        <div>
                                            <h4><?=$row['fname']?></h4>
                                            <p><?=$row['role']?></p>
                                        </div>
                                    </div>
                                    <div class="icon">
                                        <a href="../chat/index.php?userid=<?=$row['id']?>" target="_blank" title="message"><i class="fa-regular fa-comment-dots"></i></a>
                                        <a href="" title="more"><i class="fa-solid fa-ellipsis-vertical"></i></a>
                                    </div>
                                </div>
                            </a>
                            <?php } ?>
                           
                        </div>
                        
                    </div>
                </div>
                
            </div>
        </div>
    </main>
    <div class="message" style="display: none">
        <div class="msg">
            <a href="#" onclick="showAll()"><i class="fa-solid fa-arrow-left"></i> message</a>
        </div>
        <div class="all_list">
            <?php    $select = mysqli_query($conn, "SELECT * FROM user WHERE id != '$id' AND role = 'user' ") or die("query failed");
                     while($row = mysqli_fetch_assoc($select)){
                        $sender_id = $row['id'];
                        $msg_db = mysqli_query($conn, "SELECT * FROM chat WHERE sender = '$sender_id' ORDER BY id DESC") or die("connection failed");
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
                             <p><b><?=$message['message']?></b></p>
                         </div>
                    </div>
                </a>
             </div>
             <?php } ?>
            
        </div>
    </div>
</body>
<script src="../js/home.js"></script>
<script >
like.forEach((reaction) => {
    reaction.addEventListener('mouseover', function() {
        const reactionContent = reaction.querySelector('.reaction_list');
        reactionContent.style.display = 'block';
    });

    reaction.addEventListener('mouseout', function() {
        const reactionContent = reaction.querySelector('.reaction_list');
        reactionContent.style.display = 'none';
    });

    reaction.querySelector('.reaction_list').addEventListener('mouseover', function() {
        this.style.display = 'block';
    });

    reaction.querySelector('.reaction_list').addEventListener('mouseout', function() {
        this.style.display = 'none';
    });
});
</script>
</html>