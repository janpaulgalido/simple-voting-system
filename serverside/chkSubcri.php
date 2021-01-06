<?php

require_once('config.php');
$output = "";
$query = "SELECT * FROM `tbl_subcri` WHERE `subcri_id` = '".$_POST['subcriId']."' ";
$result = mysqli_query($con, $query);
if(mysqli_num_rows($result))
{
	while ($row = mysqli_fetch_array($result))
	{
		$output .= '<h5 style="color:#fff;">Rating:&nbsp&nbsp<span style=" color:#ff8c00">'.$row['subcri_rate'].'%</span></h5></br>
					<h5 style="color:#fff;">Description:&nbsp&nbsp<span style ="color:#ff8c00">'.$row['subcri_description'].'</span></h5>';
	}
	echo $output;
}
mysqli_close($con);
?>
