<?php

    require_once('config.php');
    $output="";
    $query = "SELECT * FROM `tbl_subcri` WHERE `cri_id` = '".$_POST["criID"]."' ORDER BY subcri_name";
    $result = mysqli_query($con, $query);
    $output = '<option selected disabled="" value="">Select Subcriteria</option>';
    while ($row = mysqli_fetch_array($result)) 
    {
      $output .= '<option value="'.$row["subcri_id"].'">'.$row["subcri_name"].' ('.$row['subcri_rate'].'%)</option>' ;
    }
    echo $output;

?>