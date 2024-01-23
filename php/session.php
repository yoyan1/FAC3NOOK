<?php
session_start();
include '../connection/dbcon.php';

	if(!isset($_SESSION['adminid'])){

		echo "<script>window.location='../index.php'</script>";

	
	}

		$sql = mysqli_query($conn,"SELECT * FROM user WHERE id = '".$_SESSION['adminid']."'");
		$admin = mysqli_fetch_array($sql);

		$name = $admin['fname'];
		$id = $admin['id'];
		if($admin['profile'] == ""){
			$img = "default-profile.png";
		} else{
			$img = $admin['profile'];
		}

?>