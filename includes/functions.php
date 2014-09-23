<?php
include('connect.php');
date_default_timezone_set('EST');

/* // Add User function
function addUser($name, $username, $password, $email, $adminLevel) {
	$password = md5($password);
	$adminLevel = '3';
	$query = mysql_query("INSERT INTO users VALUES(null,'$name','$username','$password','$email','$adminLevel')") or die(mysql_error());
	header("Location: users.php");
}

// Edit User function
function editUser($name, $username, $password, $email, $adminLevel, $id) {
	$id = (int) $id;
	$query_users = "UPDATE users SET name = \"$name\", username = \"$username\" ";
		if ($password != null) {
			$password = md5($password);
			$query_users = $query_users . ",password = \"$password\" ";
		} else {echo "empty";}
			$query_users = $query_users . ", email = \"$email\", adminLevel = \"$adminLevel\" WHERE ID = \"$id\" "; 
	mysql_query($query_users) or die(mysql_error());
	header("Location: users.php");
} */


// Add conferences function

function addConfs($confID, $name, $location) {
	//$username = $_SESSION['user'];
	$query = mysqli_query($connection,"INSERT INTO confs VALUES(null,\"$confID\", \"$name\", \"$location\")");
	//header("Location: requests.php");
}

// Edit conferences function

/* function editDomain($dateRequested, $domain, $extension, $years, $purchaseCode, $department, $dateCreated, $approved, $comments, $username, $id) {	
	$id = (int) $id;
	if ($dateCreated == "0000-00-00" && $approved == "Yes") {
		$dateCreated = date("Y-m-d");
	} else if ($dateCreated == "0000-00-00" && $approved == "No") {
		$dateCreated = "0000-00-00";
	} else if ($dateCreated != "0000-00-00" && $approved == "No") {
		$dateCreated = "0000-00-00";
	} else {
	};
	if ($approved == "Yes") {
		$preExpirationDate = $dateCreated + "000$years-00-00";
		$expirationDate = $preExpirationDate . date("-m-d");
	} else { $expirationDate = "0000-00-00"; };
	mysql_query("UPDATE domains SET dateRequested = \"$dateRequested\", domain = \"$domain\", extension = \"$extension\", years = \"$years\", purchaseCode = \"$purchaseCode\", department = \"$department\", dateCreated = \"$dateCreated\", expirationDate = \"$expirationDate\", approved = \"$approved\", comments = \"$comments\", username = \"$username\" WHERE ID = \"$id\" ") or die(mysql_error());
	header("Location: requests.php");
} */







// Add images function

function addImages($fileName, $imageName, $confID) { 
	//$userMod = $_SESSION['user'];
	$query = mysqli_query($connection,"INSERT INTO images VALUES(null,\"$fileName\",\"$imageName\",\"$confID\")") or die(mysql_error());
	uploadImage();
	//header("Location: addImages.php");
}

function uploadImage() {	
	$target = "images/"; 
 	$target = $target . basename($_FILES['fileName']['name']) ; 	
 	$ok=1; 
 
// //This is our size condition 
// if ($uploaded_size > 9999999) 
// { 
// echo "Your file is too large.<br>"; 
// $ok=0; 
// } 
// 
// //This is our limit file type condition 
// if ($uploaded_type =="text/php") 
// { 
// echo "No PHP files<br>"; 
// $ok=0; 
// } 
 
 //Here we check that $ok was not set to 0 by an error 
 if ($ok==0) 
 { 
 echo "Sorry your file was not uploaded"; 
 } 
 
 //If everything is ok we try to upload it 
 else 
 { 
 if(move_uploaded_file($_FILES['fileName']['tmp_name'], $target)) 
 { 
 	copy("images/" . $_FILES['fileName']['name'], "images/" . $_FILES['fileName']['name']);
 	//echo "The file " .$target . " has been uploaded<br><br>"; 
 	header("Location: addImages.php");
 } 
 else 
 { 
 	//echo "Sorry, there was a problem uploading your file.<br><br>"; 
 	header("Location: addImages.php");
 } 
 } 

}

// Edit images function

/* function editImages($feedName, $imgName, $imgDesc, $pagePriority, $id) {	
	$id = (int) $id;
	$dateMod = date("Y-m-d");
	$timeMod = date("H:i:s"); 
	$userMod = $_SESSION['user'];
	
	$query_Images = "UPDATE images SET feedName = \"$feedName\" ";

	if ($imgName != null) {
		$query_Images = $query_Images . ", imgName = \"$imgName\" ";
	}

	$query_Images = $query_Images . ", imgDesc = \"$imgDesc\", pagePriority = \"$pagePriority\", dateMod = \"$dateMod\", timeMod = \"$timeMod\", userMod = \"$userMod\" WHERE ID = \"$id\" "; 

    mysql_query($query_Images) or die(mysql_error());
	uploadImage();
	header("Location: images.php?feedName=" . $_POST['feedName']);
} */


// Add rooms function

function addRooms($confID, $levelID, $roomid, $name, $scannerID, $x, $y, $width, $height, $SVG, $delete) {
	//$username = $_SESSION['user'];
	
	if($roomid != NULL)
	{
		if($delete == 'true')
		{
		   echo 'Room '.$roomid.' deleted.';
		   $query = mysqli_query($connection,"delete from rooms where ID = $roomid;") or die(mysql_error());
		}
		else
		{
		   echo 'Room '.$roomid.' updated.';
		$query = mysqli_query($connection,"update rooms set confID='$confID', iLevelid=$levelID, name='$name', iScannerID=$scannerID, x=$x, y=$y, width=$width, height=$height, tSVGNode='$SVG' where ID = $roomid;") or die(mysql_error());
		}
	}
	else
	{
		if($delete != 'true'){
        echo 'A new room inserted.';
        echo "INSERT INTO rooms (confID, iLevelid, name, iScannerID, x, y, width, height, tSVGNode) VALUES ($confID, $levelID, \"$name\", \"$scannerID\", \"$x\", \"$y\", \"$width\", \"$height\", '$SVG');";
	    $query = mysqli_query($connection,"INSERT INTO rooms (confID, iLevelid, name, iScannerID, x, y, width, height, tSVGNode) VALUES ($confID, $levelID, \"$name\", \"$scannerID\", \"$x\", \"$y\", \"$width\", \"$height\", '$SVG');") or die(mysql_error());}
	}
	
	
	//header("Location: requests.php");
}

function getRoomsByLevelID($floor_id)
{
	$roomarray = array();
	
	$query = mysqli_query($connection,'select * from rooms where iLevelid = '.$floor_id) or die(mysql_error());	
	
	while ($row = mysqli_fetch_object($query)) {
    array_push($roomarray, $row);
    }
	mysqli_free_result($query);
	return $roomarray;
}

function save_room_2_session($roomID, $sessionID)
{
	/*insert or update*/
	
	$query = mysqli_query($connection,'insert into Room_2_Sess (RoomID, SessionID) values ('.$roomID.', '.$sessionID.') on duplicate key update
  RoomID = '.$roomID.';');
}

function getSessionsByRoomIDs($RoomIDs)
{
	$SessionData = array();
	echo 'select RoomID, SessionID from  vw_session_room where RoomID in ('.$RoomIDs.');';
	$query = mysqli_query($connection,'select RoomID, SessionID from  vw_session_room where RoomID in ('.$RoomIDs.');') or die(mysql_error());
	while ($row = mysqli_fetch_object($query)) {
         array_push($SessionData, $row);
    }
	mysqli_free_result($query);
	return $SessionData;
}
?>
