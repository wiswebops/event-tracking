<?php /*
session_start();
if(isset($_SESSION['user'])) { */
?>
<?php
include('includes/functions.php');

if(isset($_POST['submit'])) {
		if(isset($_POST['confID'])) {
			addImages($_FILES['fileName']['name'],$_POST['name'],$_POST['confID']);
			header("Location: addImages.php");
		} else {
			echo "Please set a Conference ID!";
			include('addImages.php');
		}
	} else {
		header("Location: addImages.php");
	}
?>
<?php /*
} else {
	header("location: login.php");
}*/
mysql_close();
?>