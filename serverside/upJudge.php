<?php
require_once('config.php');

	$id = $_POST['id'];
	$fname = $_POST['fname'];
	$contact = $_POST['contact'];
	$username = $_POST['username'];
	$password = $_POST['password'];

	$query1 = "SELECT * FROM `tbl_judge` WHERE NOT `judge_id` = '$id' AND `judge_username` = '$username' ";
	$result = mysqli_query($con, $query1);

	if(mysqli_num_rows($result) > 0 )
	{
		echo "Error: ID or Username already existed. ".mysqli_error($con);
	}
	else
	{
		$query = "UPDATE `tbl_judge` SET `judge_fname`='$fname',`judge_contact`='$contact',`judge_username`='$username',`judge_password`='$password' WHERE `judge_id`='$id' ;";
		$query .= "UPDATE `tbl_user` SET `adName` = '$username', `adPassword` = '$password' WHERE `judge_id` = '$id' ";
		
		if(mysqli_multi_query($con, $query))
		{
			do{
				if($result = mysqli_store_result($con))
				{
					while($row = mysqli_fetch_row($result))
					{
						print_f("%s\n", $row[0]);
					}
					mysqli_free_result($result);
				}
			}while(mysqli_next_result($con));
			echo 'Yes';
		}
		else
		{
			echo 'Error found '.mysqli_error($con);
		}
	}

	
mysqli_close($con);
?>