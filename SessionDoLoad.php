
<?php
include('includes/functions.php');

$floor_id = $_POST['level_id'];
$roomIds = implode(",",$_POST['room_ids']);
$SessionData = getSessionsByRoomIDs($roomIds);
echo json_encode($SessionData);
unset($SessionData);

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

?>