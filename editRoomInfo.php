<?php 
include('head.php');

include 'includes/functions.php';


?> 

<link rel="stylesheet" href="//code.jquery.com/ui/1.11.1/themes/smoothness/jquery-ui.css">
<style>
.ui-datepicker {
	margin-left: 238px;
	margin-top: -34px;
}

.img_preview {
	width: 215px;
	height: 134px;
	border: 1px solid black;
	margin: 20px auto;
	-webkit-border-radius: 5px;
	-moz-border-radius: 5px;
	border-radius: 5px;
}

.float-right {
	float:right;
}

.close_btn {
	float: right;
	width: 30px;
	height: 30px;
}

.close_btn_image {
	width: 30px;
}

.panel-primary {
	float: left;
	width: 100%;
}
</style>

<?php

if(isset($_POST['EventID']))
$EventID = $_POST['EventID'];
$EventID =1;

var_dump($_POST);
if(isset($_POST['submit']))
{
    $eventData=$_POST; 
    
    $check_exist = mysqli_query(Database::getConnection(),"SELECT * FROM confs WHERE ID = ".$EventID);
    if(mysqli_num_rows($check_exist) == 0)
    {
        
        header('location: Error.php?error_code=0');

    }
    else
    { 
        
        if(mysqli_query(Database::getConnection(),"update confs set confID = '".$eventData["ConfID"]."', name = '".$eventData["EventName"]."', location='".$eventData["EventLocation"]."', date='".$eventData["EventDate"]."', dLastUpdate = NOW() where ID = ".$EventID))
        header('location: dashboard.php');
        else
        header('location: Error.php?error_code=1');    
    }
}

$EventDetail = getRoomDetail($EventID);
//var_dump($EventDetail);
 

?>


<div class="row">
	<div class="col-lg-6">
		<div class="panel panel-primary">
			<div class="panel-heading">
				<h3 class="panel-title"><i class="fa fa-barcode"></i> Edit Room Info</h3>
			</div>
			<div class="panel-body" style="width: 100%;float: left;">  
				<form class="form-newscanner" role="form" method="post" action='editRoomInfo.php'>
					<div style="width: 50%;float: left;">
                    <label>Event Group:  </label><span> <?php echo $EventDetail[0]->vGroupName;?></span><input type="hidden" name="EventGroupID" value="<?php echo $EventDetail[0]->iEventGroupID; ?>"/>
                    <p style="color: #999; font-size: 11px;"> </p>
                    <label>Conference Code: </label>
					<input name="ConfID" type="text" class="form-control" value="<?php echo $EventDetail[0]->confID;  ?>" required> 
					<label>Conference Name: </label>
					<p style="color: #999; font-size: 11px;"> </p>
					<input name="EventName" type="text" class="form-control" value="<?php echo $EventDetail[0]->name;  ?>" required> 
					<label>Conference Location: </label>
					<p style="color: #999; font-size: 11px;"></p>
					<input name="EventLocation" type="text" class="form-control" value="<?php echo $EventDetail[0]->location;  ?>" required> 
					<label>Conference Date: </label>
					<p style="color: #999; font-size: 11px;"></p>
					<input name="EventDate" type="datetime" class="datetime form-control" value="<?php echo $EventDetail[0]->date;  ?>" required> 
                    </div>
                    <div class="panel-body" style="width: 50%;float: left;">  
					
					<p style="color: #999; font-size: 11px;"> </p>
					<button class="btn btn-primary float-left" id="addNew">Add New Floor</button>
					<div class="img_preview_div">
					   <?php 
                           $resultset = mysqli_query(Database::getConnection(),"select b.vLevelName, b.ID, c.fileName from (confs a inner join floorlevel b on a.iEventGroupID = b.iEventID) inner join images c on b.iMapID = c.ID where a.ID = ".$EventID);
                           while($data = mysqli_fetch_object($resultset))
                           {
                               echo '<a class="img_preview_anchor"  href="#" title="'.$data->vLevelName.'"><div class="img_preview"  value="'.$data->ID.'" style="background: url(\''.$data->fileName.'\') no-repeat center;background-size: 100%;">
                                <div class="close_btn">
                                <img class="close_btn_image" src="images/delete.png" style="z-index:10;position:absolute;"/>
                                </div>
                                </div></a>';
                               
                           }
                       ?>
					</div>
					<p style="color: #999; font-size: 11px;"></p>
					<button class="btn btn-primary float-right" id="Exit">Exit</button>
					<a href="#" class="openform"><button class="btn btn-primary float-right" type="submit" name="submit" style="margin-right:10px;" >Save &amp; Exit</button></a>
					
		
					
				</form>
			</div>

		</div>
	</div>

</div>
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.1/themes/smoothness/jquery-ui.css">
<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="//code.jquery.com/ui/1.11.1/jquery-ui.js"></script>
<script>
$(".datetime").datepicker({ dateFormat: "DD, d MM, yy"});
$(".close_btn_image").on('click', function(){ $(this).parents('.img_preview_anchor').remove();});
$("#addNew").on('click',function(){alert('open up wizard');});
$("#Exit").on('click',function(e){ e.preventDefault(); window.location.assign('dashboard.php');});
$(".img_preview").on('click',function(){ alert('EDIT FLOOR ID:'+$(this).attr('value'));});
$(function() {
    $( document ).tooltip({
      position: {
        my: "left+25 top+155 "}});
});
</script>

