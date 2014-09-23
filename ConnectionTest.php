<?php
$connection=mysqli_connect('54.227.215.252', 'b2b2bd32573705', '63a5494f');
mysqli_select_db('heroku_f795c861b3c79e8');
$query = mysqli_query("SELECT ID, ImageName, fileName FROM images");
echo  mysqli_num_rows($query);

   
?>
