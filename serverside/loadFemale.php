<?php
function loadFemale(){
require 'serverside/config.php';
// if(isset($_POST["action"]))
// {
	$query = "SELECT * FROM `tbl_contestant` WHERE `cont_gender` = 'Female' ";
	$result = mysqli_query($con, $query);
	if(mysqli_num_rows($result) > 0)
	{
		while($row = mysqli_fetch_assoc($result))
		{
		echo '
			<div class="w3-third w3-margin-bottom w3-center">
				<div class="w3-card w3-padding inactive" id="'.$row['cont_id'].'" style="cursor:pointer">
					<img id="'.$row["cont_id"].'" src="sidenav/'.$row["cont_picture"].'" alt="Candidates" class="w3-image w3-hover-opacity" style="height: 211.77px; max-height: 100%; margin-top:1px;">
					<div class="w3-container w3-center indicator">
						<h2 class="w3-cardfont"># '.$row["cont_number"].' '.$row["cont_Fname"].' '.$row["cont_Lname"].'</h2>
					</div>
				</div>
			</div>
		';
		}
	}
	else
	{
		echo "Error: No data found " . mysqli_error($con);
	}
// }
mysqli_close($con);
}
?>