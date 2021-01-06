$(document).ready(function(){
	var modal = document.getElementById('modalUpdate');
	var open = document.getElementById('edit_modal');
	var close = document.getElementById('closeUpdate');
	var cancel = document.getElementById('cancelEdit');
	var update = document.getElementById('updateBtn');

	$(open).click(function(){
		var subcriId = $('#subcriteria').val();
		if (subcriId > 0)
		{
			modal.style.display = "block";
			update.style.display = "block";
			$('#editContent').css("height", "auto");
			$('#cancelEdit').html('CANCEL');
		}
		else
		{
			modal.style.display = "block";
			update.style.display = "none";
			$('#editContent').css("height", "200px");
			$('#cancelEdit').html('OK');
		}
		$.ajax({
			url:"serverside/fetch_subcriData.php",
			method:"POST",
			data:{subcriId:subcriId},
			dataType:"text",
			success:function(data)
			{
				$('#modalBody_subcriEdit').html(data);
			}
		});
	});

	$(update).click(function(){
		var name = $('#subcriEdit_name').val();
		var rate = $('#subcriEdit_rate').val();
		var desc = $('#subcriEdit_desc').val();
		var subcriId = $('#subcriteria').val();
		$.ajax({
			url:"serverside/upSubcri.php",
			method:"POST",
			data:{name:name, rate:rate, desc:desc, subcriId:subcriId},
			dataType:"text",
			success:function(msg)
			{
				if(msg == 'Yes')
				{
					if (alert('Data is successfully updated')) {} else {location.reload()};
				}
				else
				{
					if (alert('Data is not updated')) {} else {location.reload()};
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
	update.onclick = function(){
		modal.style.display = "none";
	}

});