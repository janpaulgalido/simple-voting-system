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

<script src="includes/jquery-3.5.0.js"></script>
<script src="js/activenav.js"></script>
<script src="js/openclose.js"></script>
<script src="js/logout.js"></script>

<script src="js/add_contestant.js"></script>
<script src="js/update_contestant.js"></script>
<script src="js/delete_contestant.js"></script>
<script src="js/chk_session.js"></script>

<link rel="stylesheet" type="text/css" href="includes/fontawesome-free-5.13.0-web/css/all.css">
<link rel="stylesheet" type="text/css" href="css/style.css">
<link rel="stylesheet" type="text/css" href="css/content.css">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Contestant</title>

<style>
    .image-preview{
      position: relative;
      width:175px;
      height:200px;
      border-radius: 6px;
      border:2px solid #dddddd;
      margin-right: 20px;

      display: flex;
      justify-content: center;
      align-items: center;
      font-weight: bold;
      color: #cccccc;
    }
    .image-preview__image{
      display: none;
      width: 100%;
      height: 100%;
      background-position: contain;
    }

</style>

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
  <!--##################################################################################################-->
  <!--start of criteria section-->
  <div class="wrapper contestant">
    <div class="dataContainer dataContestant">
      <h2>Contestant Information</h2>
      <hr>
      <div class="eventData label">
        <div class="inputRow">
          <div class="btnGroup btnOption">
            <button type="button" class="btn_contestant" id="add_contestant"><span><i class="fas fa-plus-circle" aria-hidden="true"></i></span>Add</button>
            <button type="button" class="btn_contestant" id="change_contestant"><span><i class="fas fa-edit" aria-hidden="true"></i></span>Change</button>
            <button type="button" class="btn_contestant" id="delete_contestant"><span><i class="fas fa-minus" aria-hidden="true"></i></span>Delete</button>
          </div>
          <div class="inputSearch">
            <i class="fa fa-search" aria-hidden="true" ></i>
            <input type="text" name="contestant_search" id="contestant_search" placeholder="Type Firstnames" />
          </div>
          <select class="selection selection_gender" name="contestant_filter" id="contestant_filter"> 
            <option value="All" selected="selected">All Gender</option>
            <option value="Male">Male</option>
            <option value="Female">Female</option>
          </select>
        </div>
      </div>
        <div class="tableWrapper" id="tableContestant">
          <table class="tbl_contestant" id="tbl_contestant">
            <thead>
              <tr>
                <th><input type="checkbox" id="checkall"></th>
                <th>No.</th>
                <th>Picture</th>
                <th>First Name</th>
                <th>Middle Name</th>
                <th>Last Name</th>
                <th>Address</th>
                <th>Contact</th>
                <th>Gender</th>
                <th>Age</th>
              </tr>
            </thead>
            <tbody id="table"></tbody>
          </table>    
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
  <!--##################################################################################################-->
  <!--start of Modal to add data-->
