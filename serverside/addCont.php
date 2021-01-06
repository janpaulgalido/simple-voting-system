<?php 
require 'config.php';

if(isset($_POST['contestant_btn']) ) {

	

	// $name = $_POST['cont_Fname']."_".$_POST['cont_Lname'];
	// $filename = $_FILES["file"]["name"];
	// $folder = "/uploads/";
	// $strExt = explode('.', $filename);
	// $ext = end($strExt);
	// $location = "..".$folder.$name.'_'.date('m-d-Y').'.'.$ext;

	$cont_number  = $_POST['cont_number'];
	$cont_age     = $_POST['cont_age'];
	$genderVal    = $_POST['genderVal'];
	$cont_contact = $_POST['cont_contact'];
	$cont_Fname   = $_POST['cont_Fname'];
	$cont_Mname   = $_POST['cont_Mname'];
	$cont_Lname   = $_POST['cont_Lname'];
	$cont_address = $_POST['cont_address'];

	$query = "INSERT INTO `tbl_contestant` (`cont_number`,`cont_Fname`,cont_Mname,cont_Lname,cont_address,cont_contact,cont_gender,cont_age,) VALUES ('$cont_number','$cont_Fname','$cont_Mname','$cont_Lname','$cont_address','$cont_contact','$genderVal','$cont_age')";

	if(mysqli_query($con, $query))
	{
		echo "The data has been uploaded to the database.";
	}
	else
	{
		echo "Data is not uploaded there is an error: <strong>{$location}</strong>";
	}
}

if(isset($_FILES['file'])) {

	// $strExt = explode('.', $filename);
	// $ext = end($strExt);
	$name = $_POST['cont_Fname']."_".$_POST['cont_Lname'];
	$temp_filename = $_FILES["file"]["tmp_name"];
	$target_dir = '/uploads/';
	$uploadOk = 1;
	$image_filetype = strtolower(pathinfo($target_dir.basename($_FILES['file']['name']), PATHINFO_EXTENSION));
	$target_file = "..".$target_dir.$name.'_'.date('m-d-Y').".".$image_filetype;

	$exif = @exif_read_data($temp_filename);

	if(!empty($exif['Orientation'])) {
		$imageResource = imagecreatefromjpeg(file_get_contents($temp_filename));

		switch ($exif['Orientation']) {

			case 3:
			$image = imagerotate($imageResource, 180, 0);
			break;
			case 6:
			$image = imagerotate($imageResource, -90, 0);
			break;
			case 8:
			$image = imagerotate($imageResource, 90, 0);
			break;
			default:
			$image = $imageResource;
		}
		imagejpeg($image, $temp_filename, 90);
		imagedestroy($imageResource);
	}

	// Check if a file is valid
	if (isset($_POST['contestant_btn'])) {

        $check = getimagesize($_FILES['file']['tmp_name']);
        if ($check !== false) {
            echo "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            echo "File is not an image.";
            $uploadOk = 0;
        }
    }

	//Check if file already exists
	if(file_exists($target_dir))
	{
		echo "Sorry, file already exists. ";
		$uploadOk = 0;
	}
	//Check file size
	if($_FILES["file"]["size"] > 2000000)
	{
		echo "Sorry, your file is too large. ";
		$uploadOk = 0;
	}
	//Allow certain file formats
	if($image_filetype != "jpg" && $image_filetype != "png" && $image_filetype != "jpeg" && $image_filetype != "gif")
	{
		echo "Sorry, only JPG, JPEG, PNG, & GIF files are allowed. ";
		$uploadOk = 0;
	}

	if($uploadOk == 0) {
		echo "Sorry, file is not upploaded";
	}
		
	if(move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)){
		$query = "INSERT INTO `tbl_contestant` (`cont_picture`) VALUES ('$target_file')";
		
		if(mysqli_query($con, $query))
		{
			echo "The data has been uploaded to the database.";
		}
		else
		{
			echo "Data is not uploaded there is an error: <strong>{$target_file}</strong>";
		}
	}
	else {
		echo "Sorry there was an error uploading your file.";
	}
	
		
} 
	


?>