<?php
require_once('config.php');

$output = "";
if(isset($_POST['id']))
{
	$id = $_POST['id'];
	$query = "SELECT * FROM `tbl_judge` WHERE `judge_id` = '$id' ";
	$result = mysqli_query($con, $query);
	if(mysqli_num_rows($result) > 0)
	{
		while($row = mysqli_fetch_array($result))
		{
			$output .= '<form id="editForm">
					 <div class="inputGroup">
				        <label for="judge_fname">Enter Full Name</label><br />
				        <input type="text" name="judge_fname" id="judgeEdit_fname" value="'.$row['judge_fname'].'"/>
				      </div>
				      <div class="inputGroup">
				        <label for="judge_contact">Enter Contact No.</label><br />
				        <input type="text" name="judge_contact" id="judgeEdit_contact" value="'.$row['judge_contact'].'"/>
				      </div>
				      <div class="inputGroup">
				        <label for="judge_uname">Enter Username</label><br />
				        <input type="text" name="judge_uname" id="judgeEdit_username" value="'.$row['judge_username'].'"/>
				      </div>
				      <div class="inputGroup">
				        <label for="judge_password">Enter Password</label><br />
				        <input type="password" name="judge_password" id="judgeEdit_password" value="'.$row['judge_password'].'"/>
				      </div>';
		}	
	}
	else
	{
		$output .= '<h4 style="color:red;"><i class="fas fa-exclamation-circle" style="font-size: 24px;">&nbsp&nbsp</i>No data found. Set or Select first.</h4>';
	}
	echo $output;
}
mysqli_close($con);
?>