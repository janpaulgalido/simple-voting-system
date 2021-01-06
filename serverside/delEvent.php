<?php
require_once('config.php');
	
	$id = $_POST["id"];
	$query = "DELETE FROM `tbl_pginfo` WHERE `pg_id` = '$id' ";
	$result = mysqli_query($con, $query);

	if($result)
	{
		echo "Yes";
		//echo "<meta http-equiv='refresh' content='.5; url=../event.php'>";
	}	
	else
	{
		echo "No";
		//echo "<meta http-equiv='refresh' content='.5; url=../event.php'>";	}
	}
mysqli_close($con);
?>