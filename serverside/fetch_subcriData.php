<?php
require_once('config.php');

if (isset($_POST['subcriId']))
{
	$output = "";
	$id = $_POST['subcriId'];
	$query = "SELECT * FROM `tbl_subcri` WHERE `subcri_id` = '$id' ";
	$result = mysqli_query($con, $query);
	if (mysqli_num_rows($result) > 0)
	{
		while ($row = mysqli_fetch_array($result))
		{
			$output .= '<div class="inputGroup">
				        <label for="subcriEdit_name">Enter Sub Criteria Name</label><br />
				        <input type="text" name="criteria_name" id="subcriEdit_name" value="'.$row['subcri_name'].'" autocomplete="off"/>
				      </div>
				      <div class="inputGroup">
				        <label for="subcriEdit_rate">Enter Rating</label><br />
				        <input type="number" min="0" max="100" name="rate" id="subcriEdit_rate" value="'.$row['subcri_rate'].'" autocomplete="off"/>
				      </div>
				      <div class="inputGroup">
				        <label for="subcriEdit_desc">Enter Description</label><br />
				        <textarea type="text" name="criteria_desc" id="subcriEdit_desc">'.$row['subcri_description'].'</textarea>
				      </div>';
		}
	}
	else
	{
		$output .= '<h4 style="color:red;"><i class="fas fa-exclamation-circle" style="font-size:24px;">&nbsp</i>No data found. Set and select data first.</h4>';
	}
	echo $output;
}
mysqli_close($con);
?>