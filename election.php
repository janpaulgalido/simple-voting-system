<?php
session_start();
include 'serverside/loadMale.php';
include 'serverside/loadFemale.php';
?>
<!doctype html>
<html class="no-js" lang="EN">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>Election</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <script src="includes/jquery-3.5.0.js"></script>
        <script src="includes/jquery-ui.js"></script>
        <script src="js/logout.js"></script>
        <script src="js/chk_session.js"></script>

        <link rel="stylesheet" href="includes/w3-theme-blue.css">
        <link rel="stylesheet" href="includes/fontawesome-free-5.13.0-web/css/all.css">
        <!-- <link rel="stylesheet" href="includes/w3-theme-orange.css"> -->
        <link rel="stylesheet" href="includes/w3.css">
        <!-- <link rel="stylesheet" href="includes/jquery-ui-1.12.1/jquery-ui.css"> -->
	
	<style>
		/* Extra small devices (portrait phones, less than 576px) */
		@media screen and (max-width: 575.98px) {
		  h2.w3-cardfont{
		    font-size: 16px;
		  }
		}
		/* Small devices (landscape phones, less than 768px) */
		@media screen and (max-width: 767.98px) {
		  h2.w3-cardfont{
		    font-size: 18px;
		  }
		}
		/* Medium devices (tablets, less than 992px) */
		@media screen and (min-width: 768px)  {
		  h2.w3-cardfont{
		    font-size: 20px;
		  }
		}
		/* Large devices (desktops, less than 1200px)
		@media screen and (max-width: 1199.98px) {
			h2.w3-cardfont{
		    font-size: 30px;
		  }
		} */
	</style>

	</head>
    <body>

    	<?php
    	if(isset($_SESSION['username']) && isset($_SESSION["UID"]))
    	{
    		echo("<script>console.log('Judge UID: " . $_SESSION["UID"] . "');</script>");
    	?>
		
    	<div class="w3-display-container w3-theme-d4" style="height: 70px;">
    		<h2 class="w3-padding w3-display-topleft w3-margin-bottom">Welcome! - Mr/Ms <?php echo $_SESSION['username'];?></h2>
    		<h5 class="w3-padding w3-display-right w3-hover-grey w3-margin-right logout" style="cursor: pointer;"><i class="fas fa-sign-out-alt"></i>Logout</h5>
    	</div>
    	<div class="w3-container w3-theme-d3">
    		<div class="w3-row">
    			<div class="w3-col w3-container l8 w3-theme-d2" >
    				<div class="w3-container w3-theme-d2">
    					<div class="w3-panel w3-pale-blue w3-leftbar w3-border-blue">
    						<h5 class="w3-text-gray"><i class="fas fa-info-circle w3-margin-right"></i>Please select the tabs to see other candidates.</h5>
    					</div>
    					<div class="w3-bar w3-theme-d3">
    						<input type="button" id="btn_male" class="w3-bar-item w3-button tablink w3-blue" onclick="openCandidates(event, 'Male')" value="Male">
    						<input type="button" id="btn_female" class="w3-bar-item w3-button tablink" onclick="openCandidates(event, 'Female')" value="Female">
    					</div>
    					<!-- Male panel -->
    					<div id="Male" class="w3-panel w3-border w3-white candidate" style="height: 70vh; overflow-y:auto;">
							<div id="male_candidates" class="w3-row-padding w3-margin-top">
								<?php echo loadMale() ?>
							</div>
						</div>
						<!-- Female panel -->
						<div id="Female" class="w3-panel w3-border w3-white candidate" style="display:none; height: 70vh; overflow-y: auto;">
							<div id="female_candidates" class="w3-row-padding w3-margin-top w3-margin-bottom">
								<?php echo loadFemale() ?>
							</div>
						</div>
    				</div>
    			</div>
    			<div class="w3-col w3-container l4 w3-theme-d1" >
					<div id="form1_info_panel" class="w3-panel w3-pale-blue w3-leftbar w3-border-blue">
						<h5 class="w3-text-gray"><i class="fas fa-info-circle w3-margin-right"></i>Please select for template to use in scoring.</h5>
					</div>
					<div class="w3-container">
    					<p class="w3-half">
					  	<input class="w3-radio" type="radio" name="gender" value="criteria_only" id="criteria" onchange="showForm('criteria_only')" checked>
					  	<label>Criteria Only</label>
					  	</p>
					  	<p class="w3-half">
					  	<input class="w3-radio" type="radio" name="gender" value="with_subcriteria" id="subcriteria" onchange="showForm('with_subcriteria')">
					  	<label>With Sub Criteria</label>
					  	</p>
					</div>
					
				  	<div class="w3-card-4 w3-margin-top w3-margin-bottom w3-white">
						<div class="w3-container w3-theme-d3 w3-text-white">
						<h3>Scoring Form</h3>
						</div>
						<!-- criteria onliy form -->
						<form id="criteria_only" class="w3-container w3-padding temp" action="" method="POST">
							
						</form>
						<!-- with sub criteria form -->
						<form id="with_subcriteria" class="w3-container w3-padding temp" style="display:none;">
							<p>
							<select class="w3-select w3-border" name="criteria_option">
								<option value="" disabled selected>Choose criteria</option>
								<option>Criteria 1</option>
								<option>Criteria 2</option>
								<option>Criteria 3</option>
							</select></p>
							<p>
							<input class="w3-input" type="number" min="0" max="30">
							<label>First Name</label></p>
							<p>     
							<input class="w3-input" type="number" min="0" max="30">
							<label>Last Name</label></p>
							<p>
							<p><button class="w3-btn w3-amber" id="btn_form2">Submit</button></p>
						</form>
					</div>	
    			</div>
    		</div>
    	</div>
    	<div class="w3-container w3-theme-d4 w3-center">
    		<p>Created by: JP Galido &copy 2020</p>
    	</div>
    	<?php
    	}
		else{
		  echo "<h2>Please login first. Go to <a href='login.php' style='text-decoration:underline;'>Login</a> page.</h2>";
		}
		?>

    </body>
