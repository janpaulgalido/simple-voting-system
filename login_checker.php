<?php  
session_start();

require 'serverside/config.php';

if(isset($_SESSION["username"])) {	
	$user = $_SESSION["username"];
	if($user === 'admin')
	{
		header("Location:event.php");
	}
	else
	{
		$query = "SELECT * FROM `tbl_judge` WHERE `judge_username` = '".$_SESSION["username"]."' ";
		$result = mysqli_query($con, $query);

		if(mysqli_num_rows($result) > 0)
		{
			$row = mysqli_fetch_assoc($result);
			$_SESSION["UID"] = $row["judge_id"];

			header("Location:election.php");
		}	
	}
}
mysqli_close($con);
?>