<div class="modal" id="modalAdd">
  <div class="content" id="content">
    <div class="modalHeader">
      <span class="close" id="closeAdd">&times;</span>
      <h4>Add Contestant</h4>
    </div>
    <form id="addForm" action="" method="POST" enctype="multipart/form-data">
    <div class="modalBody formContestant" id="modalBody"> 
      <div class="inputGroup inputFile">
        <div class="image-preview" id="imagePreview">
            <img class="image-preview__image" id="image_prev" src="" alt="Image Preview" >
            <span class="image-preview__default-text" id="default_text" >Image Preview</span>
        </div>
      <br />
        <label for="user">Select image to upload:</label><br />
        <input type="file" name="file" id="file" />
      </div>
      <div class="inputGroup inputNum">
        <label for="cont_number">Enter Contestant No.:</label><br />
        <input type="number" min="0" max="100" name="cont_number" id="cont_number" style="margin-bottom: 16px;line-height:30px;width:100%;height:30px;" autocomplete="off"/><br />
         <label for="cont_age">Enter Age:</label><br />
        <input type="number" name="cont_age" id="cont_age" style="line-height: 30px;width  : 100%;height : 30px;margin-bottom: 16px;" autocomplete="off"/><br />
        <label for="cont_contact">Enter Contact:</label><br />
        <input type="number" name="cont_contact" id="cont_contact" style="margin-bottom: 40px;line-height: 30px;width  : 100%;height : 30px;" autocomplete="off"/><br />
      </div>
      <div class="inputGroup inputRadio">
          <input type="radio" name="cont_gender" id="male" value="Male" />
          <label>Male</label><br/><br/>
          <input type="radio" name="cont_gender" id="female" value="Female" />
          <label>Female</label>
      </div>

      <div class="inputGroup inputFname">
          <label for="cont_Fname">Enter First Name:</label><br />
          <input type="text" name="cont_Fname" id="cont_Fname" autocomplete="off"/>
      </div>
      <div class="inputGroup inputMname">
          <label for="cont_Mname">Enter Middle Name:</label><br />
          <input type="text" name="cont_Mname" id="cont_Mname" autocomplete="off"/>
      </div>
      <div class="inputGroup inputLname">
          <label for="cont_Lname">Enter Last Name:</label><br />
          <input type="text" name="cont_Lname" id="cont_Lname" autocomplete="off"/>
      </div>
      <div class="inputGroup inputAddress">
          <label for="cont_address">Enter Address</label><br />
          <input type="text" name="cont_address" id="cont_address" />
      </div>
    </div>
    <div class="modalFooter">
      <div class="btnData">
        <button type="button" class="closeBtn" id="cancelAdd">Cancel</button>
        <button type="submit" class="enterBtn" name="contestant_btn" id="but_upload">Submit</button>
      </div>
      </form>
    </div>
  </div>  
</div>
<!--end of Modal to add data-->
  <!--##################################################################################################-->
<div class="modal" id="modalUpdate">
  <div class="content" id="contentUpdate">
    <div class="modalHeader">
      <span class="close" id="closeUpdate">&times;</span>
      <h4>Update Contestant</h4>
    </div>
    <form id="updateForm" action="" method="POST" enctype="multipart/form-data">
    <div class="modalBody formContestant" id="modalBody_update">
      <div class="inputGroup inputFile" id="inputFile">
        <div class="image-preview" id="imagePreview">
            <img class="image-preview__image" id="image_prev_update" src="" alt="Image Preview" >
            <span class="image-preview__default-text" id="default_text_update" > Image Preview</span>
        </div><br />
        <label for="user">Select image to upload:</label><br />
        <input type="file" name="file_update" id="file_update"/>
      </div>
    </div>
    <div class="modalFooter">
      <div class="btnData">
        <button type="button" class="closeBtn" id="cancelUpdate">Cancel</button>
        <button type="submit" class="enterBtn" name="contestant_btn_update" id="but_update">Update</button>
      </div>
    </form>
    </div>
  </div>  
</div>
  <!--##################################################################################################-->
  <!--##################################################################################################-->
  <!--##################################################################################################-->
