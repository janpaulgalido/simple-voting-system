<?php
	session_start();
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	
	<link rel="stylesheet" type="text/css" href="includes/fontawesome-free-5.13.0-web/css/all.css">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="includes/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/modal_style.css">
       <!-- Optional JavaScript -->
    	<!-- jQuery first, then Popper.js, then Bootstrap JS -->
		<script src="includes/jquery-3.5.0.js"></script>
		<script src="includes/popper.min.js"></script>
		<script src="includes/bootstrap.min.js"></script>

    <title>Login Page</title>
 	</head>

  	<body>
  
	
	<div class="container-fluid text-center" style="height: 90vh; padding-top: 40vh;">
		<h1>Welcome U:Elect</h1>
		<h3 class="mb-4">Voting and Tabulation System</h3>
		<button type="button" class="btn btn-lg  btn-primary btn-change shadow" name="login" id="login" data-toggle="modal" data-target="#myModal">Get Started</button>	
	</div>
	<div class="container-fluid text-center">
		<p class="mt-3">Created by: JP Galido &copy 2020</p>
	</div>	
	
  </body>
</html>


<!--The Modal-->
	
	<div class="modal fade shadow-lg text-center" id="myModal">
		<div class="modal-dialog modal-dialog-centered" role="document" id="myinput">
			<div class="modal-content" id="modal_content">
			
				<div class="modal-header text-center">
					<h4 class="modal-title" id="modal_title">Login</h4>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				
				<div class="modal-body mx-3" role="dialog">
					<form action="event.php" method="post">

						<div class="form-group mt-3">
						  	<div class="input-group input-group-lg-sm" >
						  		<div class="input-group-prepend">
									<span class="input-group-text rounded-left bg-primary pt-2 pb-3 pl-2 pr-2"><i class="fas fa-user" style="color: #fff;"></i></span>
								</div>
								<input type="text" class="form-control"  name="username" id="username" placeholder="Username" required="required" autocomplete="off"> 
							</div>
						</div>
						<div class="form-group">
							<div class="input-group input-group-lg-md">
								<div class="input-group-preprend">
									<span class="input-group-text rounded-left bg-primary pt-2 pb-3 pl-2 pr-2"><i class="fas fa-lock" style="color: #fff;"></i></span>
								</div>
								<input type="password" class="form-control" name="password" id="password" placeholder="Password" required="required" autocomplete="off"> 
							</div>
						</div>

						<div class="form-group">
								<button type="submit" name="loginbtn" id="loginbtn" class="btn btn-primary btn-block btn-lg-lg">Login</button>
						</div>
						<!-- <p class="hint-text mb-n2"><a href="#">Forgot Password?</a></p> -->
					</form>

				</div>
				
				<div class="modal-footer justify-content-center">
				</div>
			</div>
		</div>
	</div>
	<!-- End of Modal -->
	
<script>
	$(document).ready(function() {
		$('#loginbtn').click(function(e){
			e.preventDefault();
			var username = $('#username').val();
			var password = $('#password').val();
			if (username != '' && password != '') 
			{
				$.ajax({
					url:"serverside/action.php",
					method:"POST",
					data:{username:username, password:password},
					success:function(msg){
						//console.log(msg);
						if(msg == 'No')
						{
							alert("Error: Username or Password does not exists.");
							$('#username').focus();
						}
						else{
							$('#myModal').hide();
							
							$(location).attr('href', 'login_checker.php');
						}

					}
				});
			}
			else{
				alert("Both fields are required.");
				$('#username').focus();
			}

		});

		$("#myModal").on('hidden.bs.modal', function(){
		
		$('#username').val('');
		$('#password').val('');
			});

		$('#myModal').on('shown.bs.modal', function(){
			$('#username').focus();
		});

	});

</script>