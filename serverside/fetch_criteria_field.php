<?php
require_once 'config.php';

if(isset($_POST["action"]))
{
	if($_POST["action"] === 'criteria_only')
	{
		
		$query = "SELECT * FROM `tbl_criteria`";
		$result = mysqli_query($con, $query);
		while($row = mysqli_fetch_assoc($result))
		{
			?>
				<!-- <p class="w3-tooltip"><span style="position:absolute;right:0;top:-24px" class="w3-text w3-tag  w3-animate-opacity w3-amber">Please input numbers only</span> -->
				<p>
				<input name="<?php echo $row["cri_name"];?>" class="w3-input input_form1" type="number" min="0" max="<?php echo $row["cri_rate"] ?>" title="Accepst number only.">
				<label><?php echo $row["cri_name"];?> <span class="w3-text-red">(<?php echo $row["cri_rate"] ?>%)</span></label>
				</p>
			<?php
		}
	}
}
if(isset($_POST["candidate_id"]))
{
	$message = '';
	$id = $_POST["candidate_id"];
	$query = "SELECT * FROM `tbl_criteria_score` WHERE `cont_id` = '$id' ";
	$result = mysqli_query($con, $query);
	$total = mysqli_num_rows($result);
	if($total > 0)
	{
		while($row = mysqli_fetch_array($result))
		{			

			for ($i=3; $i < mysqli_num_fields($result) ; $i++) { 
				$field_name = mysqli_fetch_field_direct($result, $i)->name;
				$number = preg_replace('/\D/', '', $field_name);
				$string = preg_replace(array('/\W/','/\d/'), ' ', $field_name);
				?>
					<p>
					<input name="<?php echo $row["cont_id"];?>" class="w3-input input_form1" type="number" min="0" max="<?php echo $number;?>" value="<?php echo $row[$i];?>" title="Accepts number only." autofocus>
					<label><?php echo $string ;?><span class="w3-text-red"> (<?php echo $number ;?>%)</span></label>
					</p>
				<?php
			}
		}
	}
	else
	{
		$query = "SELECT * FROM `tbl_criteria`";
		$result = mysqli_query($con, $query);
		while($row = mysqli_fetch_assoc($result))
		{
			?>
				<!-- <p class="w3-tooltip"><span style="position:absolute;right:0;top:-24px" class="w3-text w3-tag  w3-animate-opacity w3-amber">Please input numbers only</span> -->
				<p>
				<input name="<?php echo $row["cri_name"];?>" class="w3-input input_form1" type="number" min="0" max="<?php echo $row["cri_rate"] ?>" title="Accepts number only.">
				<label><?php echo $row["cri_name"];?> <span class="w3-text-red">(<?php echo $row["cri_rate"] ?>%)</span></label>
				</p>
			<?php
		}
	}
}


mysqli_close($con);
?>