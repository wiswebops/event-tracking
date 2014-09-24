
<?php
include('includes/connect.php');


$Image = mysqli_query(Database::getConnection(),"SELECT ID, fileName, imageName FROM images WHERE ID = ".$_POST['FloorPlanID']);
while ($row = mysqli_fetch_object($Image))
{
   $img = getimagesize($row->fileName);
    
   echo '<div style="width:'.$img[0].'px;height:'.$img[1].'px;"><img src="'.$row->fileName.'?token='.time().'" style="display:block;position:absolute;margin:auto;top: 0; bottom: 0; left: 0; right: 0;" /></div>';
}

?>
