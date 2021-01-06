$(document).ready(function(){
	var modal = document.getElementById('modalDelete');
	var open = document.getElementById('delete_modal');
	var close = document.getElementById('closeDelete');
	var cancel = document.getElementById('cancelDelete');
	var del = document.getElementById("deleteBtn");
	
	$(open).click(function(){	
		var subcriId = $('#subcriteria').val();
		if(subcriId > 0 ){
			modal.style.display = "block";
			del.style.display = "block";
			$("#cancelDelete").html("CANCEL");
			$("#delContent").css("height", "200px");
			$("#delContent").css("width", "30%");
			$('#modalBody_subcriDel').html("<h4>Do you want to delete <span style='color:red;'>"+$('#subcriteria option:selected').text()+"'s</span> data?</h4>");
			console.log(subcriId);
		}
		else{
			modal.style.display = "block";
			del.style.display = "none";
			$("#cancelDelete").html("OK");
			$("#delContent").css("height", "200px");
			$("#delContent").css("width", "500px");
			$('#modalBody_subcriDel').html('<h4 style="color:red;"><i class="fas fa-exclamation-circle" style="font-size: 24px;">&nbsp</i>No Sub Criteria data is selected. Please select first.</h4>');
			console.log(subcriId);
		} 
	});
	   $(del).click(function(){
      var subcriId = $('#subcriteria').val();
      $.ajax({
        url:"serverside/delSubcri.php",
        method:"POST",
        data:{subcriId},
        dataType:"text",
        success:function(msg)
        {
          if(msg == 'No')
          {
            if (alert('Data is not deleted')) {} else {location.reload()};
          }
          else
          {  
            if (alert('Data is successfuly deleted')) {} else {location.reload()};
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
	del.onclick = function(){
		modal.style.display = "none";
		
	}
});