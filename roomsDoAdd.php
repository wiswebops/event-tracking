<?php /*
session_start();
if(isset($_SESSION['user'])) { */
?>
<?php
include('includes/functions.php');
$RectNodes = json_decode($_POST['Nodes']);
foreach($RectNodes as $value){
	$NodeObject = simplexml_load_string($value);
	addRooms($_POST['confID'],$_POST['level_id'], $NodeObject['id'], $NodeObject['roomname'], $NodeObject['scannerid'], $NodeObject['x'], $NodeObject['y'], $NodeObject['width'], $NodeObject['height'], $value, ($NodeObject['delete'] ? $NodeObject['delete'] : NULL) );  
}


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