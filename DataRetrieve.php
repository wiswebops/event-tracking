<?php
include ('includes/connect.php');
$choice = $_POST['choice'];
$dataArray = array();
switch ($choice)
{
    case 1:
        $query = mysql_query("SELECT ID, ImageName, fileName FROM images");
        while ($row = mysql_fetch_object($query))
            $dataArray[$row->ID]=$row->ImageName;
    break;
    
    case 2:
    break;

}

echo json_encode($dataArray);
unset($dataArray);
return;
?>