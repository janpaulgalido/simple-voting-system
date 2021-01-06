<?php
require_once('config.php');

$fname = $_POST['fname'];
$contact = $_POST['contact'];
$username = $_POST['username'];
$password = $_POST['password'];
$uid = $_POST["UID"];

if(empty($uid) && empty($fname) && empty($contact) && empty($uname) && empty($passowrd))
{
	echo "<scipt>alert('Please fill in all data fields.')</script>";
	echo "<meta http-equiv='refresh' content='.5; url=../judges.php'>";
}
else
{
	$query1 = "SELECT * FROM `tbl_judge` WHERE `judge_id` = '$uid' OR `judge_username` = '$username' ";
	$result1 = mysqli_query($con, $query1);

	if(mysqli_num_rows($result1) > 0)
	{
		echo "Error: ID or Username already existed." .mysqli_error($con);
	}
	else
	{
		$query = "INSERT INTO `tbl_judge` (`judge_id`,`judge_fname`,`judge_contact`,`judge_username`,`judge_password`) VALUES ('$uid','$fname','$contact','$username','$password') ;";
		$query .= "INSERT INTO `tbl_user` (`judge_id`,`adName`,`adPassword`) VALUES ('$uid', '$username','$password') ";


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
			echo "Yes";
		}
		else
		{
			echo 'There is an error:' .mysqli_error($con);
		}
	}
}
mysqli_close($con);
?>