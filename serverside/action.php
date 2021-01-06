<?php

session_start();
require_once 'config.php';

if(isset($_POST["username"])){

	$user = mysqli_real_escape_string($con, $_POST["username"]);
	$password = mysqli_real_escape_string($con, $_POST["password"]);
	
	$query = "SELECT * FROM tbl_user WHERE adName = '$user' AND adPassword = '$password'";
	$result = mysqli_query($con, $query);
	$row = mysqli_fetch_assoc($result);
	

	if(mysqli_num_rows($result) > 0)
	{
		date_default_timezone_set('Asia/Manila');
		$now = time();
		$now_set = date("Y-m-d h:i:sa", $now);
		//g:ia \o\n l jS F Y
		//$query_log = "UPDATE `tbl_user` SET `lastlogin_log` = '$now' WHERE `adName` = '".$_POST['username']."' ";

		$query_log = "INSERT INTO `tbl_user` (`adName`,`adPassword`,`lastlogin_log`) VALUES ('$user','$password','$now_set') ";
		
		if(mysqli_query($con, $query_log))
		{
		$_SESSION["username"] = $row["adName"];
		$_SESSION['UID'] = '';
		echo 'Yes';
		}

	}
	else{
		echo 'No';
	}
}
