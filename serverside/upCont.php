<?php
require_once 'config.php';

if (isset($_POST['contestant_btn_update'])) {

	$cont_number  = $_POST['cont_number'];
	$cont_age     = $_POST['cont_age'];
	$genderVal    = $_POST['genderVal'];
	$cont_contact = $_POST['cont_contact'];
	$cont_Fname   = $_POST['cont_Fname'];
	$cont_Mname   = $_POST['cont_Mname'];
	$cont_Lname   = $_POST['cont_Lname'];
	$cont_address = $_POST['cont_address'];
	$cont_oldpath = $_POST['old_imagepath'];
	$cont_id      = $_POST['cont_id'];

	$query = "UPDATE `tbl_contestant` SET `cont_number`= '$cont_number',`cont_Fname`= '$cont_Fname',`cont_Mname`='$cont_Mname',`cont_Lname`= '$cont_Lname',`cont_address`= '$cont_address' ,`cont_contact`= '$cont_contact' ,`cont_gender`= '$genderVal' ,`cont_age`= '$cont_age' WHERE `cont_id` = '$cont_id' ";
		if(mysqli_query($con, $query))
		{
			echo "The data has been updated to the database.";
		}
		else
		{
			echo "There is an error updating your data to the database";
		}

}
	
	function imageCreateFromAny($filesource) {

		$type         = exif_imagetype($filesource);
		$allowedtypes = array(1,2,3);
		if(!in_array($type, $allowedtypes))
		{
			return false;
		}
		switch ($type)
		{
			case 1:
				$imageResource = imagecreatefromgif($filesource);
				break;
			case 2:
				$imageResource = imagecreatefromjpeg($filesource);
				break;
			case 3:
				$imageResource = imagecreatefrompng($filesource);
				break;
		}
		return $imageResource;
	}

	

	if(isset($_FILES['file_update']) && !empty($_FILES['file_update']['tmp_name'])) {

		$name            = $_POST['cont_Fname']."_ ".$_POST['cont_Lname'];
		$filename        = $_FILES["file_update"]["name"];
		$filepath        = $_FILES["file_update"]["tmp_name"];
		$folder          = "/uploads/";
		$location        = "..".$folder.$name."_".basename($filename);
		$image_extension = strtolower(pathinfo($location, PATHINFO_EXTENSION));
		$uploadOk        = 1;


		$exif = @exif_read_data($filepath);
		if(!empty($exif['Orientation']) && !empty($filepath)) {

			$imageResource = imageCreateFromAny($filepath);
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
			imagejpeg($imageResource, $filepath, 80);
			imagedestroy($imageResource);
			

			//Check if image file is a actual image or fake image
			$check = exif_imagetype($filepath);
			$mime = image_type_to_mime_type(exif_imagetype($filepath));
			if($check !== false) {

				//echo "File is an image - " .$mime. ". ";
				$uploadOk = 1;
				switch ($check)
				{
					case IMAGETYPE_GIF:
					imagegif($image, $filepath, 90);
					break;
					case IMAGETYPE_JPEG:
					imagejpeg($image, $filepath, 90);
					break;
					case IMAGETYPE_PNG:
					imagepng($image, $filepath, 90);
					break;	
				}
				
			}
			else
			{
				echo "File is not an image. ";
				$uploadOk = 0;
			}
		}

		//Check if file already exists
		if(file_exists($location))
		{
			echo "Sorry, file already exists. ";
			$uploadOk = 0;
		}
		//Check file size
		if($_FILES["file_update"]["size"] > 2000000)
		{
			echo "Sorry, your file is too large. ";
			$uploadOk = 0;
		}
		//Allow certain file formats
		if($image_extension != "jpg" && $image_extension != "png" && $image_extension != "jpeg" && $image_extension != "gif" && !empty($filepath))
		{
			echo "Sorry, only JPG, JPEG, PNG, & GIF files are allowed. ";
			$uploadOk = 0;
		}
		//Check if $uploadOk is set to 0 by an error
		if($uploadOk == 0)
		{
			echo "";
		}
		//if everything is ok, try to upload file
		else 
		{
			move_uploaded_file($filepath, $location);
			unlink($cont_oldpath); //this delete the old image uploaded from the foler '/uploads/'

			$query = "UPDATE `tbl_contestant` SET `cont_number`= '$cont_number',`cont_Fname`= '$cont_Fname',`cont_Mname`='$cont_Mname',`cont_Lname`= '$cont_Lname',`cont_address`= '$cont_address' ,`cont_contact`= '$cont_contact' ,`cont_gender`= '$genderVal' ,`cont_age`= '$cont_age' ,`cont_picture`= '$location' WHERE `cont_id` = '$cont_id' ";
				if(mysqli_query($con, $query))
				{
					echo "The data has been updated to the database.";

				}
				else
				{
					echo "Data is not updated there is an error: <strong>{$location}</strong>";
				}
		}

	}
	


mysqli_close($con);

?>
