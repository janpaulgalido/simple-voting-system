<?php
function loadEvent(){
  require 'serverside/config.php';
  $query = "SELECT * FROM `tbl_pginfo` LIMIT 1";
  $result = mysqli_query($con, $query);

  if(mysqli_num_rows($result) > 0)
  {
    while($row = mysqli_fetch_assoc($result)){

      echo '<form id="formEdit" action="" method="POST">     
              <div class="inputGroup">
                <input type="hidden" name="id" value="'.$row['pg_id'].'" autocomplete="off">
                <label for="edittitle">Edit Title</label><br />
                <input type="text" name="edittitle" id="edittitle" value="'.$row['pg_Title'].'" autocomplete="off">
              </div>
              <div class="inputGroup">
                <label for="editlocation">Edit Location</label><br />
                <input type="text" name="editlocation" id="editlocation" value="'.$row['pg_Location'].'" autocomplete="off">
              </div>
              <div class="inputGroup">
                <label for="editdate">Edit Date</label><br />
                <input type="text" name="editdate" id="editdate" value="'.$row['pg_Date'].'" autocomplete="off">
              </div>
              <div class="inputGroup">
                <label for="editdescription">Edit Description</label><br />
                <textarea type="text" name="editdescription" id="editdescription">'.$row['pg_Description'].'</textarea>
              </div>';
    }
  }
  else
  {
    echo '<h4 style="color: red;"><i class="fas fa-exclamation-circle" style="font-size: 24px;">&nbsp</i>No data found. Set data first.</h4>'. mysqli_error($con);
  }
  mysqli_close($con);
 }     
?>  