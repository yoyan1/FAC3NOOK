<?php
    include "header.php";
    
    ?>
    <style>
        #home{
            background: var(--background-color); 
            color: var(--font-color);
        }
    </style>
    <main>
        <div class="feed_container">
            <?php include "left.php";?>
            
            <!--Center-->
            <div class="center">
                <div class="feed_con">
                    <?php if (isset($_GET['profile']) || isset($_GET['user'])){
                                if(isset($_GET['profile'])){
                                    $sel_post = mysqli_query($conn, "SELECT * FROM publication WHERE user_id = '$id' ORDER BY date DESC") or die("query failed");

                                    $user_query = mysqli_query($conn, "SELECT * FROM user WHERE id = '$id' ") or die("query failed");
                                    $user_in = mysqli_fetch_assoc($user_query);
                                    $_SESSION['id'] = $id;
                                } else{
                                    $get_id = $_GET['user'];
                                    $sel_post = mysqli_query($conn, "SELECT * FROM publication WHERE user_id = '$get_id' ORDER BY date DESC") or die("query failed");

                                    $user_query = mysqli_query($conn, "SELECT * FROM user WHERE id = '$get_id' ") or die("query failed");
                                    $user_in = mysqli_fetch_assoc($user_query);
                                    $_SESSION['id'] = $id;
                                }
                        
                        ?>
                    <div class="card">
                        <div class="card__img">
                                <h1>facenook</h1>
                        </div>
                        <div class="card__avatar">
                            <?php if($user_in['profile'] == ""){ ?>
                            <img src="../image/default-profile.png" width="80px" height="80px" alt="">
                            <?php } else{ ?>
                            <img src="../php/uploads/<?=$user_in['profile']?>" width="80px" height="80px" alt="">
                            <?php } ?>
                        </div>
                        <div class="card__title"><?=$user_in['fname']?></div>
                        <div class="card__subtitle">"<?=$user_in['biography']?>"</div>
                        <div class="card__wrapper">
                            <?php if(isset($_GET['profile'])){

                            } else{ ?>
                                <a href="../chat/index.php?userid=<?=$user_in['id']?>" class="card__btn">Message</a>
                            <?php } ?>
                        </div>
                    </div>
                    <?php } else{
                        $sel_post = mysqli_query($conn, "SELECT * FROM publication ORDER BY date DESC") or die("query failed");
                    } ?>
                    <?php if(isset($_GET['user']) && $_GET['user'] != $id){

                            } else{ ?>
                                <form action="../php/publish.php" method="post" enctype="multipart/form-data">
                                    <div class="post">
                                    <?php if($user['profile'] == ""){ ?>
                                        <img src="../image/default-profile.png" width="40px" height="40px" style="max-height: 40px;" alt="">
                                        <?php } else{ ?>
                                        <img src="../php/uploads/<?=$user['profile']?>" width="40px" height="40px" style="max-height: 40px;" alt="">
                                        <?php } ?>
                                        <input type="text" name="post" id="" placeholder="type something here...">
                                        <label for="img"><i class="fa-solid fa-image"></i></label>
                                        <input type="file" name="image" id="img" style="display: none;">
                                        <label for="post"><i class="fa-solid fa-paper-plane" style="color: #1F82F6;"></i></label>
                                        <button id="post" style="display: none;"></button>
                                    </div>
                                </form>
                            <?php } ?>
                    <!-- Feed -->
                    <b>News feed</b>
                    <?php   
                            while($row_post = mysqli_fetch_assoc($sel_post)){
                                $user_id = $row_post['user_id'];
                                $sel_user = mysqli_query($conn, "SELECT * FROM user WHERE id = '$user_id'");
                                $row_user = mysqli_fetch_assoc($sel_user);
                                $date = $row_post['date'];
                                $_SESSION['post_id'] = $row_post['post_id'];
                                ?>
                                
                                <div class="newsfeed">
                                    <div class="nav_profile">
                                    <?php if($row_user['profile'] == ""){ ?>
                                        <img src="../image/default-profile.png" width="40px" height="40px" style="max-height: 40px;" alt="">
                                    <?php } else{ ?>
                                        <img src="../php/uploads/<?=$row_user['profile']?>" width="40px" height="40px" style="max-height: 40px;" alt="">
                                        <?php } ?>
                                        <div class="name_wrap">
                                            <a href="profile.php?user=<?=$row_user['id']?>"><?=$row_user['fname']?></a>
                                            <p><?=getTimeLapse($date)?></p>
                                        </div>
                                        <?php if($row_post['user_id'] == $id && isset($_GET['profile'])){ ?>
                                                    <div class="option">
                                                        <div class="del">
                                                            <a href="home.php?del=<?=$row_post['id']?>" class="delete"><i class="fa-solid fa-trash"></i></a>
                                                        </div>
                                                    </div>
                                        <?php } else{}?>
                                    </div>
                                    <div class="user_post">
                                        <p><?=$row_post['post']?></p>
                                        <img src="../php/uploads/<?=$row_post['image']?>" alt="">
                                    </div>
                                    <div class="reaction_container">
                                        <div class="reaction_icon">
                                            <?php  $post_id =  $row_post['post_id'];
                                                    $react_row = mysqli_query($conn, "SELECT * FROM reactiondb WHERE reactor_id = '$id' AND post_id = '$post_id'");
                                                    // while($ROW_REACT = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM reactiondb WHERE  post_id = '$post_id'"))){
                                                    //     echo $ROW_REACT['react'];
                                                   
                                                    // }    
                                                        ?>
                                            <span href="#" id="like" >
                                                <?php  
                                                        $reaction = mysqli_fetch_assoc($react_row);
                                                        $reactionType = $reaction['react'];

                                                        if($reactionType == "like"){?>
                                                            <i class="fa-solid fa-thumbs-up" style="color:#1F82F6"></i>
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
                                                <form  class="reaction_wrap" id="form">
                                                    <a href="../php/reaction.php?like=<?=$post_id?>"><img src="../reaction/like.gif" width="50px" alt=""></a>
                                                    <a href="../php/reaction.php?heart=<?=$post_id?>" ><img src="../reaction/heart.gif" width="50px" alt=""></a>
                                                    <a href="../php/reaction.php?haha=<?=$post_id?>" ><img src="../reaction/haha.gif" width="50px" alt=""></a>
                                                    <a href="../php/reaction.php?wow=<?=$post_id?>" ><img src="../reaction/wow.gif" width="50px" alt=""></a>
                                                    <a href="../php/reaction.php?sad=<?=$post_id?>" ><img src="../reaction/sad.gif" width="50px" alt=""></a>
                                                    <a href="../php/reaction.php?angry=<?=$post_id?>" ><img src="../reaction/angry.gif" width="50px" alt=""></a>
                                                                                  
                                                </form>

                                                </div>
                                                <?php if($row_post['reaction'] > 0){ 
                                                        echo $row_post['reaction'];
                                                     } else{}?>
                                            </span><hr>
                                            <a href="comment.php?post_id=<?=$post_id?>" id="cm">
                                                <i class="fa-regular fa-comment"></i>
                                                <?php if($row_post['comments'] > 0){ 
                                                        echo $row_post['comments'];
                                                     } else{}?>
                                            </a>
                        
                                        </div>
                                    </div>
                                </div>
                                <?php } ?>
                        <p class="end">End of all post</p>
                </div>
                
            </div>
           <?php include "right.php" ?>
        </div>
    </main>
    <script>
        
        // document.addEventListener('DOMContentLoaded', function () {
        //     const forms = document.querySelectorAll('form');
        //     forms.forEach(function (form){
                
        //         const react_radio = form.querySelectorAll('input[name="react"]');
        //         react_radio.forEach(function (react) {
        //             react.addEventListener('change', function () {
                
        //             const react_type = form.querySelector('input[name="react"]:checked').value;
        //             const id = form.querySelector('input[name="id"]').value;
        //             var formData = new FormData(form);
        //             formData.append('react', react_type);
        //             formData.append('id', id);
                
        //                 fetch('../php/reaction.php', {
        //                     method: "POST",
        //                     body: formData
        //                 }).then(function (response) {
        //                     console.log(id);
        //                     // var type = document.getElementById('reaction');
        //                     // if(react_type == 'like'){
        //                     //     document.querySelector('.fa-thumbs-up').style.color = 'blue';
        //                     // } else if (react_type == 'heart'){
        //                     //     if(type.innrHTML != '<img src="../reaction/heart.gif" width="30px" alt="" id="reaction">'){
        //                     //         data.innerHTML = '<img src="../reaction/heart.gif" width="30px" alt="" id="reaction">';
        //                     //     } else{

        //                     //     }
        //                     // } else{}
        //                 })
                        
        //             });
        //         });
        //     })
        // })

    </script>
   