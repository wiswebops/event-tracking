<?php

require 'includes/connect.php';

require 'WizardSteps.php';

require 'WizardClass.php';
error_reporting(0);
ob_start();
require 'SketchBook_Setup.php';

?>
<html>
<head>
<meta charset="utf-8">
<script>
  function preventBack(){window.history.forward();}
  setTimeout("preventBack()", 0);
  window.onunload=function(){null};
</script>
<script>
var cur_floor;
var cur_event;
    

    

    
function AjaxImageByID (imageID)
{
    
    $.fancybox({
		type : 'ajax',
		href : 'getImage.php',
		ajax : { type : 'POST', data: {FloorPlanID: imageID }}
	});   
}
   $("#btnUpload").live('click',function(){
    
       
    $.fancybox({
		type : 'iframe',
		href : 'addFloorplan.php',
      	fitToView	: false,
		width		: 400,
		height		: 335,
		autoSize	: false,
        afterClose  : function() {
            var setdata = getData(1);
            setdata.success(function (data) {
                $('select option').remove();
                for(var key in data)
                {
                    $('select').append('<option value="'+key+'">'+data[key]+'</option>');      
                }
            });
           
            return;
        }
	   });
   
        
});
$(function() {
    $( ".datetime" ).datepicker({ dateFormat: "DD, d MM, yy"});
    $( ".Expandable" ).after("<input type='button' class='AddMore' value='+'/>");
    $( ".Previewable" ).after("<input type='button' class='Preview' style=' vertical-align:top;background:url(images/preview.png) no-repeat;border:none;width:25px;height:25px'/>");
    $(".Remove").live('click', function(){
        
        $(this).parents('tr').remove();
       
    });
    
 
    
    $(".Preview").live('click', function(){
    
        AjaxImageByID($(this).siblings('select').val());
       
       
    });
     
    $(".AddMore").live('click', function(){
        $(this).parents('table tbody tr:first').has('select :last').after($(this).parents('tr:first').clone());
        $(this).after("<input type='button' class='Remove' value='X'>").remove();
    });
    
    
     
});
    $('button[value="Review"]').live('click',function(e){
       
        var ParentForm = $(this).parents('form');
        Room_2_Level_Save(cur_event,cur_floor,function(){ParentForm.submit();});
 
    });
    
 

</script>

<script>
  $(function() {
  
  $( ".SessionRemove" ).live('click',function(){
									
									var returningBlock = $(this).parent();
									returningBlock.draggable({helper: 'clone'});
									$(this).remove();
                                    Nodes_2_Sessions[currentNode.attr('id')].splice(returningBlock, 1);
									$(returningBlock).addClass('returnedblock').appendTo($('#catalog'));
									if ($('#cart').find('li').length == 0)
									{
										 $('#cart ul').append('<li class="placeholder">Add your sessions here</li>');
									}
									
  });	
	
    $( "#catalog li" ).draggable({
       helper: 'clone'
    });
      
    $( "#cart ul" ).droppable({
      activeClass: "ui-state-default",
      hoverClass: "ui-state-hover",
      accept: ":not(.dropped)",
      drop: function( event, ui ) {
      $( this ).find( ".placeholder" ).remove();
		ui.draggable.appendTo( this );
		ui.draggable.append('<img src="images/drag_delete.png" class="SessionRemove" style="margin-left:5px"/>');
		Nodes_2_Sessions[currentNode.attr('id')].push( ui.draggable);
		ui.draggable.draggable("destroy");
		ui.helper.remove();
      }
	  
    });
	
		
  });
  </script>

  
</head>

<body>

