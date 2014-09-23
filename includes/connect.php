<?php
define('DB_HOST','localhost');
define('DB_USER','b2b2bd32573705');
define('DB_PASS','63a5494f');
define('DB_NAME','heroku_f795c861b3c79e8');
$connection = mysqli_connect(DB_HOST,DB_USER,DB_PASS) or die(mysql_error());
mysqli_select_db($connection, DB_NAME) or die(mysql_error());
?>
