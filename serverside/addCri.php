<?php
require_once('config.php');
$name = $_POST['name'];
$desc = $_POST['desc'];
$rate = $_POST['rate'];
if(empty($name) && empty($desc) && empty($rate))
{
	echo "<scipt>alert('Please fill in all fields')</script>";
	echo "<meta http-equiv='refresh' content ='1; url=../criteria.php'>";
}
else
{
	$last_id = mysqli_insert_id($con);
	$query = "INSERT INTO `tbl_criteria` (`cri_name`,`cri_description`,`cri_rate`) VALUES ('$name','$desc','$rate');";
	$query .= "ALTER TABLE `tbl_criteria_score` ADD `$name (".$rate."%)` INT(50) NOT NULL";

	if(mysqli_multi_query($con, $query))
	{
		echo 'Yes';
		do{
	        if ($result = mysqli_store_result($con)){
	            while ($row = mysqli_fetch_row($result)){
	               printf("%s\n",$row[0]);
	            }
	            mysqli_free_result($result);
	        }
	    }while (mysqli_next_result($con));
		
	}
	else
	{
		echo 'No';
		
	}
}
mysqli_close($con);
?>