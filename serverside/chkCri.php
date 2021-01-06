<?php
require_once('config.php');
$output = "";
$query = "SELECT * FROM `tbl_criteria` WHERE `cri_id` = '".$_POST['criteria_id']."' ";
$result = mysqli_query($con, $query);
if(mysqli_num_rows($result) > 0)
{
	while ($row = mysqli_fetch_array($result))
	{
	$output .= '<h5 style="color:#fff;">Rating:&nbsp&nbsp<span style="color:#ff8c00;">'.$row['cri_rate'].'%</span></h5></br>
				<h5 style="color:#fff;">Description:&nbsp&nbsp<span style="color:#ff8c00;line-height: 20px;">'.$row['cri_description'].'</span></h5>';
	}
	echo $output;
}
mysqli_close($con);
?>