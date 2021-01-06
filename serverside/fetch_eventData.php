<?php
function loadeventData()
{
	require 'config.php';

    $query = "SELECT * FROM `tbl_pginfo` LIMIT 1";
    $result = mysqli_query($con, $query);

    if(mysqli_num_rows($result) > 0)
    {
    	while($row = mysqli_fetch_assoc($result))
    	{
    		echo 	'<div class="eventData1">
		              <h4><span id="demo" style=" color: #ff8c00">&nbsp:&nbsp'.$row["pg_Title"].'</span></h4>
		              <h4><span id="demo" style=" color: #ff8c00">&nbsp:&nbsp'.$row["pg_Location"].'</span></h4>
		              <h4><span id="demo" style=" color: #ff8c00">&nbsp:&nbsp'.date("l jS \of F Y", strtotime($row["pg_Date"])).'</span></h4>
		              <h4><span id="demo" style=" color: #ff8c00">&nbsp:&nbsp'.$row["pg_Description"].'</span></h4>
	            	</div>';
    	}
    }
    else
    {
    	 echo '<div class="eventData1">
              <h4><span id="demo1" style=" color: red">&nbsp:&nbspNone</span></h4>
              <h4><span id="demo1" style=" color: red">&nbsp:&nbspNone</span></h4>
              <h4><span id="demo1" style=" color: red">&nbsp:&nbspNone</span></h4>
              <h4><span id="demo1" style=" color: red">&nbsp:&nbspNone</span></h4>
            </div>';
    }

	mysqli_close($con);
}
?>