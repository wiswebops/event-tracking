<?php 
include('head.php');
error_reporting(0);
require 'includes/functions.php';
require_once 'SketchBook_Setup.php';
?> 




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
    z-index:20;
}

.close_btn_image {
	width: 30px;
}

.panel-primary {
	float: left;
	width: 100%;
}
</style>

<script>
<?php 
if(isset($_POST['event_uid']))
{
    $EventID = $_POST['event_uid'];
     
    $record =mysqli_fetch_object(mysqli_query(Database::getConnection(),"SELECT iEventGroupID FROM confs WHERE ID = ".$EventID));
    echo 'var cur_event = '.$record->iEventGroupID.';
          var cur_ueventid = '.$EventID.';';
}
else
{
    echo 'var cur_event = null;';
    echo 'var cur_ueventid = null;';
}
    


if(isset($_POST['submit']))
{
    $eventData=$_POST; 
    $check_exist = mysqli_query(Database::getConnection(),"SELECT * FROM confs WHERE ID = ".$EventID);
    if(mysqli_num_rows($check_exist) == 0)
    {
        echo "window.location.assign('Error.php?error_code=0');";

    }
    else
    { 
        
        if(mysqli_query(Database::getConnection(),"update confs set confID = '".$eventData["ConfID"]."', name = '".$eventData["EventName"]."', location='".$eventData["EventLocation"]."', date='".$eventData["EventDate"]."', dLastUpdate = NOW() where ID = ".$EventID))
        {
            
            foreach($eventData['deletedMap'] as $key => $value)
            {
                
                mysqli_query(Database::getConnection(),"update room_2_sess set RoomID = null where RoomID in (select ID from rooms where iLevelid = ".$value.");");
                mysqli_query(Database::getConnection(),"delete from rooms where  iLevelid = ".$value);
                mysqli_query(Database::getConnection(),"delete from floorlevel where ID  = ".$value);
                   
            }
            echo "window.location.assign('dashboard.php');";
        }
        else
        {
             echo "window.location.assign('Error.php?error_code=1');";
       
        }
    }
}

$EventDetail = getRoomDetail($EventID);
//var_dump($EventDetail);

?>
    
  </script>
<?php
//var_dump($_POST);
?>
<div class="row">
	<div class="col-lg-6" style = 'width:650px;'>
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
					  
					  
					</div>
					<p style="color: #999; font-size: 11px;"></p>
					<button class="btn btn-primary float-right" id="Exit">Exit</button>
					<button class="btn btn-primary float-right" type="submit" name="submit" style="margin-right:10px;" >Save &amp; Exit</button>
					
		
					
				</form>
			</div>

		</div>
	</div>

</div>
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.1/themes/smoothness/jquery-ui.css">
<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="//code.jquery.com/ui/1.11.1/jquery-ui.js"></script>
    
<script type="text/javascript" src="js/fancyBox/source/jquery.fancybox.pack.js"></script>
<link rel="stylesheet" href="css/jquery.fancybox.css" type="text/css" media="screen" />    
    
<script>
$(".datetime").datepicker({ dateFormat: "DD, d MM, yy"});
$(document).on('click', '.close_btn',function(event){
    event.stopPropagation();
    $('form').append('<input type="hidden" name="deletedMap[]" value="'+$(this).parent().before().attr('value')+'">'); 
    
    $(this).parents('.img_preview_anchor').remove();
    
                                                     
});
$("#addNew").on('click',function(e){
    
     e.preventDefault();
     var link = 'EditPage.php?eventID='+cur_event;
     $.fancybox({
		type : 'iframe',
		href : link,
      	fitToView	: true,
		width		: 1200,
		height		: 800,
		autoSize	: true,
        afterClose    : function(){ refreshMapList(cur_ueventid); return;}
	   });

});
$("#Exit").on('click',function(e){ e.preventDefault(); window.location.assign('dashboard.php');});

$(document).on('click','.img_preview',function(){ 
 
    var link = 'EditPage.php?floorID='+$(this).attr('value')+'&MapName='+$(this).parent().attr('mapName');
    
     $.fancybox({
		type : 'iframe',
		href : link,
      	fitToView	: true,
		width		: 1200,
		height		: 800,
		autoSize	: true,
        afterClose    : function(){ refreshMapList(cur_ueventid); return;}
	   });
});

$(function() {
    $( document ).tooltip({
      position: {
        my: "left+25 top+155 "}});
    
});

function refreshMapList (ueventid)
{
    var resultsz;
    resultsz = getData(2,{eventID:ueventid});
    resultsz.success(function(data){
    $('.img_preview_div').empty();
    for(i=0;i<data.length;i++)
    {
     // console.log('<a class="img_preview_anchor"  href="#" mapName="'+data[i]['name']+' '+'Map '+(i+1)+'" title="'+data[i]['name']+' '+'Map '+(i+1)+'"><div class="img_preview"  value="'+data[i]['ID']+'" style="background: url(\''+data[i]['fileName']+'\') no-repeat center;background-size: 100%;"> <div class="close_btn"><img class="close_btn_image" src="images/delete.png" style="z-index:10;position:absolute;"/></div></div></a>');
      $('.img_preview_div').append('<a class="img_preview_anchor"  href="#" mapName="'+data[i]['name']+' '+'Map '+(i+1)+'" title="'+data[i]['name']+' '+'Map '+(i+1)+'"><div  class="img_preview"  value="'+data[i]['ID']+'" style="background: url(\''+data[i]['fileName']+'\') no-repeat center;background-size: 100%;"> <div class="close_btn"><img class="close_btn_image" src="images/delete.png" style="z-index:10;position:absolute;"/></div></div></a>');
      
    }
    
    
    });
}
    
$(document).ready(function(){

 if(cur_ueventid != null)
 $("form").append('<input type="hidden" name="event_uid" value="'+cur_ueventid+'">');
 refreshMapList(cur_ueventid);

});
//$('.img_preview_div')



</script>

