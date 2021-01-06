<?php
if(isset($_POST['action']))
{
	require_once('config.php');
	if($_POST['action'] == 'All')
	{
		$query = "SELECT * FROM tbl_contestant ORDER BY `cont_number`";
		$result = mysqli_query($con, $query);
		while($row = mysqli_fetch_array($result))
		{
		?>	
		<tr id="<?php echo $row['cont_picture']?>">
			<td><input type="checkbox" class="checkitem" name="item[]" id='<?php echo $row["cont_picture"];?>' value='<?php echo $row["cont_id"];?>'/></td>
			<td><?php echo $row['cont_number'];?></td>
			<td><img src="/sidenav<?php echo $row['cont_picture'];?>" width="100" height="100" style="box-shadow: 0 0 8px 0 grey; border-radius: 50em;" ></td>
			<td><?php echo $row['cont_Fname'];?></td>
			<td><?php echo $row['cont_Mname'];?></td>
			<td><?php echo $row['cont_Lname'];?></td>
			<td><?php echo $row['cont_address'];?></td>
			<td><?php echo $row['cont_contact'];?></td>
			<td><?php echo $row['cont_gender'];?></td>
			<td><?php echo $row['cont_age'];?></td>
		</tr>;
		<?php
		}
	
	}
	if($_POST['action']=='Male' || $_POST['action']=='Female')
	{
		$query = "SELECT * FROM tbl_contestant WHERE `cont_gender` ='".$_POST['action']."' ";
		$result = mysqli_query($con, $query);
		while($row = mysqli_fetch_array($result))
		{
		?>					
		<tr id="<?php echo $row['cont_id']?>">
			<td><input type="checkbox" class="checkitem" name="item[]" id='<?php echo $row["cont_picture"];?>' value='<?php echo $row["cont_id"];?>'/></td>
			<td><?php echo $row['cont_number'];?></td>
			<td><img src="/sidenav<?php echo $row['cont_picture'];?>" width="100" height="100" style="box-shadow: 0 0 8px 0 grey;border-radius: 50em;" ></td>
			<td><?php echo $row['cont_Fname'];?></td>
			<td><?php echo $row['cont_Mname'];?></td>
			<td><?php echo $row['cont_Lname'];?></td>
			<td><?php echo $row['cont_address'];?></td>
			<td><?php echo $row['cont_contact'];?></td>
			<td><?php echo $row['cont_gender'];?></td>
			<td><?php echo $row['cont_age'];?></td>
		</tr>;
		 <?php
		}
	}

		$query = "SELECT * FROM tbl_contestant WHERE `cont_Fname` LIKE  '%".$_POST['action']."%' ";
		$result = mysqli_query($con, $query);
		while($row = mysqli_fetch_array($result))
		{
		?>					
		<tr id="<?php echo $row['cont_id']?>">
			<td><input type="checkbox" class="checkitem" name="item[]" id='<?php echo $row["cont_picture"];?>' value='<?php echo $row["cont_id"];?>'/></td>
			<td><?php echo $row['cont_number'];?></td>
			<td><img src="/sidenav<?php echo $row['cont_picture'];?>" width="100" height="100" style="box-shadow: 0 0 8px 0 grey;border-radius: 50em;" ></td>
			<td><?php echo $row['cont_Fname'];?></td>
			<td><?php echo $row['cont_Mname'];?></td>
			<td><?php echo $row['cont_Lname'];?></td>
			<td><?php echo $row['cont_address'];?></td>
			<td><?php echo $row['cont_contact'];?></td>
			<td><?php echo $row['cont_gender'];?></td>
			<td><?php echo $row['cont_age'];?></td>
		</tr>;
		 <?php
		}

	mysqli_close($con);
}

?>