</html>

<script>
	//function to open candidates filtered by gender
	function openCandidates(evt, Gender)
	{
		var x, i, tablinks;
		x = document.getElementsByClassName("candidate");
		for(i = 0; i < x.length; i++)
		{
			x[i].style.display = "none";
		}
		tablinks = document.getElementsByClassName("tablink");
		for(i = 0; i < x.length; i++)
		{
			tablinks[i].className = tablinks[i].className.replace("w3-blue", " ");
		}
		document.getElementById(Gender).style.display = "block";
		evt.currentTarget.className += " w3-blue";
		$("div.active").removeClass('active w3-amber').addClass('inactive');
		$("div.inactive").css({'box-shadow': ''});
	}
	//function to filter scoring form according to template selected by user
	function showForm(form)
	{
		var x, i;
		x = document.getElementsByClassName("temp");
		for(i = 0; i < x.length; i++)
		{
			x[i].style.display = "none";
		}
		document.getElementById(form).style.display = "block";
	}


$(function()
{
/*$(document).tooltip({
	content:"<span class='ui-icon ui-icon-info'></span> Accepts number only.",
	position:{my:"right top", at:"right bottom"}
});*/

	// $(" #criteria_only input").focus(function(){
	// 	alert('test');
	// });

	// var gender = $("#btn_male").val();
	// fetchCandidates(gender);
	//function to fetch the images from database according to the selected gender
	// function fetchCandidates(gender)
	// {
	// 	//var select = filter;
	// 	var action = gender;
	// 	$.ajax(
	// 	{
	// 		url:"election.php",
	// 		method: "POST",
	// 		data: {action},
	// 		success:function(data)
	// 		{
	// 			if(action == 'Male')
	// 			{
	// 				$("#male_candidates").html(data);
	// 			}
	// 			else if(action == 'Female')
	// 			{
	// 				$("#female_candidates").html(data);
	// 			}
	// 		}
	// 	});
	// }
	//event to fetch pictures of male candidates from database
	// $("#btn_male").click(function(){

	// 	var gender = $(this).val();
	// 	fetchCandidates(gender)

	// });
	// //event to fetch pictures of female candidates from database
	// $("#btn_female").click(function(){

	// 	var gender = $(this).val();
	// 	fetchCandidates(gender)

	// });
	//event to call the function to show the input field of criteria_only
	$("#criteria").change(function(){
		if($(this).prop("checked"))
		{
			var temp = $("input#criteria").val()
			//console.log(temp);
			showCriteriaInput(temp);
			$('#criteria_only :input:enabled:visible:first').focus();
		}
	});
	//event to call the function to show the input field of with_subcriteria
	$("#subcriteria").change(function(){
		if($(this).prop("checked"))
		{
			var temp = $("input#subcriteria").val();
			//showCriteriaInput(temp);
			$("#with_subcriteria :input:enabled:visible:first").focus();

			$("#form1_info_panel").removeClass('w3-border-red w3-pale-red').addClass('w3-border-blue w3-pale-blue');
			$("#form1_info_panel >h5").removeClass("w3-text-red").addClass("w3-text-gray");
			$("#form1_info_panel > h5 ").html('<i class="fas fa-info-circle w3-margin-right"></i>Please select for template to use in scoring.');
		}
	});

	var temp = $("#criteria").val();
	showCriteriaInput(temp);
	
	//function to show the criteria to be fill by the judges
	function showCriteriaInput(template)
	{
		var action = template;
		$.ajax({
			url: "serverside/fetch_criteria_field.php",
			method: "POST",
			data: {action},
			dataType: "text",
			success:function(data)
			{
				$("form#criteria_only").html(data);
				$("form#criteria_only").append('<p><button type="submit" class="w3-btn w3-amber" id="btn_form1_submit">Submit</button> <button type="button" class="w3-btn w3-theme-d1" id="btn_form1_update" disabled>Update</button> <button type="reset" class="w3-btn w3-deep-orange" id="btn_form1_reset">Reset</button></p>');
				$('#criteria_only :input:enabled:visible:first').focus();
				
			}
		});
	}

	$("#criteria_only").on('submit', function(e){
		e.preventDefault();
		var isValid = true;

		$("#criteria_only input[type=number]").each(function(){
								
			if($.trim($(this).val()).length == 0)
			{
				isValid = false;	
			}
			else
			{
				$("#form1_info_panel").removeClass('w3-border-red w3-pale-red').addClass('w3-border-blue w3-pale-blue');
				$("#form1_info_panel >h5").removeClass("w3-text-red").addClass("w3-text-gray");
				$("#form1_info_panel > h5 ").html('<i class="fas fa-info-circle w3-margin-right"></i>Please select for template to use in scoring.');
			}
			
		});	
		if(isValid)
		{
			
			// $("div.contestant > img").click(function(){
			// 	var contestant_id = $("div.contestant > img").attr("id");
			// 	console.log(contestant_id)
			// 	$.ajax({
			// 		url: "serverside/insertScore.php",
			// 		method:"POST",
			// 		data:{},
			// 		success:function()
			// 		{

			// 		}
			// 	});
			// });
		}
		else if(!isValid)
		{
			$("#form1_info_panel").removeClass('w3-border-blue w3-pale-blue').addClass('w3-border-red w3-pale-red');
			$("#form1_info_panel >h5").removeClass("w3-text-gray").addClass("w3-text-red");
			$("#form1_info_panel > h5 ").html('<i class="fas fa-info-circle w3-margin-right"></i><strong>Please fill in all fields.</strong>');
			$("div#form1_info_panel").effect( "shake", { direction: "left", times: 3, distance: 5})			
		}
		
	});

	//function to indicate which candidates is selected and ready to be scored.
	$("div.inactive").click(function(){
		$("div.active").removeClass('active w3-amber').addClass('inactive');
		$("div.inactive").css({'box-shadow': ''});
		$(this).removeClass('inactive').addClass('active');
		$("#criteria_only input[type=number]").first().focus();

		if($(this).hasClass('active'))
		{
			$(this).addClass('w3-amber');
			$(this).css({'box-shadow': '1px 10px 6px -6px rgba(3,3,150,3)'});
			
		}

		var candidate_id = $(this).attr("id");
		console.log(candidate_id);
		$.ajax({
			url: "serverside/fetch_criteria_field.php",
			method:"POST",
			data: {candidate_id:candidate_id},
			dataType: 'text', 
			success:function(data)
			{
				$("form#criteria_only").html(data);


				$("form#criteria_only").append('<p><button type="submit" class="w3-btn w3-amber" id="btn_form1_submit">Submit</button> <button type="button" class="w3-btn w3-theme-d1" id="btn_form1_update" disabled>Update</button> <button type="reset" class="w3-btn w3-deep-orange" id="btn_form1_reset">Reset</button></p>');
			}

		});

	});







});



</script>