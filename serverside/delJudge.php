<?php
require_once('config.php');
if(isset($_POST['id']))
{
	$id = $_POST['id'];
	// $trimname = explode('', trim($uname));

	$query = "DELETE FROM `tbl_judge` WHERE `judge_id` = '$id' ;";
	$query .= "DELETE FROM `tbl_user` WHERE `judge_id` = '$id' ";
	#$result = mysqli_query($con, $query);

	if(mysqli_multi_query($con, $query))
	{
		echo "Yes";
		do{
	        if ($result = mysqli_store_result($con))
	        {
	            while ($row = mysqli_fetch_row($result))
	            {
	               printf("%s\n",$row[0]);
	            }
	            mysqli_free_result($result);
	        }
	    }while (mysqli_next_result($con));

	}
	else
	{
		echo 'No';
	}
}
mysqli_close($con);
?>