$(document).ready(function(){

		var modal = document.getElementById("modalAdd");
		var form = document.getElementById("addForm");
		var open = document.getElementById("add_modal");
		var cancel = document.getElementById('closeBtn');
		var close = document.getElementsByClassName("close")[0];


		open.onclick = function(){
		  modal.style.display = "block";
		}
	
		cancel.onclick = function(){
			modal.style.display = "none";
			form.reset();
		}
		close.onclick = function() {
		  modal.style.display = "none";
		  form.reset();
		}
		window.onclick = function(event) {
		  if (event.target == modal) {
		    modal.style.display = "none";
		    form.reset();
		  }
		}

});
