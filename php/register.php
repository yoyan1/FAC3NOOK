<?php
    include "../connection/dbcon.php";

    $name = $_POST['fname'];
    $uname = $_POST['uname'];
    $pass = md5($_POST['pass']);
    $role = "user";

    if (empty($name)) {
    	header("Location: ../index.php?error=Full name is required");
     }else if(empty($uname)){
    	$message = "User name is required";
    	header("Location: ../index.php?error=$message");
     }else if(empty($pass)){
     	$message = "Password is required";
     	header("Location: ../index.php?error=$message");

     }else {
		$sql = mysqli_query($conn, "SELECT * FROM user") or die('query failed');
        $row = mysqli_fetch_assoc($sql);
		$user = $row['username'];
		if($user == $uname){
			$message = "Username already Exist";
     		header("Location: ../index.php?error=$message");

		}else {
    		$sql = "INSERT INTO `user`(`fname`, `profile`, `address`, `birth_date`, `school`, `biography`, `username`, `password`, `role`, `restriction`) VALUES('$name', '', '', '', '', '',  '$uname', '$pass', '$role', 0)";
			mysqli_query($conn, $sql) or die('query failed');
			
			if ($sql){
				session_start();

        		$sql = "SELECT * FROM user WHERE username='$uname' AND password='$pass'";
        		$result = mysqli_query($conn, $sql);

        		    if(mysqli_num_rows($result) > 0) {   
					
        		        $user = mysqli_fetch_assoc($result);
        		        
        		            $_SESSION['id'] = $user['id'];
        		            $id = $user['id'];
        		            $browser = $_SERVER['HTTP_USER_AGENT'];
        		            $sel_brow_type = mysqli_query($conn, "SELECT * FROM `browse_type` WHERE user = '$id' AND `type` = '$browser'");
        		            if(mysqli_num_rows($sel_brow_type) == 0){
        		                mysqli_query($conn, "INSERT INTO `browse_type`(`user`, `type`, `status`) VALUES ('$id' , '$browser', 'ONLINE')");
							
        		            } else{
        		                mysqli_query($conn, "UPDATE `browse_type` SET `type`= '$browser', `status`= 'ONLINE' WHERE user = '$id' AND `type` = '$browser'");
        		            }
							$message = "Registration succesful";
        		            header("location: ../input/edit.php?msg=$message");
        		       
        		    } else {
        		        header("Location: ../login.php?error=Incorrect username or pasword ");
        		        exit();
        		    }
			}
			
			
		}
	 }
?>