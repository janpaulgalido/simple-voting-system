$(document).ready(function() {
	var update = document.getElementById("updateBtn");
	var modal = document.getElementById("modalUpdate");
	var openBtn = document.getElementById("editModal");
	var closeBtn = document.getElementById("closeUpdate");
	var cancel = document.getElementById('closeEditBtn');

	var edittitle = document.getElementById('edittitle');
	var editlocation = document.getElementById('editlocation');
	var editdate = document.getElementById('editdate');
	
	openBtn.onclick = function(){
		if(edittitle && editlocation && editdate != ""){
			modal.style.display = "block";
			$("#editContent").css("height","auto");
			$("#closeEditBtn").html("CANCEL");
		}
		else{
			modal.style.display = "block";
			update.style.display = "none";
			$("#editContent").css("height","200px");
			$("#closeEditBtn").html("OK");
		}	
	}
	closeBtn.onclick = function(){
		modal.style.display = "none";
		$('#formEdit')[0].reset();
	}
	cancel.onclick = function(){
		modal.style.display = "none";
		$('#formEdit')[0].reset();
	}

	$("#formEdit").on('submit', function(e){
		e.preventDefault();
		var fd = new FormData(this);
		$.ajax({
			url: "serverside/upEvent.php", 
			method: "POST",
			data: fd,
			contentType: false,
			cache: false,
			processData: false,
			beforeSend:function()
			{
				$('#updateBtn').attr('disabled','disabled');
				$('#formEdit').css("opacity", ".5");
			},
			success:function(msg)
			{
				if(msg == 'Yes')
				{
					alert("Data is successfully updated");
					$("#formEdit")[0].reset();
					location.reload();
				}
				else
				{
					alert("There is an error, data not updated");
				}

				$("#addBtn").removeAttr('disabled');
				$("#formEdit").css("opacity", "1");
			}
		});
	});
	
});