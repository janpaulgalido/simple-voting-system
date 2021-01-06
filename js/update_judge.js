$(document).ready(function(){
	var modal = document.getElementById('modalUpdate');
	var open = document.getElementById('edit_modal');
	var close = document.getElementById('closeUpdate');
	var cancel = document.getElementById('cancelEdit');
	var update = document.getElementById('updateBtn');
	
	$(open).click(function(){
		var id = $('#judges').val();
		if(id > 0)
		{
			modal.style.display = "block";
			update.style.display = "block";
			$('#cancelEdit').html('CANCEL');
			$('#editContent').css('height', 'auto');

		}
		else
		{
			modal.style.display = "block";
			update.style.display = "none";
			$('#cancelEdit').html('OK');
			$('#editContent').css('height', "200px");		
		}
		$.ajax({
			url:"serverside/fetch_judgeData.php",
			method:"POST",
			data:{id:id},
			success:function(data)
			{
				$('#modalBody_judgeEdit').html(data);
			}
		});
	});

	$(update).click(function(){
		var id = $('#judges').val();
		var fname = $('#judgeEdit_fname').val();
		var contact = $('#judgeEdit_contact').val();
		var username = $('#judgeEdit_username').val();
		var password = $('#judgeEdit_password').val();

		$.ajax({
			url:"serverside/upJudge.php",
			method:"POST",
			data:{id, fname, contact, username, password},
			dataType:"text",
			success:function(msg)
			{
				if(msg == 'Yes')
				{
					if (alert('Data successfully updated')) {} else {modal.style.display = "none"; location.reload()};
				}
				else
				{
					alert(msg);
				}
			}
		});
	});

	close.onclick = function(){
		modal.style.display = "none";
		$("form#editForm")[0].reset();
	}
	cancel.onclick = function(){
		modal.style.display = "none";
		$("form#editForm")[0].reset();
	}
	// update.onclick = function(){
	// 	modal.style.display = "none";
	// }
});