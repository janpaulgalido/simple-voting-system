$(document).ready(function(){

	$('.logout').click(function(){

		if(confirm("Do you want to logout?"))
		{
			window.location = "logout.php";
		}
		else
		{
			return false;
		}
	});
	
});