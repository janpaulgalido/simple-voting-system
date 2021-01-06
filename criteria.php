<?php
session_start();
?>
<?php
  function loadCriteria(){
    require('serverside/config.php');
    $output="";
    $query = "SELECT * FROM `tbl_criteria` ORDER BY cri_id ASC";
    $result = mysqli_query($con, $query);
    while ($row = mysqli_fetch_array($result)) 
    {
      $output .= '<option value="'.$row["cri_id"].'">'.$row["cri_name"].' ('.$row['cri_rate'].'%)</option>' ;
    }
    return $output;
  }
?>
<?php
function loadLastLogin(){
  require 'serverside/config.php';
  $query = "SELECT `lastlogout_log` FROM `tbl_user` WHERE `adName` = 'admin' ORDER BY `id` DESC LIMIT 1, 1";
  $result = mysqli_query($con, $query);
  $row = mysqli_fetch_assoc($result);
  if(mysqli_num_rows($result) > 0)
  {
    date_default_timezone_set("Asia/Manila");
    $now = time();
    $recorded = strtotime($row["lastlogout_log"]);
    $seconds = $now - $recorded;
    if($recorded > 0)
    {
      //include_once 'timetoStr.php';
      include_once 'timeago.php';
      echo "Last logged in was ";
      //echo secondsToWords($seconds);
      echo timeago($row["lastlogout_log"]);
    }
  }
}
?>

<!DOCTYPE html>
<html>
<head>

  <script src="includes/jquery-3.5.0.js"></script>
  <script src="js/activenav.js"></script>
  <script src="js/openclose.js"></script>
  <script src="js/logout.js"></script>

  <script src="js/add_criteria.js"></script>
  <script src="js/delete_criteria.js"></script>
  <script src="js/update_criteria.js"></script>
  <script src="js/chk_session.js"></script>
  
  <link rel="stylesheet" type="text/css" href="includes/fontawesome-free-5.13.0-web/css/all.css">
  <link rel="stylesheet" type="text/css" href="css/style.css">
  <link rel="stylesheet" type="text/css" href="css/content.css">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Criteria</title>

</head>
<body>

<?php
if(isset($_SESSION["username"]))
{
?>
<div id="mySidenav" class="sidenav">
  <?php
  include('navigation.php');
  ?>
</div>

<div class="main" id="main">
  <div id="panel">
    <span id="hamburger" onclick="openNav()">&#9776;</span>
   <h3 style="position:absolute;color: white;top: 25px; left: 70px;">Hi <?php echo ucfirst($_SESSION["username"]) ?>!</h3>
  <h5 style="position: absolute; color: white; top: 25px; right: 15px;"><?php echo loadLastLogin()?></h5>
  </div>
<!--#######################################################################################################################-->
  <!--start of criteria section-->
  <div class="content1" id="myEvent">
    <header class="Panel"></header> 
    <div class="wrapper">
      <div class="dataContainer">
        <h2>Criteria Information</h2>
        <hr>
        <div class="eventData label">
          <h4>Select Criteria:</h4>
          <select class="selection" name="criteria" id="criteria">
             <option selected disabled="" value="">Select Criteria..</option>
             <?php echo loadCriteria(); ?>
          </select>
          <div class="info" id="cri_info"></div>
        </div>
      </div>
      <div class="optionContainer">
        <h2>Options</h2>
        <hr>
        <div class="btnGroup">
          <button type="button" id="add_modal"><i class="fas fa-marker"></i><span>Add</span></button>
          <button type="button" id="edit_modal" ><i class="fas fa-edit"></i><span>Edit</span></button>
          <button type="button" id="delete_modal" ><i class="fas fa-trash"></i><span>Delete</span></button>
        </div>
      </div>
    </div>
  </div>
<!--end of criteria section-->
</div>
<?php
}
else
{
  echo "<h2>Please login first. Go to <a href='login.php' style='text-decoration:underline;'>Login</a> page.</h2>";
}
?>
<!--#######################################################################################################################-->
<!--start of Modal to add data-->
<div class="modal" id="modalAdd">
  <div class="content">
    <div class="modalHeader">
      <span class="close" id="close">&times;</span>
      <h4>Add Criteria</h4>
    </div>
    <div class="modalBody"> 
    <form id="addForm">
      <div class="inputGroup">
        <label for="criteria_name">Enter Criteria Name</label><br />
        <input type="text" name="criteria_name" id="criteria_name" autocomplete="off">
      </div>
      <div class="inputGroup">
        <label for="rate">Enter Rating</label><br />
        <input type="number" min="0" max="100" name="rate" id="rate" autocomplete="off">
      </div>
      <div class="inputGroup">
        <label for="criteria_desc">Enter Description</label><br />
        <textarea type="text" name="criteria_desc" id="criteria_desc"></textarea>
      </div>
    </div>
    <div class="modalFooter">
      <div class="btnData">
        <button type="button" class="closeBtn" id="closeBtn">Cancel</button>
        <button type="button" class="enterBtn" name="addBtn" id="addBtn">Submit</button>
      </div>
    </div>
    </form>
  </div>  
