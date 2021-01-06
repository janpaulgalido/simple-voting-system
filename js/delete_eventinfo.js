$(document).ready(function(){
	var modal = document.getElementById('modalDelete');
	var open = document.getElementById('deleteModal');
	var close = document.getElementById('closeDelete');
	var cancel = document.getElementById('closeDeleteBtn');
	var del = document.getElementById("deleteBtn");
	var idDel = document.getElementById("idDel");

	open.onclick = function(){
		if(idDel != '' ){
			modal.style.display = "block";
			del.style.display = "block";
			$("#modalBody_eventDel").html("<h4>Do you reall want to delete current data?</h4>");
			$("#deleteBtn").html("DELETE");
			$("#delContent").css("height", "200px");
		}
		else{
			modal.style.display = "block";
			del.style.display = "none";
			$("#modalBody_eventDel").html('<h4 style="color: red;"><i class="fas fa-exclamation-circle" style="font-size: 24px;">&nbsp</i>No data found. Set data first.</h4>');
			$("#closeDeleteBtn").html("OK");
			$("#delContent").css("height", "200px");
		}
	}
	close.onclick = function(){
		modal.style.display = "none";
		$('form#deleteform')[0].reset();
	}
	cancel.onclick = function(){
		modal.style.display = "none";
		$('form#deleteform')[0].reset();
	}

	$("#deleteform").on('submit', function(e){
		e.preventDefault();
		var fd = new FormData(this);

		$.ajax({
			url: "serverside/delEvent.php",
			method:"POST",
			data: fd,
			contentType: false,
			cache: false,
			processData: false,
			success:function(msg)
			{
				if(msg == 'Yes')
				{
					alert("Data has been successfully deleted.");
					location.reload();
				}
				else
				{
					alert("Error: Data is not deleted.");
					location.reload();
				}
			}
		});
	});

});