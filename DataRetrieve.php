<?php
include ('includes/connect.php');
$choice = $_POST['choice'];
$dataArray = array();
switch ($choice)
{
    case 1:
        $query = mysqli_query(Database::getConnection(),"SELECT ID, ImageName, fileName FROM images");
        while ($row = mysqli_fetch_object($query))
            $dataArray[$row->ID]=$row->ImageName;
    break;
    
    case 2:
    break;

}

echo json_encode($dataArray);
unset($dataArray);
return;
?>
