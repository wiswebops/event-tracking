<?php /*
session_start();
if(isset($_SESSION['user'])) { */
?>
<?php
include('includes/functions.php');

if(isset($_POST['submit'])) {
	if(isset($_POST['confID'])) {
		if(isset($_POST['name'])) {
			addConfs($_POST['confID'], $_POST['name'], $_POST['location']);
			addImages($_FILES['fileName']['name'],$_POST['imageName'],$_POST['confID']);
			header("Location: index.php");
		} else {
			echo "Please check your name!";
			include('index.php');
		}
	} else {
		echo "Please check your Conference ID";
		include('index.php');
	}
} else {
	header("Location: index.php");
}
?>
<?php /*
} else {
	header("location: login.php");
}*/
mysql_close();
?>