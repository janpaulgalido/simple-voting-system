$(document).ready(function(){

	var modal = document.getElementById('modalUpdate');
	var open = document.getElementById('change_contestant');
	var close = document.getElementById('closeUpdate');
	var cancel = document.getElementById('cancelUpdate');
	var update = document.getElementById('but_update');


	$(open).click(function(){
		if($(".checkitem:checkbox:checked").length <= 0 )
	    {
	    	alert('Please select tru checkbox \u2611 the data to be updated.');
	    }
	    else if($('.checkitem:checkbox:checked').length > 1)
	    {
	    	alert('Please select not more than one checkbox.');
	    }
	    else
	    {	
	    	var id = $('.checkitem:checkbox:checked').val();
	    	$('#image_prev_update').css('display',"block");
	        document.getElementById('image_prev_update').src = "sidenav/"+$('.checkitem:checkbox:checked').attr('id')+"";
	        $('#default_text_update').css('display',"none");
	        modal.style.display = "block";
	        $('#contentUpdate').css({'width': '50%'});

	        $.ajax({
	          url: "serverside/fetch_contestantData.php",
	          method:"POST",
	          data:{id:id},
	          success:function(data)
	          {
	            $('#modalBody_update').append(data);
	          }
	        });
	    }	   
  	});


	$('#updateForm').submit(function(e){
		e.preventDefault();
		var fd = new FormData(this);
		var genderVal = $('input[name="cont_gender"]:checked').val();
		var old_imagepath = $('.checkitem:checkbox:checked').attr('id');
		var cont_id = $('.checkitem:checkbox:checked').val();

		fd.append('genderVal' ,genderVal);
		fd.append('old_imagepath' ,old_imagepath);
		fd.append('cont_id' ,cont_id);

		console.log(old_imagepath);
		console.log(genderVal);
		console.log(cont_id);

		$.ajax({
			url:"serverside/upCont.php",
			method:"POST",
			data:fd,
			contentType: false,
			cache: false,
			processData: false,
			success:function(msg)
			{
				if(alert(msg)){}else{location.reload()};
			}
		});
	});

  	close.onclick= function(){
  		modal.style.display = "none";
	    $('#inputNum').remove();
	    $('#inputRadio').remove();
	    $('#inputFname').remove();
	    $('#inputMname').remove();
	    $('#inputLname').remove();
	    $('#inputAddress').remove();
	    $('#image_prev_update').css('display',"none");
	    $('#default_text_update').css('display',"block");
  	}
  	cancel.onclick = function(){
  		modal.style.display = "none";
	    $('#inputNum').remove();
	    $('#inputRadio').remove();
	    $('#inputFname').remove();
	    $('#inputMname').remove();
	    $('#inputLname').remove();
	    $('#inputAddress').remove();
	    $('#image_prev_update').css('display',"none");
	    $('#default_text_update').css('display',"block");
  	}
  	update.onclick = function(){
  	modal.style.display = "none";
  	}

});