<div id='popup' class='tip-panel' style="width:270px;height:auto;border:#428bca solid 1px;-webkit-border-radius: 3px;-moz-border-radius: 3px;border-radius: 3px;position:absolute;display:none;background-color:white;">
<div id='close' style="width:260px;height:20px;text-align:right;cursor:pointer;" onClick="$(this).parent().hide();">X</div>
    <div id='databoxSketch'>
		<table>
        <tr>
        <td>
        <input name='roomname' type="text" maxlength="20" style="width:120px"  placeholder="Room Name" >
        </td>
        </tr>
        <tr>
        <td>
        <select name='scannerid'>
        <option>Select Scanner</option>
        <?php
                	echo '<script>
		var scannerList = [];';
		$x = mysqli_query(Database::getConnection(),"SELECT vScannerName, iScannerID FROM Scanners ORDER BY iScannerID ASC");
		while ($row = mysqli_fetch_object($x))
		{
			echo '
			scannerList['.$row->iScannerID.']=\''.$row->vScannerName.'\';
			
			';
		}
			echo '</script>';

                $queryx = mysqli_query(Database::getConnection(),"SELECT vScannerName, iScannerID FROM Scanners ORDER BY iScannerID ASC");
                
                while ($row = mysqli_fetch_object($queryx))
                {
                  echo '<option value="'.$row->iScannerID.'">'.$row->vScannerName.'</option>';
                }
                
        ?>
        </select></td></tr></table></div> <button id="popupconfirm" style="float:right;">Confirm</button></div>   
   
    

<form method="POST">
<table id="formBody">
<tr id="title">
<td></td>
</tr>
<tr> 
<td id="Wizard" >
</td>
<td><div id='popupSession' class='tip-panel' style="width:350px;height:600px;border:#428bca solid 1px;-webkit-border-radius: 3px;-moz-border-radius: 3px;border-radius: 3px;position:relative;display:none;background-color:white;">
<div id='databoxAddSession' style="width:100%;" >
    <h3>Room Info</h3>
    <div id='RoomInfo' style='width:auto;height:10%;border: 1px solid;'>
        <div style="height:50%;"><lable>Room Name: </lable><span id="Panel_roomName"></span></div>
        <div style="height:50%;"><lable>Assigned Scanner: </lable><span id="Panel_scanner"></span></div>
    </div>
    <h3 class="ui-widget-header" >Assigned Sessions</h3>
    <div id='cart' style='width:auto;height:30%;border: 1px solid;overflow-y:scroll;'>
		<div class="ui-widget-content">
			<ul>
				<li class="placeholder">Add your sessions here</li>
			</ul>
		</div>
    </div>
    <h3>Unassigned Sessions</h3>
    <div id="catalog" style="width:auto;overflow-y:scroll;height:35%;border: 1px solid;">
        <ul>   
        </ul>
    </div>
    <div id="actionBar" style="width:auto;height:5%;border: 1px solid;margin-top:3%;">
    <input type="button" id="import" value="Import"/>
    <input type="button" id="clear"value="Clear"/>
    <input type="button" id="save"value="Save"/>
    <input type="button" id="reload" value="Reload"/>
    </div>
</div>
</div></td>
</tr>
    
    
    </table> 
<div id="WizardNav">
<button name="next">Next</button>
</div>
</form>
    
<?php

//for testing

//-------------- initiate wizard object ---------------------
$testobj = new Wizard($steps_edit_floors, isset($_POST['next'])?$_POST['next']:null, 'completed.html');
//-------------- initiate result array ---------------------

//var_dump($_POST);

$result = array();
$floorID=null;
$eventID=null;
$MapName='New Map';
if(isset($_GET['floorID']))
{
    $floorID = $_GET['floorID'];
}
else
{
    if(isset($_POST['floorID']))
    $floorID = $_POST['floorID'];
}
if(isset($_GET['eventID']))
{
    $eventID = $_GET['eventID'];
}
else
{
    if(isset($_POST['ConferenceID']))
        $eventID = $_POST['ConferenceID'];
    
}
if(isset($_GET['MapName']))
{
    $MapName = $_GET['MapName'];
}
else
{
    if(isset($_POST['MapName']))
        $MapName = $_POST['MapName'];
    
}




