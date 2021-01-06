<?php
session_start();

	require_once 'serverside/config.php';
	date_default_timezone_set('Asia/Manila');
	$now = time();
	$now_set = date("Y-m-d h:i:sa", $now);


	$query_log = "UPDATE `tbl_user` SET `lastlogout_log` = '$now_set' WHERE `adName` = '".$_SESSION["username"]."' ORDER BY `id` DESC LIMIT 1";
	mysqli_query($con, $query_log);



unset($_SESSION['username']);
unset($_SESSION['UID']);
session_destroy($_SESSION['username']);
session_destroy($_SESSION['userId']);
header("Location:login.php");
?>