$(document).ready(function(){

	var open = document.getElementById('delete_contestant');

	$(open).click(function(){
    if($(".checkitem:checkbox:checked").length <= 0 )
    {
      alert('Please select tru checkbox \u2611 the data to delete.');
    }
    else
    {
      if(confirm('Are you sure you want to delete this?'))
      {
          var id = [];
          var path = [];
          $('.checkitem:checkbox:checked').each(function(i){
            id[i] = $(this).val();
            path[i] = $(this).attr('id');
          });
          console.log(id);
          console.log(path);
          
          $.ajax({
            url:"serverside/delCont.php",
            method:"POST",
            data:{id:id,path:path},
            success:function(data)
            {
              if(alert(data)){}else{location.reload()};
              $("#checkall").prop("checked", false);
            }
          });
      }
      else
      {
        $(".checkitem").prop("checked", false)
        $("#checkall").prop("checked", false)
        return false;
      }
    }
  });

});