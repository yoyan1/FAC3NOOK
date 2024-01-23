<style>
    .a1{
        margin-left: 5px;
    }
</style>
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
            <a href="home.php" class="a1" id="home"><i class="fa-solid fa-house" style="margin-right:15px"></i> News feed</a>
            <a href="profile.php" class="a1" id="profile"><i class="fa-solid fa-user" style="margin-right:20px"></i> Profile</a>
            
        </div>
        <div class="about">
            <p>Welcome to</p>
            <h1>Facenook</h1>
            <img src="../image/undraw_mobile_content_xvgr.svg" width="150px" alt="">
        </div>
    </div>
</div>