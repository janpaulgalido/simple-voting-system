<?php
require_once 'config.php';
if($_POST['id'])
{
	$id = $_POST['id'];

	$query = "SELECT * FROM `tbl_contestant` WHERE `cont_id` = '$id' ";
	$result = mysqli_query($con, $query);
	$output = '';
	while($row = mysqli_fetch_array($result))
	{
?>    
      <div class="inputGroup inputNum" id="inputNum">
         <label for="cont_number_update">Enter Contestant No.:</label><br />
          <input type="number" min="0" max="100" name="cont_number" id="cont_number_update" value="<?php echo $row['cont_number'];?>" style="margin-bottom: 16px;line-height:30px;width:100%;height:30px;"/><br />
           <label for="cont_age_update">Enter Age:</label><br />
          <input type="number" name="cont_age" id="cont_age_update" value="<?php echo $row['cont_age'];?>"style="line-height: 30px;width  : 100%;height : 30px;margin-bottom: 16px;"/><br />
          <label for="cont_contact_update">Enter Contact:</label><br />
          <input type="number" name="cont_contact" id="cont_contact_update" value="<?php echo $row['cont_contact'];?>"style="margin-bottom: 40px;line-height: 30px;width  : 100%;height : 30px;"/><br />
      </div>
      <div class="inputGroup inputRadio" id="inputRadio">
          <input type="radio" name="cont_gender" id="male_update" value="Male" 
          <?php if($row['cont_gender']=="Male"){
            echo "checked";
          }?>/>
          <label>Male</label><br/><br/>
          <input type="radio" name="cont_gender" id="female_update" value="Female" 
            <?php if($row['cont_gender']=="Female"){
            echo "checked";
          }?>/>
          <label>Female</label>
      </div>
      <div class="inputGroup inputFname" id="inputFname">
          <label for="cont_Fname_update">Enter First Name:</label><br />
          <input type="text" name="cont_Fname" id="cont_Fname_update" value="<?php echo $row['cont_Fname'];?>"/>
      </div>
      <div class="inputGroup inputMname" id="inputMname">
          <label for="cont_Mname_update">Enter Middle Name:</label><br />
          <input type="text" name="cont_Mname" id="cont_Mname_update" value="<?php echo $row['cont_Mname'];?>"/>
      </div>
      <div class="inputGroup inputLname" id="inputLname">
          <label for="cont_Lname_update">Enter Last Name:</label><br />
          <input type="text" name="cont_Lname" id="cont_Lname_update" value="<?php echo $row['cont_Lname'];?>"/>
      </div>
      <div class="inputGroup inputAddress" id="inputAddress">
          <label for="cont_address_update">Enter Address</label><br />
          <input type="text" name="cont_address" id="cont_address_update" value="<?php echo $row['cont_address'];?>"/>
      </div>
<?php
	}

}
mysqli_close($con);
?>

