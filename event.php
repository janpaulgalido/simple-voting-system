<?php 
session_start();
  require_once 'serverside/config.php';
  include 'serverside/fetch_event_field.php';
  include 'serverside/fetch_eventData.php';

function loadLastLogin(){
  require 'serverside/config.php';
  $query = "SELECT `lastlogout_log` FROM `tbl_user` WHERE `adName` = '".$_SESSION["username"]."' ORDER BY `id` DESC LIMIT 1, 1";
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

function loadDelete(){
    require 'serverside/config.php';
    $query = "SELECT * FROM `tbl_pginfo` LIMIT 1";
    $result = mysqli_query($con, $query);
      if(mysqli_num_rows($result) > 0)
      { 
        while($row = mysqli_fetch_assoc($result)){    
  
        echo '<form id="deleteform" action="" method="POST">
        <input type="hidden" name="id" id="idDel" value="'.$row["pg_id"].'">';      

      }
    }
}
mysqli_close($con);     
?>
<!DOCTYPE html>
<html>
<head>

  <script src="includes/jquery-3.5.0.js"></script>
  <script src="js/activenav.js"></script>
  <script src="js/openclose.js"></script>

  <script src="js/add_eventinfo.js"></script>
  <script src="js/update_eventinfo.js"></script>
  <script src="js/delete_eventinfo.js"></script>

  <script src="js/logout.js"></script>
  <script src="js/chk_session.js"></script>
  <script src="includes/jquery-ui-1.12.1/jquery-ui.js"></script>

  <link rel="stylesheet" type="text/css" href="css/style.css">
  <link rel="stylesheet" type="text/css" href="css/content.css">
  <link rel="stylesheet" type="text/css" href="includes/fontawesome-free-5.13.0-web/css/all.css">
  <link rel="stylesheet" href="includes/jquery-ui-1.12.1/jquery-ui.css">

  <meta name="viewport" content="width=device-width, initial-scale=1">
  
  <title>Event</title>

</head>
<body>

<?php 
if(isset($_SESSION["username"]) && $_SESSION['username'] == 'admin')
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
<!--start of event section-->
  <div class="content1" id="myEvent">
    <header class="Panel"></header> 
    <div class="wrapper">
      <div class="dataContainer">
        <h2>Pageant Information</h2>
        <hr>
        <div class="eventData">
          <h4>Title</h4>
          <h4>Location</h4>
          <h4>Date</h4>
          <h4>Description</h4>
        </div>
          <?php echo loadeventData(); ?>
      </div>
      <div class="optionContainer">
        <h2>Options</h2>
        <hr>
        <div class="btnGroup">
          <button type="button" id="createModal"><i class="fas fa-marker"></i><span>Create</span></button>
          <button type="button" id="editModal" ><i class="fas fa-edit"></i><span>Edit</span></button>
          <button type="button" id="deleteModal" ><i class="fas fa-trash"></i><span>Delete</span></button>
        </div>
      </div>
    </div>
  </div>
</div>
  <!--end of event section-->
<?php
}
else{
  echo "<h2>Please login first. Go to <a href='login.php' style='text-decoration:underline;'>Login</a> page.</h2>";
}
?>
<!--###############################################################################################################################################-->
<!--start of Modal Create-->
<div class="modal" id="myModal">
  <div class="content">
    <div class="modalHeader">
      <span class="close" id="close">&times;</span>
      <h4>Create data</h4>
    </div>
    <div class="modalBody">
      <form id="createform" action="" method="POST">
        <div class="inputGroup">
          <label for="title">Enter Title</label><br />
          <input type="text" name="title" id="title" autocomplete="off">
        </div>
        <div class="inputGroup">
          <label for="location">Enter Location</label><br />
          <input type="text" name="location" id="location" autocomplete="off">
        </div>
        <div class="inputGroup">
          <label for="date">Enter Date</label><br />
          <input type="text" name="date" id="date">
        </div>
        <div class="inputGroup">
          <label for="description">Enter Description</label><br />
          <textarea type="text" name="description" id="description"></textarea>
        </div>
    </div>
    <div class="modalFooter">
      <div class="btnData">
        <button type="button" class="closeBtn" id="closeBtn">Cancel</button>
        <button type="submit" class="enterBtn" name="addBtn" id="addBtn">Submit</button>
      </div>
    </div>
      </form>
  </div>  
</div>
<!--end of Modal Create-->
<!--###############################################################################################################################################-->
<!--start of Modal Edit-->
<div class="modal" id="modalUpdate">
  <div class="content" id="editContent">
    <div class="modalHeader">
      <span class="close" id="closeUpdate">&times;</span>
      <h4 id="headerEdit">Edit Current data</h4>
    </div>      
    <div class="modalBody">
      <?php echo loadEvent(); ?>
    </div>          
    <div class="modalFooter">
      <div class="btnData">
        <button type="button" class="closeBtn" id="closeEditBtn">Cancel</button>
        <button type="submit" class="enterBtn" name="updateBtn" id="updateBtn">Update</button>
      </div>
    </div>
    </form> 
  </div>  
</div>
<!--end of Modal Edit-->
<!--###############################################################################################################################################-->
<!--start of Modal Delete-->
<div class="modal" id="modalDelete">
  <div class="content" id="delContent">

    <div class="modalHeader">
      <span class="close" id="closeDelete">&times;</span>
      <h4>Delete Current data</h4>
    </div>

    <div class="modalBody" id="modalBody_eventDel">
     <?php echo loadDelete(); ?>
    </div>  

    <div class="modalFooter">
      <div class="btnData">
        <button type="button" class="closeBtn" id="closeDeleteBtn">Cancel</button>
        <button type="submit" class="enterBtn" name="deleteBtn" id="deleteBtn">Delete</button>
      </div>
    </div>
          </form>   
  </div>
</div>
<!--end of Modal Delete-->
<!--###############################################################################################################################################-->

</body>
</html> 

<script>
  $(function(){
    $("#date").datepicker();
    $("#editdate").datepicker();
  });
</script>s