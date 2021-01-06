<?php
require_once 'config.php';
if(isset($_POST['id']))
{
	$status = "";
	foreach($_POST['id'] as $id)
	{
		$query = "DELETE FROM `tbl_contestant` WHERE `cont_id` = $id";
		$result = mysqli_query($con, $query);
		if($result)
		{
			$status = 1;
		}
		else{
			$status = 0;
		}
	}
	foreach($_POST['path'] as $path)
	{
		if(file_exists($path))
		{
			unlink(realpath($path));
			
			$status = 1;
		}
		else{
			$status = 0;
		}
		
	}
	if($status == 1)
	{
		echo "Data is successfully deleted";
	}
	else
	{
		echo "Data is not deleted";
	}
	
}
mysqli_close($con);
?>