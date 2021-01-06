$(document).ready(function(){
	function checkSession(){
		$.ajax({
			url: "serverside/check_session.php",
			method: "POST",
			success:function(data){
				if(data == '1')
				{
					alert('Your session has been expired!');
					window.location.href = "login.php";
				}

			}
		});
	}

	setInterval(function(){
		checkSession();
	},10000);


});
