<?php
session_start();
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
  <script src="js/chk_session.js"></script>
  
  <link rel="stylesheet" type="text/css" href="includes/fontawesome-free-5.13.0-web/css/all.css">
  <link rel="stylesheet" type="text/css" href="css/style.css">
  <link rel="stylesheet" type="text/css" href="css/content.css">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Results</title>

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
</div>
<?php
}
else
{
  echo "<h2>Please login first. Go to <a href='login.php' style='text-decoration:underline;'>Login</a> page.</h2>";
}
?>
</body>
</html> 