</div>
<!--end of Modal to add data-->
<!--########################################################################################################################-->
<!--start of Modal to edit data-->
<div class="modal" id="modalUpdate">
  <div class="content" id="editContent">
    <div class="modalHeader">
      <span class="close" id="closeUpdate">&times;</span>
      <h4 id="headerEdit">Update Selected Data</h4>
    </div>      
    <div class="modalBody" id="modalBody_criEdit">     
       
    </div>          
    <div class="modalFooter">
      <div class="btnData">
        <button type="button" class="closeBtn" id="cancelEdit">Cancel</button>
        <button type="button" class="enterBtn" name="updateBtn" id="updateBtn">Update</button>
      </div>
    </div>
  </div>  
</div>
<!--end of Modal to edit data-->
<!--#########@##############################################################################################################-->
<!--start of Modal to delete data-->
<div class="modal" id="modalDelete">
  <div class="content" id="delContent">
    <div class="modalHeader">
      <span class="close" id="closeDelete">&times;</span>
      <h4>Delete Selected data</h4>
    </div>
    <div class="modalBody" id="modalBody_criDel">          
    </div>  
    <div class="modalFooter">
      <div class="btnData">
        <button type="button" class="closeBtn" id="closeDeleteBtn">Cancel</button>
        <button type="button" class="enterBtn" name="deleteBtn" id="deleteBtn">Delete</button>
      </div>
    </div>         
  </div>
</div>
<!--end of Modal to delete data-->
<!--#########@##############################################################################################################-->
</body>
</html>

<script>
  $(function(){

    $('#criteria').change(function(){
      var criteria_id = $(this).val();
      $.ajax({
        url:"serverside/chkCri.php",
        method:"POST",
        data:{criteria_id:criteria_id},
        dataType:"text",
        success:function(data)
        {
          $('#cri_info').html(data);
        }
      });
    });

    $('#addBtn').click(function(){
      var name = $('#criteria_name').val();
      var rate = $('#rate').val();
      var desc = $('#criteria_desc').val();
      $.ajax({
        url:"serverside/addCri.php",
        method:"POST",
        dataType:"text",
        data:{name:name, rate:rate, desc:desc},
        success:function(msg)
        {
          if(msg == 'Yes')
          {
            if (alert('Successfully saved')) {} else {location.reload()};  
          }
          else
          {
            if (alert('Data is not saved. Fill in input fields.')) {} else {location.reload()};           
          }
        }
      });
    });

    $('#deleteBtn').click(function(){
      var criId = $('#criteria').val();
      var criName = $("#criteria").find('option:selected').text();
      console.log(criName);
      $.ajax({
        url:"serverside/delCri.php",
        method:"POST",
        data:{criId:criId, criName:criName},
        dataType:"text",
        success:function(msg)
        {
          if(msg == 'No')
          {
            if(alert('Data is not deleted')){}else{location.reload()};
          }
          else{  
            if (alert('Data is successfuly deleted')) {} else {location.reload()};
          }
        }
      });
    });

    $('#updateBtn').click(function(){
      var name = $('#criteriaEdit_name').val();
      var rate = $('#criteriaEdit_rate').val();
      var desc = $('#criteriaEdit_desc').val();
      var criId = $('#criteria').val();
      $.ajax({
        url:"serverside/upCri.php",
        method:"POST",
        data:{name:name, rate:rate, desc:desc, criId:criId},
        dataType:"text",
        success:function(msg)
        {
          if (msg == 'No') 
          {
            if (alert('Data is not updated')) {} else {location.reload()};
          }
          else
          {
            if (alert('Data is successfuly updated')) {} else {location.reload()};
          }
        }
      });
    });

   

  });
</script>
