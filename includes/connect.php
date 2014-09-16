<?php
    $url=parse_url(getenv("us-cdbr-iron-east-01.clear.net"));

    $server = $url["54.227.215.252"];
    $username = $url["b2b2bd32573705"];
    $password = $url["63a5494f"];
    $db = substr($url["heroku_f795c861b3c79e8"],1);

    mysqli_connect($server, $username, $password);


    mysqli_select_db($db);

/*

define('DB_HOST','54.227.215.252');
define('DB_USER','b2b2bd32573705');
define('DB_PASS','63a5494f');
define('DB_NAME','wishelpd_maps');

$connection = mysql_connect(DB_HOST,DB_USER,DB_PASS) or die(mysql_error());
mysql_select_db(DB_NAME) or die(mysql_error());
*/

?>
