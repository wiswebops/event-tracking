<?php /*
session_start();
if(isset($_SESSION['user'])) { */
?>
<?php
include('includes/functions.php');

$Sesson_Rel = json_decode($_POST['Nodes']);
$CatalogSess = $_POST['catalogData'];

foreach($Sesson_Rel as $key => $value){
	foreach($value as $arrayValue)
	{		
	    save_room_2_session($key, $arrayValue);
	}
}

foreach($CatalogSess as $values){
	 save_room_2_session('NULL', $values);
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