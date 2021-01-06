<?php
require_once('config.php');

	$pgtitle = $_POST['edittitle'];
	$pglocation = $_POST['editlocation'];
	$pgdate = $_POST['editdate'];
	$pgdescription = $_POST['editdescription'];
	$pgid = $_POST['id'];

	$query = "UPDATE `tbl_pginfo` SET `pg_Title`='$pgtitle',`pg_Location`='$pglocation',`pg_Date`='$pgdate',`pg_Description`='$pgdescription' WHERE `pg_id` = '$pgid'";
	$query_run = mysqli_query($con, $query);

	if($query_run)
	{
		echo "Yes";
		//echo "<meta http-equiv='refresh' content='.5; url=../event.php'>";
	}
	else
	{
		echo "No";
		//echo "<meta http-equiv='refresh' content='.5; url=../event.php'>";
	}	
	
mysqli_close($con);
?>