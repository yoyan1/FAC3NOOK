<?php
    session_start();
    include "../connection/dbcon.php";

    $id = $_SESSION['id'];

    $select = mysqli_query($conn, "SELECT * FROM user WHERE id = '$id'") or die('query failed');
    $user = mysqli_fetch_assoc($select);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Facenook</title>
    <link rel="stylesheet" href="../stylesheet/index.css">
    <link rel="stylesheet" href="../stylesheet/edit.css">
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
    <main>
        <div class="container">
            <div class="getStarted">
                    <div class="div_container">
                        <div class="form_wrap">
                            <div class="input_wrap">
                                <form action="../php/profile.php" method="POST" enctype="multipart/form-data">
                                    <div class="img_input">
                                        <?php if($user['profile'] == ""){ ?>
                                            <img src="../image/default-profile.png" alt="" class="pp">
                                        <?php } else{ ?>
                                            <img src="../php/uploads/<?=$user['profile']?>" alt="" class="pp">
                                        <?php } ?>
                                        <input type="file" name="image" id="img">
                                    </div>
                                    <div>
                                        <label for="adrs">Address</label>
                                        <input type="text" name="address" id="adrs" value="<?=$user['address']?>">
                                    </div>
                                    <div>
                                        <label for="b_date">Birth date</label>
                                        <input type="date" name="b_date" id="b_date" value="<?=$user['birth_date']?>">
                                    </div>
                                    <div>
                                        <label for="schl">School</label>
                                        <input type="text" name="school" id="schl" value="<?=$user['school']?>">
                                    </div>
                                    <div>
                                        <label for="bio">Biography</label>
                                        <textarea name="biography" id="bio" cols="50" rows="5"><?=$user['biography']?></textarea>
                                    </div>
                                    <div class="btn_wrp">
                                        <button>Submit</button>
                                    </div>
                            </form>
                            </div>
                            <div class="wrapper">
                                <div style="width: 10px; height: 10px;  background: #1F82F6; padding: 15px; border-radius: 10px;">
                                    <div style="width: 10px; height: 10px; border-radius: 100%; background: white;"></div>
                                </div>
                                <h1>Information Security and Management</h1>
                                <p>welcome to our very own website</p>
                                <h2>Facenook</h2>
                                <img src="../image/undraw_mobile_content_xvgr.svg" alt="">
                            </div>
                        </div>
                    </div>
            </div>
    
        </div>
    </main>
</body>
<script src="../js/image_input.js"></script>
</html>
<?php
$_SESSION['id'] = $id;
?>