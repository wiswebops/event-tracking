<?php



$connection = mysql_connect('54.227.215.252', 'b2b2bd32573705', '63a5494f');
mysql_select_db( 'heroku_f795c861b3c79e8',$connection);

$query = mysql_query( "SELECT ID, ImageName, fileName FROM images", $connection);
echo  mysql_num_rows($query); 
/*
 $url=parse_url(getenv("us-cdbr-iron-east-01.clear.net"));

 $server = $url["54.227.215.252"];
$username = $url["b2b2bd32573705"];
$password = $url["63a5494f"];
$db = substr($url["heroku_f795c861b3c79e8"],1);

    $connection=mysqli_connect('54.227.215.252', 'b2b2bd32573705', '63a5494f');


    mysqli_select_db($connection,'heroku_f795c861b3c79e8');
$query = mysqli_query($connection, "SELECT ID, ImageName, fileName FROM images");
echo  mysqli_num_rows($query);
*/
   
?>
