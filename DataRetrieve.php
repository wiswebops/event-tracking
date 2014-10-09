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
       $EventID = $_POST['eventID'];
       $query = mysqli_query(Database::getConnection(),"select a.name, b.vLevelName, b.ID, c.fileName from (confs a inner join floorlevel b on a.iEventGroupID = b.iEventID) left join images c on b.iMapID = c.ID where a.ID = ".$EventID." order by ID asc");
        while ($row = mysqli_fetch_object($query))
        {
            
            array_push($dataArray,$row);
        }
    break;

}

echo json_encode($dataArray);
unset($dataArray);
return;
?>
