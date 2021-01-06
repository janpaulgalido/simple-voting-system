<?php
require_once('config.php');

if(isset($_POST['subcriId']))
{
	$id = $_POST['subcriId'];
	$query = "DELETE FROM `tbl_subcri` WHERE subcri_id = '$id'";
	$result = mysqli_query($con, $query);

	if($result)
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