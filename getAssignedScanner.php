<?php

include('includes/functions.php');

$eventID = $_POST['eventID'];
$res_array = array();
$res = mysqli_query(Database::getConnection(), "SELECT iScannerID FROM rooms where confID = ".$eventID);
while($item = mysqli_fetch_object($res))
{
    array_push ($res_array, $item->iScannerID);
}
echo json_encode($res_array);
?>