<?php 

session_start();

if(isset($_SESSION["username"]) && isset($_SESSION["UID"]))
{
	echo "0";
}
else
{
	echo "1";
}

?>