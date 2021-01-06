<?php
require_once('config.php');

if(isset($_POST['subcriId']))
{
	$name = $_POST['name'];
	$rate = $_POST['rate'];
	$desc = $_POST['desc'];
	$id = $_POST['subcriId'];

	$query = "UPDATE `tbl_subcri` SET `subcri_name`='$name',`subcri_description`='$desc',`subcri_rate`='$rate' WHERE `subcri_id`='$id' ";
	$result = mysqli_query($con, $query);
	if ($result)
	{
		echo "Yes";	
	}
	else
	{
		echo "No";
	}
	
}
mysqli_close($con);
?>