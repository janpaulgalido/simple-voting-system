$(document).ready(function(){
		//var submit = document.getElementById("addBtn");
		var modal = document.getElementById("myModal");
		var editBtn = document.getElementById("editModal");
		var deleteBtn = document.getElementById("deleteModal");
		var form = document.getElementById("createform");


		// Get the button that opens the modal
		var btn = document.getElementById("createModal");
		//Get the button that cancel the opening of modal
		var cancel = document.getElementById('closeBtn');
		// Get the <span> element that closes the modal
		var span = document.getElementsByClassName("close")[0];

		// When the user clicks the button, open the modal 
		btn.onclick = function(){
		  modal.style.display = "block";
		}
		
		cancel.onclick = function(){
			modal.style.display = "none";
			form.reset();
		}

		// When the user clicks on <span> (x), close the modal
		span.onclick = function() {
		  modal.style.display = "none";
		  form.reset();
		}

		// When the user clicks anywhere outside of the modal, close it
		window.onclick = function(event) {
		  if (event.target == modal) {
		    modal.style.display = "none";
		    form.reset();
		  }
		}

		$("#createform").on('submit', function(e){
			e.preventDefault();
			var fd = new FormData(this);
			$.ajax({
				url: "serverside/addEvent.php", 
				method: "POST",
				data: fd,
				contentType: false,
				cache: false,
				processData: false,
				beforeSend:function()
				{
					$('#addBtn').attr('disabled','disabled');
					$('#createform').css("opacity", ".5");
				},
				success:function(msg)
				{
					if(msg == 'Yes')
					{
						alert("Data is successfully inserted");
						$("#createform")[0].reset();
						location.reload();
					}
					else if(msg == 'Not')
					{
						alert("Please complete all the fields");
					}
					else{
						alert("There is an error, data not inserted");
					}

					$("#addBtn").removeAttr('disabled');
					$("#createform").css("opacity", "1");
				}
			});
		});
});