<?php
require_once('config.php');

$output = "";
$query = "SELECT * FROM `tbl_judge` WHERE `judge_id` = '".$_POST['id']."' ";
$result = mysqli_query($con, $query);
if($result)
{
	while ($row = mysqli_fetch_assoc($result))
	{
		$output .= '<h5 style="color:#fff;">Name:&nbsp&nbsp<span style="color:#ff8c00;">'.$row['judge_fname'].'</span></h5><br />';
		$output .= '<h5 style="color:#fff;">Contact:&nbsp&nbsp<span style="color:#ff8c00;">'.$row['judge_contact'].'</span></h5>';
	}
	echo $output;
}
mysqli_close($con);
?>