<?php
require_once('config.php');

$name = $_POST['name'];
$rate = $_POST['rate'];
$desc = $_POST['desc'];
$criId = $_POST['criId'];

if(empty($name) && empty($rate) && empty($desc))
{
	echo "<script>alert('Please fill in all fields')</script>";
}
else
{
	
	$query = "INSERT INTO `tbl_subcri` (`subcri_name`,`subcri_description`,`subcri_rate`,`cri_id`) VALUES ('$name','$desc','$rate','$criId') ";
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