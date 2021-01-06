$(document).ready(function(){
	var modal = document.getElementById('modalDelete');
	var open = document.getElementById('delete_modal');
	var close = document.getElementById('closeDelete');
	var cancel = document.getElementById('cancelDelete');
	var del = document.getElementById('deleteBtn');

	$(open).click(function(){
		var id = $('#judges').val();
		if(id > 0)
		{
			modal.style.display = "block";
			del.style.display = "block";
			$('#cancelDelete').html('CANCEL');
			$("#delContent").css("height", "200px");
			$('#modalBody_judgeDel').html("<h4>Do you want to delete <span style='color:red;'>"+$('#judges option:selected').text()+"'s</span> data?</h4>");
		}
		else
		{
			modal.style.display = "block";
			del.style.display = "none";
			$('#cancelDelete').html('OK');
			$("#delContent").css("height", "200px");
			$('#modalBody_judgeDel').html("<h4 style='color:red;'><i class='fas fa-exclamation-circle' style='font-size: 24px;'>&nbsp&nbsp</i>No data is selected. Please select first.</h4>");
		}
	});

	
	$("#deleteBtn").click(function(){
		var id = $('#judges').val();
		$.ajax({
			url:"serverside/delJudge.php",
			method:"POST",
			data:{id:id},
			success:function(msg)
			{
				if(msg == 'Yes')
				{
					if (alert('Data is successfully deleted')) {} else {location.reload()};
				}
				else
				{
					if (alert('Data is not deleted')) {} else {location.reload()};
				}
			}
		});
	});

	close.onclick = function(){
		modal.style.display = "none";
	}
	cancel.onclick = function(){
		modal.style.display = "none";
	}
	del.onclick = function(){
		modal.style.display = "none";
	}
});