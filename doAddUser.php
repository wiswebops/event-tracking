<?php
include('includes/functions.php');

if(isset($_POST['submit'])) {
	addUser($_POST['vFirstName'], $_POST['vLastName'], $_POST['vEmail'],$_POST['vPassword']);
	header("Location: login.php");
}
?>
