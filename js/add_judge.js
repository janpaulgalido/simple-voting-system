$(document).ready(function(){
	var modal = document.getElementById('modalAdd');
	var open = document.getElementById('add_modal');
	var close = document.getElementById('closeAdd');
	var cancel = document.getElementById('cancelAdd');
	var add = document.getElementById('addBtn');
	var form = document.getElementById('addForm');

	$(open).click(function(){
		modal.style.display = "block";
	});

	$(add).click(function(){
		var fname = $('#judgeAdd_fname').val();
		var contact = $('#judgeAdd_contact').val();
		var username = $('#judgeAdd_uname').val();
		var password = $('#judgeAdd_password').val();
		var UID = $("#judgeAdd_ID").val();
		$.ajax({
			url:"serverside/addJudge.php",
			method:"POST",
			data:{fname:fname, contact:contact, username:username, password:password, UID:UID},
			dataType:"text",
			success:function(msg)
			{
				if(msg == 'Yes')
				{
					if (alert('Data is successfully saved')) {} else {modal.style.display = "none"; location.reload()};
				}
				else
				{
					//if (alert(msg)) {} else {location.reload()};
					alert(msg);

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
	// add.onclick = function(){
	// 	modal.style.display = "none";
		
	// }	
});