$EventID = $_POST['ConferenceID'];
$FloorPlanID = $_POST['Floorplans'];
/*if($floorID==null)
    $floorID = 11;

if($EventID==null)
    $EventID = 48;
*/
if(isset($_POST['process']))
{
    $callback=preg_replace('/\s+/', "",$_POST['process']);
    $result=call_user_func($callback, array($floorID,$EventID,$FloorPlanID));
    if($result == -1)
    {
        
        echo "<script> parent.location.assign('Error.php?error_code=2'); </script>";
    
    }    
    else{
        
        if ($floorID == null && $result != null)
        $floorID = $result;
    }
}


if($floorID != null)
$FloorInfo = mysqli_fetch_object(mysqli_query(Database::getConnection(), 'select a.*, b.fileName from floorlevel a inner join images b on a.iMapID = b.ID where a.ID ='.$floorID));

//var_dump($FloorInfo);

echo '<script>';
if($FloorInfo!=null)
{
    
    $testobj->setIdentifier($FloorInfo->iEventID);
    echo '$(document).ready(function(){
            cur_floor = '.$FloorInfo->ID.';
            cur_event = '.$FloorInfo->iEventID.';
            $("#title").find("h1").append(" - '.$MapName.'");
            $("[name=Floorplans]").val("'.$FloorInfo->iMapID.'");
            $("form").append(\'<input type="hidden" name="floorID" value="'.$FloorInfo->ID.'">\');
            $("form").append(\'<input type="hidden" name="ConferenceID" value="'.$FloorInfo->iEventID.'">\');
            $("form").append(\'<input type="hidden" name="MapName" value="'.$MapName.'">\');
            $(function() {$(".hasSVG").css("background-image","url(\''.$FloorInfo->fileName.'\')");});
            if ( $( "#svgsketch" ).length )
            {
                Load_Structure(cur_event,cur_floor,SurfaceClick,null,sketchpad ); 
                  
            }
            if ( $( "#svgView" ).length )
            {
                
                var promise = Load_Structure(cur_event,cur_floor,viewPadClick,null,viewPad);
                promise.success(function(){
                Sessions_Load(cur_event,cur_floor);
                
                });
                $(\'button[name=next]\').live(\'click\',function(e){
                    var ParentForm = $(this).parents(\'form\');
                    Sessions_Save(cur_event,cur_floor,function(){ParentForm.submit();});
                });
            
            }
       
          });';
    
    
    
}
else
{
      echo '$("form").append(\'<input type="hidden" name="ConferenceID" value="'.$eventID.'">\');';
    
}

//$queryd = mysqli_query(Database::getConnection(),"SELECT ID, concat(SUBSTRING(vSessionName, 1, 25),'...') as SessionNameShort, vSessionName as SessionNameFull, vSpeaker, dSessionBegin, iEventGroupID FROM Sessions where iEventGroupID = ".$testobj->getIdentifier()." limit 10;");
        
  $queryd = mysqli_query(Database::getConnection(),"SELECT a.ID, concat(SUBSTRING(vSessionName, 1, 25),'...') as SessionNameShort, vSessionName as SessionNameFull, vSpeaker, dSessionBegin, iEventGroupID FROM (((select * from sessions where iEventGroupID = ".$testobj->getIdentifier()." limit 10) a left join room_2_sess b on (a.ID = b.SessionID)) left join rooms c on c.id = b.RoomID) left join floorlevel d on d.ID = c.iLevelid where b.RoomID is null or c.iLevelid = ".$floorID.";");
      
    
        while ($row = mysqli_fetch_object($queryd))
		{
			$fullInfo = $row->SessionNameFull." | ".$row->vSpeaker." | ".$row->dSessionBegin;
                echo '$("#catalog ul").append("<li value=\"'.$row->ID.'\" title=\"'.$fullInfo.'\" >'.$row->SessionNameShort.'</li>");';
        } 
        
echo '</script>';





if(!$testobj->checkCompleted(true))
{
    ob_end_flush();
    
    $testobj->Render('Wizard', null);
    
}
else
{
    echo '<script>parent.jQuery.fancybox.close();</script>'; 
}
?>    


</body>
</html>
     