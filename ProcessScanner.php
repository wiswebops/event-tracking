<?php
include 'includes/connect.php';
    
$ConfID=$_POST['ConfID'];
$ScannerName=$_POST['ScannerName'];
$ScannerSerial=$_POST['SeriNum'];
$ScannerModel=$_POST['ModelNum'];

$query = mysqli_query(Database::getConnection(),"INSERT IGNORE INTO Scanners(vScannerName, vScannerSerialNum, vModelNumber, dInService, bDeleted) VALUES ('$ScannerName','$ScannerSerial','$ScannerModel',CURDATE(),0);");

$getScanner= mysqli_query(Database::getConnection(),"Select iScannerID from Scanners where vScannerSerialNum='$ScannerSerial';");
$CurScannerID = mysqli_fetch_object($getScanner);

$InsertNewAsso = mysqli_query(Database::getConnection(),"
INSERT INTO Scanner_2_conf (scanner_id, conf_id) SELECT * FROM  (SELECT ".$CurScannerID->iScannerID.",$ConfID) AS TMP WHERE NOT EXISTS (SELECT * FROM Scanner_2_conf  WHERE scanner_id= ".$CurScannerID->iScannerID." and conf_id = $ConfID) LIMIT 1;");

header('location: dashboard.php');


?>