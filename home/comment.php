<?php
 include "header.php";
 
 ?>
    <main>
        <div class="feed_container">
            <?php include "left.php" ?>
            <div class="center">
                <div class="feed_con">
                    <?php       isset($_GET['post_id']) ? $postID = $_GET['post_id'] : $postID = $_SESSION['pst_id'];
                                $sel_post = mysqli_query($conn, "SELECT * FROM publication WHERE post_id = '$postID' ORDER BY date DESC") or die("query failed");
                                $row_post = mysqli_fetch_assoc($sel_post);
                                $user_id = $row_post['user_id'];
                                $sel_user = mysqli_query($conn, "SELECT * FROM user WHERE id = '$user_id'");
                                $row_user = mysqli_fetch_assoc($sel_user);
                                $date = $row_post['date'];
                                $_SESSION['post_id'] = $row_post['post_id'];
                                ?>
                                
                                <div class="newsfeed">
                                    <div class="nav_profile">
                                    <?php if($row_user['profile'] == ""){ ?>
                                        <img src="../image/default-profile.png" width="40px" height="40px" alt="">
                                    <?php } else{ ?>
                                        <img src="../php/uploads/<?=$row_user['profile']?>" width="40px" height="40px" alt="">
                                        <?php } ?>
                                        <div class="name_wrap">
                                            <a href="profile.php?user=<?=$row_user['id']?>"><?=$row_user['fname']?></a>
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
                                                <?php   $post_id =  $row_post['post_id'];
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
                                            <?php $select_com = mysqli_query($conn, "SELECT * FROM `comments` WHERE postid = '$post_id' ORDER BY date DESC") or die('select failed');
                                                  while($row_com = mysqli_fetch_assoc($select_com)){
                                                        $commentorID = $row_com['commentorID'];
                                                        $select_user_com = mysqli_query($conn, "SELECT * FROM user WHERE id = '$commentorID'");
                                                        $row_user_com = mysqli_fetch_assoc($select_user_com);
                                                        $cm_id = $row_com['id'];
                                                        
                                                ?>
                                            <div class="commenter">
                                            <?php if($row_user_com['profile'] == ""){ ?>
                                                <img src="../image/default-profile.png" width="40px" height="40px" alt="">
                                            <?php } else{ ?>
                                                <img src="../php/uploads/<?=$row_user_com['profile']?>" width="40px" height="40px" alt="">
                                                <?php } ?>
                                                <div class="text_wrap">
                                                    <a href="profile.php?user=<?=$row_user_com['id']?>"><?=$row_user_com['fname']?></a>
                                                    <h5><?=$row_com['comment']?></h5>
                                                    <img src="../php/uploads/<?=$row_com['image']?>" width="150px" alt="">
                                                </div>
                                            </div>
                                            <div class="action_com">
                                                <p><?=getTimeLapse($row_com['date'])?></p>
                                                <?php if($row_com['replies'] > 0){ ?>
                                                        <a href="reply.php?cm_id=<?=$row_com['id']?>"><?=$row_com['replies']?> replies</a>
                                                <?php } else{ ?>
                                                    <a href="reply.php?cm_id=<?=$row_com['id']?>">reply</a>
                                                <?php } ?>
                                            </div>
                                            <?php if($row_com['replies'] > 0){ ?>
                                                <div class="reply">
                                                    <?php   $sel_reply = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM reply WHERE cm_id = '$cm_id' ORDER BY date DESC"));
                                                            $user_reply_id = $sel_reply['reply_uid'];
                                                            $sel_user_reply = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM user WHERE id = '$user_reply_id'"));
                                                            if($sel_user_reply['profile'] == ""){ ?>
                                                        <img src="../image/default-profile.png" width="25x" height="25px" alt="">
                                                    <?php } else{ ?>
                                                        <img src="../php/uploads/<?=$sel_user_reply['profile']?>" width="25px" height="25px" alt="">
                                                        <?php } ?>
                                                        <div class="text_wrap">
                                                            <a href="reply.php?cm_id=<?=$row_com['id']?>"><?=$sel_user_reply['fname']?> </a>
                                                            <h5><?=$sel_reply['reply']?></h5>
                                                        </div>
                                                </div>
                                            <?php } else{
                                                
                                            } } ?>
                                        </div>
                                    </div>
                                    <form action="../php/comment.php?post_id=<?=$post_id?>" method="POST" enctype="multipart/form-data" class="comment">
                                        <?php if($user['profile'] == ""){ ?>
                                            <img src="../image/default-profile.png" width="40px" height="40px" alt="">
                                        <?php } else{ ?>
                                            <img src="../php/uploads/<?=$user['profile']?>" width="40px" height="40px" alt="">
                                        <?php } ?>
                                        <input type="text" name="comment" id="" placeholder="comment something here..">
                                        <label for="img"><i class="fa-solid fa-image"></i></label>
                                        <input type="file" name="image" id="img" style="display: none;">
                                        <label for="post"><i class="fa-solid fa-paper-plane" style="color: #1F82F6;"></i></label>
                                        <button id="post" style="display: none;" name="submit"></button>
                                    </form>
                                </div>
                </div>
                
            </div>
            <?php include "right.php" ?>
        </div>
    </main>
   