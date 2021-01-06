<?php
require_once('config.php');


	$pgtitle = $_POST['title'];
	$pglocation = $_POST['location'];
	$pgdate = $_POST['date'];
	$pgdescription = $_POST['description'];

	if(!empty($pgtitle) && !empty($pglocation) && !empty($pgdate) && !empty($pgdescription))
	{
		$query = "INSERT INTO `tbl_pginfo`(`pg_Title`, `pg_Location`, `pg_Date`, `pg_Description`) VALUES ('$pgtitle', '$pglocation', '$pgdate', '$pgdescription')";
		$query_run = mysqli_query($con, $query);

		if($query_run)
		{
			echo "Yes";
			// echo "<script>alert('Data saved')</script>";
			// echo "<meta http-equiv='refresh' content='.5; url=../event.php'>";
		}
		else
		{
			echo "No";
			// echo "<script>alert('Data Not Saved')</script>";
			// echo "<meta http-equiv='refresh' content='.5; url=../event.php'>";
		}
	}
	else
	{
		echo "Not";
		//echo "<meta http-equiv='refresh' content ='.5; url=../event.php'>"; 
	}
	
	

mysqli_close($con);
?>