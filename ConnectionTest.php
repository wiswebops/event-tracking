<?php

echo 'hahaha';
define('DB_HOST','54.227.215.252');
define('DB_USER','b2b2bd32573705');
define('DB_PASS','63a5494f');
define('DB_NAME','heroku_f795c861b3c79e8');

$connection = mysql_connect(DB_HOST,DB_USER,DB_PASS) or die(mysql_error());
mysql_select_db(DB_NAME) or die(mysql_error());

$query = mysql_query("SELECT ID, ImageName, fileName FROM images",$connection );
echo  mysql_num_rows($query);
   
?>
