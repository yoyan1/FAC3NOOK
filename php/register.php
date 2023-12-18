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
    	$sql = "INSERT INTO `user`(`fname`, `profile`, `address`, `birth_date`, `school`, `biography`, `username`, `password`, `role`) VALUES('$name', '', '', '', '', '',  '$uname', '$pass', '$role')";
		mysqli_query($conn, $sql) or die('query failed');
		$message = "Registration succesful";
		header("location: ../login.php?suc=$message");
		}
	 }
?>