$(document).ready(function(){
	var modal = document.getElementById('modalUpdate');
	var open = document.getElementById('edit_modal');
	var close = document.getElementById('closeUpdate');
	var cancel = document.getElementById('cancelEdit');
	var upBtn = document.getElementById('updateBtn');

	

	$(open).click(function(){
		var criId = $('#criteria').val();

		if (criId > 0) {
			modal.style.display = 'block';
			upBtn.style.display = 'block';
			$('#editContent').css("height", "auto");
			$('#cancelEdit').html('CANCEL');
		} 
		else {
			modal.style.display = 'block';
			upBtn.style.display = 'none';
			$('#editContent').css("height", "200px");
			$('#cancelEdit').html('OK');
			console.log('error');
		}
		$.ajax({
        url:"serverside/fetch_criteriaData.php",
        method:"POST",
        data:{criId:criId},
        dataType:"text",
        success:function(data)
        {
          $('#modalBody_criEdit').html(data);
        }
      	})
      	.done(function(){
      		var oldname = $('#criteriaEdit_name').val();
	    	console.log(oldname);
      		$.ajax({
      			url:"serverside/fetch_criteriaData.php",
		        method:"POST",
		        data: oldname,
		        dataType:"text"
      		});
      	});
	});
	close.onclick = function(){
		modal.style.display = 'none';
	}
	cancel.onclick = function(){
		modal.style.display = 'none';
	}
	upBtn.onclick = function(){
		modal.style.display = 'none';
	}
});