<?php
include('includes/functions.php');
session_start();

if(isset($_POST['login'])) {
	if(isset($_POST['vEmail'])) {
		if(isset($_POST['vPassword'])) {
			$vEmail = $_POST['vEmail'];
			$query = mysqli_query(Database::getConnection(),"SELECT * FROM users WHERE vEmail = '$vEmail'") or die(mysqli_error());
			$user = mysqli_fetch_array($query);
			
			if(md5($_POST['vPassword']) == $user['vPassword']) {
				//echo "Login successful";
				$_SESSION['user'] = $user['vEmail'];
				header("Location: dashboard.php");
			} else {
				echo "Please check your password and email!";
				include('login.php');
			}
		} else {
			echo "Please check your password!";
			include('login.php');
		}
	} else {
		echo "Please check your email!";
		include('login.php');
	}
} else {
	echo "Please check that you filled out the login form!";
	include('login.php');
}
?>