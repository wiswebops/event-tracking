<?php
define('DB_HOST','69.89.31.126');
define('DB_USER','wishelpd_aciampi');
define('DB_PASS','abc12345');
define('DB_NAME','wishelpd_maps');

$connection = mysql_connect(DB_HOST,DB_USER,DB_PASS) or die(mysql_error());
mysql_select_db(DB_NAME) or die(mysql_error());

?>