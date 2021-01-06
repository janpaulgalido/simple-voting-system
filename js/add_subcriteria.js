$(document).ready(function(){
	var modal = document.getElementById('modalAdd');
	var open = document.getElementById('add_modal');
	var close = document.getElementById('closeAdd');
	var cancel = document.getElementById('cancelAdd');
	var add = document.getElementById('addBtn');
	var form = document.getElementById('addForm');

	$(open).click(function(){
		var Id = $('#criteria').val();
		if(Id > 0 ){
			modal.style.display = "block";

		}
		else{
			if (alert('Error: Select Criteria first before adding subcriteria.')) {} else {location.reload()};
		} 
	});
	$(add).click(function(){
		var name  = $('#subcriAdd_name').val();
		var rate  = $('#subcriAdd_rate').val();
		var desc = $('#subcriAdd_desc').val();
		var criId = $('#criteria').val();

			$.ajax({
			url:"serverside/addSubcri.php",
			method:"POST",
			data:{name,rate,desc,criId},
			dataType:"text",
			success:function(msg){
				if (msg == 'Yes')
				{
					if (alert('Successfully saved')) {} else {location.reload()};
				}
				else
				{
					if (alert('Data is not saved. Fill in input fields.')) {} else {location.reload()};
				}
			}
		});
		});

	close.onclick = function(){
		modal.style.display = "none";
		form.reset();
	}
	cancel.onclick = function(){
		modal.style.display = "none";
		form.reset();
	}
	add.onclick = function(){
		modal.style.display = "none";
		
	}
});