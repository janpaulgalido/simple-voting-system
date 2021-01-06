<?php
require_once('config.php');

if (isset($_POST['name']) && isset($_POST["oldname"])) {
	
	$oldname = $_POST['oldname'];
	$name = $_POST['name'];
	$rate = $_POST['rate'];
	$desc = $_POST['desc'];
	$id = $_POST['criId'];

	$query = "UPDATE `tbl_criteria` SET `cri_name`='$name',`cri_description`='$desc',`cri_rate`='$rate' WHERE `cri_id` = '$id';";
	$query .= "ALTER TABLE `tbl_criteria_score` CHANGE `$oldname` `$name` INT(50) NOT NULL";

	if (mysqli_multi_query($con, $query)) 
	{
		do{
			if($result = mysqli_store_result($con))
			{
				while($row = mysqli_fetch_rows($result))
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
		echo "No";
	}	
}
mysqli_close($con);
?>