</body>
</html> 
<script>
$(document).ready(function(){

  var gender = $('#contestant_filter').val();
  fetchData(gender);

  function fetchData(filter){
    var action = filter;
    $.ajax({
      url:"serverside/fetch_contestants.php",
      method:"POST",
      data: {action},
      success:function(data)
      {
        $('tbody').html(data);
      }
    });
  }

  $('#contestant_filter').change(function(){
      var filter_gender = $(this).val();
      $('tbody').fadeIn('fast');
      fetchData(filter_gender);
  });

  $('#contestant_search').keyup(function(){
    var query = $(this).val();
    console.log(query);
    if(query != '')
    {
      $.ajax({
        url:"serverside/fetch_contestants.php",
        method:"POST",
        data:{action:query},
        success:function(data)
        {
          $('tbody').fadeIn();
          $('tbody').html(data);
        }
      });
    }
    else
    {
      var gender = $('#contestant_filter').val();
      fetchData(gender);
    }
  });

  $("#checkall:checkbox").change(function(){
    $(".checkitem").prop("checked", $(this).prop("checked"));
    var count = $('.checkitem:checkbox:checked').length;
    //console.log(count);

    $('.checkitem:checkbox').change(function(){
      if($('.checkitem:checkbox:checked').length !== $(".checkitem:checkbox").length)
      {
        $("#checkall:checkbox").prop("checked", false);
      }
      else
      {
        $("#checkall:checkbox").prop("checked", true);
      }
    });
  });

  function imagePreview_add(event){
    var imagedeftext = document.getElementById("default_text");
    var imageprev = document.getElementById("image_prev");
    var file = event.files[0];

      if(file)
      {
        var image_name = $(event).val();
        if(image_name !== '')
        {
          var extension = image_name.split('.').pop().toLowerCase();
          if(jQuery.inArray(extension, ['gif','png','jpg','jpeg']) !== -1)
          {
            var reader =  new FileReader();

            imagedeftext.style.display = 'none';
            imageprev.style.display = 'block';

            reader.onload =  function(){
              if(reader.readyState == 2){
                image_prev.src = this.result;
              }
            }
            reader.readAsDataURL(file);
          }
          else
          {
            imagedeftext.style.display = null;
            imageprev.style.display = null;
            imageprev.setAttribute('src', '');
            return false;
          }
        }
      }
      else
      {
        imagedeftext.style.display = null;
        imageprev.style.display = null;
        imageprev.setAttribute('src', '');
        return false
      }
  }

  function imagePreview_update(event){
    var imagedeftext_update = document.getElementById("default_text_update");
    var imageprev_update = document.getElementById("image_prev_update");
    var file_up = event.files[0];

      if(file_up)
      {
        var image_names = $(event).val();
        if(image_names !== '')
        {
          var extensions = image_names.split('.').pop().toLowerCase();
          if(jQuery.inArray(extensions, ['gif','png','jpg','jpeg']) !== -1)
          {
            var reader =  new FileReader();

            imagedeftext_update.style.display = 'none';
            imageprev_update.style.display = 'block';

            reader.onload =  function(){
              if(reader.readyState == 2){
                image_prev_update.src = this.result;
              }
            }
            reader.readAsDataURL(file_up);
          }
/*          else
          {
            imagedeftext_update.style.display = null;
            imageprev_update.style.display = null;
            imageprev_update.setAttribute('src', '');
            return false;
          }*/
        }
      }
/*      else
      {
        imagedeftext_update.style.display = null;
        imageprev_update.style.display = null;
        imageprev_update.setAttribute('src', '');
        return false
      }*/
  }


  $('input#file').change(function(){
      imagePreview_add(this);
      var image_name = $('input#file').val();
      if(image_name !== '')
      {
        var extension = image_name.split('.').pop().toLowerCase();
        if(jQuery.inArray(extension, ['gif','png','jpg','jpeg']) == -1)
        {
          if(alert("Invalid Image File - only GIF, PNG, JPG, & JPEG are allowed to upload."))
          {}
          else
          {
            $('input#file').val('');return false;
          };

        }
        else
        {
          alert('Valid Image -'+extension+'');

        }
      }
  });

  $('input#file_update').change(function(){
      imagePreview_update(this);
      var image_names = $('input#file_update').val();
      if(image_names !== '')
      {
        var extensions = image_names.split('.').pop().toLowerCase();
        if(jQuery.inArray(extensions, ['gif','png','jpg','jpeg']) == -1)
        {
          if(alert("Invalid Image File - only GIF, PNG, JPG, & JPEG are allowed to upload."))
          {}
          else
          {
            $('input#file_update').val('');return false;
          };

        }
        else
        {
          alert('Valid Image -'+extensions+'');
        }
      }
  });



});

    
</script>