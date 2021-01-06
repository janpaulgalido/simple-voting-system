<?php
require_once('config.php');

if (isset($_POST['criId']))
{
	$output = "";
	$id = $_POST['criId'];
	$query = "SELECT * FROM `tbl_criteria` WHERE `cri_id` = '$id' ";
	$result = mysqli_query($con, $query);
	if (mysqli_num_rows($result) > 0)
	{
		foreach ($result as $row)
		{
			$output .= '<div class="inputGroup">
				        <label for="criteria_name">Edit Criteria Name</label><br />
				        <input type="text" name="criteria_name" id="criteriaEdit_name" value="'.$row["cri_name"].'" autocomplete="off">
				      </div>';
			$output .=	 '<div class="inputGroup">
				        <label for="rate">Edit Rating</label><br />
				        <input type="number" min="0" max="100" name="rate" id="criteriaEdit_rate" value="'.$row["cri_rate"].'" autocomplete="off">
				      </div>';
			$output .=	      '<div class="inputGroup">
				        <label for="criteria_desc">Edit Description</label><br />
				        <textarea type="text" name="criteria_desc" id="criteriaEdit_desc">'.$row["cri_description"].'</textarea>
				      </div>';
		}
		
	}
	else
	{
		$output .= '<h4 style="color: red;"><i class="fas fa-exclamation-circle" style="font-size: 24px;">&nbsp</i>No data found. Set and select data first.</h4>';
	}
	echo $output;
}

mysqli_close($con);
?>