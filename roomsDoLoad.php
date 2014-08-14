<?php /*
session_start();
if(isset($_SESSION['user'])) { */
?>
<?php
include('includes/functions.php');
$floor_id = $_POST['level_id'];

$Rooms = getRoomsByLevelID($floor_id);
echo json_encode($Rooms);
unset($Rooms);
mysql_close();
return;

if(isset($_POST['submit'])) {
	if(isset($_POST['confID'])) {
		if(isset($_POST['name'])) {
			addRooms($_POST['confID'], $_POST['name'], $_POST['scannerID'], $_POST['x'], $_POST['y'], $_POST['width'], $_POST['height']);
			header("Location: roomView.php");
		} else {
			echo "Please check your name!";
			include('index.php');
		}
	} else {
		echo "Please check your Conference ID";
		include('index.php');
	}
} else {
	header("Location: roomView.php");
}
?>
<?php /*
} else {
	header("location: login.php");
}*/
mysql_close();
?>