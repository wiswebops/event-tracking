<?php
include 'includes/connect.php';
    
$ConfID=$_POST['ConfID'];
$ImageName=$_POST['floorplanName'];
$ImageFilePath=$_FILES['ImagePath']['name'];
$ImageFile=$_FILES['ImagePath']['tmp_name'];
$imageOverride=$_POST['overrride'];
$fileInfo = pathinfo($ImageFilePath, PATHINFO_EXTENSION);
$targetPath = "FloorPlanImages/".$ImageName.'.'.$fileInfo;

if($imageOverride=='on')
{
    $query = mysqli_query(Database::getConnection(), "INSERT INTO images(fileName, imageName) VALUES ('$targetPath','$ImageName') on Duplicate Key update fileName='$targetPath'");
    
    //overwrite file
    if(move_uploaded_file($ImageFile, $targetPath))
    echo "file uploaded successfully!";
    else echo "Failed to upload file!";   
    //update new file path if exist
}
else
{
    //ignore if exists
    $query = mysqli_query(Database::getConnection(),"INSERT IGNORE INTO images(fileName, imageName) VALUES ('$targetPath','$ImageName');");
    //upload if not exists
    if(mysqli_affected_rows()>0 )
    {
        if(move_uploaded_file($_FILES['ImagePath']['tmp_name'], $targetPath))
        echo "file uploaded successfully!";
        else echo "Failed to upload file!";
    }
    else
        echo "A file under this image name already exists! Please select check overwrite to overwrite the image.";
}

return ;




?>
