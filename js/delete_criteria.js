$(document).ready(function(){
	var modal = document.getElementById('modalDelete');
	var open = document.getElementById('delete_modal');
	var close = document.getElementById('closeDelete');
	var cancel = document.getElementById('closeDeleteBtn');
	var del = document.getElementById("deleteBtn");
	
	$(open).click(function(){	
		var criId = $("#criteria").val();
		if(criId > 0 ){
			modal.style.display = "block";
			del.style.display = "block";
			$("#closeDeleteBtn").html("CANCEL");
			$("#delContent").css("height", "200px");
			$('#modalBody_criDel').html("<h4>Do you want to delete <span style='color:red;'>"+$('#criteria option:selected').text()+"'s</span> data?</h4>");
			console.log(criId);
		}
		else{
			modal.style.display = "block";
			del.style.display = "none";
			$("#closeDeleteBtn").html("OK");
			$("#delContent").css("height", "200px");
			$('#modalBody_criDel').html('<h4 style="color:red;"><i class="fas fa-exclamation-circle" style="font-size: 24px;">&nbsp</i>No Criteria data is selected. Please select first.</h4>');
			console.log(criId);
		} 
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