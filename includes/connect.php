<?php
define('DB_HOST','54.227.215.252');
define('DB_USER','b2b2bd32573705');
define('DB_PASS','63a5494f');
define('DB_NAME','wishelpd_maps');

$connection = mysql_connect(DB_HOST,DB_USER,DB_PASS) or die(mysql_error());
mysql_select_db(DB_NAME) or die(mysql_error());


?>
