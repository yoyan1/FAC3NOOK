<?php
    session_start();
    include "../connection/dbcon.php";

    $id = $_SESSION['id'];

        $img_name = $_FILES['image']['name'];
        $img_size = $_FILES['image']['size'];
        $tmp_name = $_FILES['image']['tmp_name'];
        
        $img_upload_path = 'uploads/'.$img_name;
        move_uploaded_file($tmp_name, $img_upload_path);

        $addrss = $_POST['address'];
        $b_date = $_POST['b_date'];
        $school = $_POST['school'];
        $bio = $_POST['biography'];

        $birth_date = new DateTime($b_date);
        $currentDate = new DateTime();
        $birth_date->modify('+10 years');
    
        $newDate = $birth_date->format('y-m-d');
        $date = $currentDate->format('y-m-d');
        if($newDate <= $date){

            if($img_name == ""){
                
                $update = mysqli_query($conn, "UPDATE user SET address = '$addrss', birth_date = '$b_date', school = '$school', biography = '$bio' WHERE  `id` = '$id'") or die ('query failed');
                
                if($update){
                    header("location: ../home/profile.php");
                    $_SESSION['id'] = $id;
    
                } else{
    
                    echo("error");
                }
    
            } else{
    
                $update = mysqli_query($conn, "UPDATE user SET profile = '$img_name', address = '$addrss', birth_date = '$b_date', school = '$school', biography = '$bio' WHERE  `id` = '$id'") or die ('query failed');
                if($update){
                    header("location: ../home/profile.php");
                    $_SESSION['id'] = $id;
    
                } else{
    
                    echo("error");
                }
            }
        } else{
            header("location: ../input/edit.php?err=Facenook is only for 10 years old and older.");
        }