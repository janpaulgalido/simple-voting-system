<?php
require_once('config.php');

if(isset($_POST['criId']))
{
	$id = $_POST['criId'];
	$criteria = $_POST['criName'];
	$query = "DELETE FROM `tbl_criteria` WHERE `cri_id` = '$id';";
	$query .= "ALTER TABLE `tbl_criteria_score` DROP `$criteria`";
	#$result = mysqli_query($con, $query);

	if(mysqli_multi_query($con, $query))
	{
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

	  	echo 'Yes';
		
	}
	else 
	{
		echo 'No';
	}	
}
mysqli_close($con);
?>