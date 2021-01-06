<?php
session_start();
?>
<?php
  function loadJudges(){
    require('serverside/config.php');
    $output="";
    $query = "SELECT * FROM `tbl_judge` ORDER BY judge_id";
    $result = mysqli_query($con, $query);
    while ($row = mysqli_fetch_array($result)) 
    {
      $output .= '<option value="'.$row["judge_id"].'">'.$row["judge_fname"].'</option>' ;
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
  
  <script src="js/add_judge.js"></script>
  <script src="js/update_judge.js"></script>
  <script src="js/delete_judge.js"></script>
  <script src="js/chk_session.js"></script>

  <link rel="stylesheet" type="text/css" href="includes/fontawesome-free-5.13.0-web/css/all.css">
  <link rel="stylesheet" type="text/css" href="css/style.css">
  <link rel="stylesheet" type="text/css" href="css/content.css">
  <meta name="viewport" content="width=device-width, initial-scale=1">
<title>Judges</title>

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
<!--###################################################################################################-->
 <!--start of subcriteria section-->
  <div class="content1" id="myEvent">
    <header class="Panel"></header> 
    <div class="wrapper">
      <div class="dataContainer">
        <h2>Judge Information</h2>
        <hr>
        <div class="eventData label">
            <h4>Select Criteria:</h4>
            <select class="selection" name="judges" id="judges">
               <option selected disabled="" value="">Select Criteria..</option>
               <?php echo loadJudges(); ?>
            </select>
           
            <div class="info" id="judge_info"></div>
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
<!--end of subcriteria section-->
</div>
<?php
}
else
{
  echo "<h2>Please login first. Go to <a href='login.php' style='text-decoration:underline;'>Login</a> page.</h2>";
}
?>
<!--###################################################################################################-->
<!--start of Modal to add data-->
<div class="modal" id="modalAdd">
  <div class="content">
    <div class="modalHeader">
      <span class="close" id="closeAdd">&times;</span>
      <h4>Add Sub Criteria</h4>
    </div>
    <div class="modalBody" id="modalBody_judgeAdd"> 
    <form id="addForm">
      <div class="inputGroup">
        <label for="judge_ID">Enter User ID#</label><br />
        <input type="text" name="judge_ID" id="judgeAdd_ID" autocomplete="off"/>
      </div>
      <div class="inputGroup">
        <label for="judge_fname">Enter Full Name</label><br />
        <input type="text" name="judge_fname" id="judgeAdd_fname" autocomplete="off"/>
      </div>
      <div class="inputGroup">
        <label for="judge_contact">Enter Contact No.</label><br />
        <input type="text" name="judge_contact" id="judgeAdd_contact" autocomplete="off"/>
      </div>
      <div class="inputGroup">
        <label for="judge_uname">Enter Username</label><br />
        <input type="text" name="judge_uname" id="judgeAdd_uname" autocomplete="off"/>
      </div>
      <div class="inputGroup">
        <label for="judge_password">Enter Password</label><br />
        <input type="password" name="judge_password" id="judgeAdd_password" autocomplete="off" />
      </div>
    </div>
    <div class="modalFooter">
      <div class="btnData">
        <button type="button" class="closeBtn" id="cancelAdd">Cancel</button>
        <button type="button" class="enterBtn" name="addBtn" id="addBtn">Submit</button>
      </div>
    </div>
    </form>
  </div>  
</div>
<!--end of Modal to add data-->
<!--###################################################################################################-->
<!--start of Modal to edit data-->
<div class="modal" id="modalUpdate">
  <div class="content" id="editContent">
    <div class="modalHeader">
      <span class="close" id="closeUpdate">&times;</span>
      <h4 id="headerEdit">Update Selected Data</h4>
    </div>      
    <div class="modalBody" id="modalBody_judgeEdit">     
       
    </div>          
    <div class="modalFooter">
      <div class="btnData">
        <button type="button" class="closeBtn" id="cancelEdit">Cancel</button>
        <button type="button" class="enterBtn" name="updateBtn" id="updateBtn">Update</button>
      </div>
    </div>
      </form>
  </div>  
</div>
<!--end of Modal to edit data-->
<!--###################################################################################################-->
<!--start of Modal to delete data-->
<div class="modal" id="modalDelete">
  <div class="content" id="delContent">

    <div class="modalHeader">
      <span class="close" id="closeDelete">&times;</span>
      <h4>Delete Selected Data</h4>
    </div>

    <div class="modalBody" id="modalBody_judgeDel">          
    </div>  

    <div class="modalFooter">
      <div class="btnData">
        <button type="button" class="closeBtn" id="cancelDelete">Cancel</button>
        <button type="button" class="enterBtn" name="deleteBtn" id="deleteBtn">Delete</button>
      </div>
    </div>
            
  </div>
</div>
<!--end of Modal to delete data-->
<!--###################################################################################################-->
</body>
</html> 
<script>
  $(document).ready(function(){

    $('#judges').change(function(){
      var id = $(this).val();
      $.ajax({
        url:"serverside/chkJudge.php",
        method:"POST",
        data:{id:id},
        dataType:"text",
        success:function(data)
        {
          $('#judge_info').html(data);
        }
      });
    });

  });
</script>