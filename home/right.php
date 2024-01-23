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
                <a href="profile.php?user=<?=$row['id']?>">
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
                            <a href="../chat/index.php?userid=<?=$row['id']?>" title="message"><i class="fa-regular fa-comment-dots"></i></a>
                            
                        </div>
                    </div>
                </a>
                <?php } ?>
               
            </div>
            
        </div>
    </div>
    
</div>