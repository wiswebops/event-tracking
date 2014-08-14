
<!-- Progress Bar -->

<div class="progress">

</div>

<!-- End of Progress Bar -->

<?php
include('includes/functions.php');







$FormData =json_decode(stripslashes ($_POST["Conf"]));


$check_exist = mysql_query("SELECT * FROM FloorLevel WHERE iEventID = ".$FormData->EventGroup);

if(mysql_num_rows($check_exist) == 0)
{
	mysql_query("Insert into confs (confID, name, location, date, dCreated, dLastUpdate, ieventGroupID) values ('".$FormData->{'Conference ID'}."','".$FormData->{'Event Name'}."','".$FormData->{'Location'}."','".$FormData->{'Date'}."', NOW(), NOW(),".$FormData->{'EventGroup'}.");");
	
	$mapQuery = "Insert into FloorLevel (iEventID, iMapID, vLevelName, dLastUpdated) VALUES ";
	$index = 1;
	if (is_array($FormData->FloorPlan))
	{
		foreach ($FormData->FloorPlan as $map_id)
		{
			  if ($index > 1)
			   $mapQuery.=",";
			 $mapQuery.="(".$FormData->{'EventGroup'}.",".$map_id.",'".$FormData->{'Event Name'}." Map ".$index."', NOW())";
			 $index++;
		}
	}
	else 
	{
		
		$mapQuery.="(".$FormData->{'EventGroup'}.",".$FormData->FloorPlan.",'".$FormData->{'Event Name'}." Map ".$index."', NOW())";
	}
	echo $mapQuery;
	mysql_query($mapQuery);
}



?>
<script>

function Progress_makeCircle (divClass, EventID, MapID, LevelName)
{
	var Step1 = $('<a>',{href: "#", onclick : "addRoom("+EventID+","+MapID+",this)"});
	var Step2 = $('<a>',{href: "#", onclick : "addSession("+EventID+","+MapID+",this)"});
	var circleDiv1 = $('<div>',{class: "circle done"});
	var circleDiv2 = $('<div>',{class: "circle done"});
	var spanLabel1 = $('<span>',{text: "1", class: "label"});
	var spanLabel2 = $('<span>',{text: "2", class: "label"});
	var spanp1 = $('<p>',{text:  "Rooms", class: "title spacer"});
	var spanp2 = $('<p>',{text: "Sessions", class: "title"});
	var bar = $('<span>',{class: "bar"});
    Step1.append(circleDiv1.append(spanLabel1).append(spanp1));
	Step2.append(circleDiv2.append(spanLabel2).append(spanp2));
	$("."+divClass).append(Step1).append(bar).append(Step2);
	
}




<?php

echo 'var currentGroupID = '.$FormData->EventGroup.';';


$query = mysql_query("SELECT a.*, b.fileName FROM FloorLevel a inner join images b on a.iMapID = b.ID WHERE iEventID = ".$FormData->EventGroup);
echo '
var FloorPlan1 = {};';
while ($row = mysql_fetch_object($query))
{
		echo 'FloorPlan1["'.$row->iMapID.'"]="'.$row->fileName.'";
		Progress_makeCircle("progress",'.$row->iEventID.','.$row->iMapID.',"'.$row->vLevelName.'");
		
		';
		
}

?> 

</script>

<?php

include('head2.php');
?>
<style>


/* Form Progress */
.progress {
  width: 800px;
  height:75px;
  text-align: center;
  margin-bottom:10px;
}
.progress .circle,
.progress .bar {
  display: inline-block;
  background: #fff;
  width: 40px; height: 40px;
  border-radius: 40px;
  border: 1px solid #d5d5da;
}
.progress  .bar {
  position: relative;
  width: 50px;
  height: 6px;
  margin-bottom: 17px;
  border-left: none;
  border-right: none;
  border-radius: 0;
}
.progress .circle .label {
  display: inline-block;
  width: 32px;
  height: 32px;
  line-height: 32px;
  border-radius: 32px;
  margin-top: 3px;
  color: #b5b5ba;
  font-size: 17px;
}
.progress .circle .title {
  color: #b5b5ba;
  font-size: 11px;
}
.progress a{
  
  text-decoration: none;
  line-height: 10px;
}
.progress p {

margin-top:10px;

}

/* Done / Active */
.progress .bar.done,
.progress .circle.done {
  background: #eee;
}
.progress .bar.active {
  background: linear-gradient(to right, #EEE 40%, #FFF 60%);
}
.progress .circle.done .label {
  color: #FFF;
  background: #3a89c9;
  box-shadow: inset 0 0 2px rgba(0,0,0,.2);
}
.progress .circle.done .title {
  color: #444;
}
.progress .circle.active .label {
  color: #FFF;
  background: #f26c4f;
  box-shadow: inset 0 0 2px rgba(0,0,0,.2);
}
.progress .circle.active .title {
  color: #f26c4f;
}


li {list-style-type: none;}
ul{padding:0;}
#cart {padding:0 5px;background-color:#9cc4e4;color:#1b325f;}
#catalog {padding:0 5px;background-color:#9cc4e4;color: #1b325f;overflow-y:scroll;height:200px;}
#catalog li, #cart li {border-top:1px solid white;}





</style>


<script>

var currentCircle = null;
$(function() {
  
  $( ".SessionRemove" ).live('click',function(){
									
									var returningBlock = $(this).parent();
									returningBlock.draggable({helper: 'clone'});
									$(this).remove();
									Nodes_2_Sessions[currentNode.attr('id')].splice(returningBlock, 1);
									
									if (Nodes_2_Sessions[currentNode.attr('id')].length == 0)
									{
										 $(returningBlock).parent().append('<li class="placeholder">Add your sessions here</li>');
									}
									$(returningBlock).addClass('returnedblock').appendTo($('#catalog'));
									
												});	
	//$( ".drop" ).accordion();
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
  
  function clone(obj) {
    if (null == obj || "object" != typeof obj) return obj;
    var copy = obj.constructor();
    for (var attr in obj) {
        if (obj.hasOwnProperty(attr)) copy[attr] = obj[attr];
    }
    return copy;
}

  function Prepare_Session_Data()
  {
	  var dupe = jQuery.extend(true, {}, Nodes_2_Sessions);
	 
	  $.each(dupe,function(){
					this.forEach(function(session, index, arrayz){
							arrayz[index] = session.val();
					 });
										
	  });
	  
	  return JSON.stringify(dupe); 
  }
  function Sessions_Save(event_id, floor_id, oncomplete)
	{
		
		$.ajax({
           			type: "POST",
          			url: "SessionDoAdd.php",
           			data: {Nodes: Prepare_Session_Data(), catalogData : $('#catalog .returnedblock').map(function(){return $(this).val();}).get(), confID: event_id, level_id: floor_id},
		   			cache: false,
					//dataType: "json",
		   			success: function(data){ 
					       console.log(data);
					}
	}).done(function(){oncomplete();});
		
	}
	
	function Sessions_Load(event_id, floor_id)
	{
		
		$.ajax({
           			type: "POST",
          			url: "SessionDoLoad.php",
           			data: {confID: event_id, level_id: floor_id , room_ids: Object.keys(Nodes_2_Sessions)},
		   			cache: false,
					dataType: "json",
		   			success: function(data){
						   //reset data
						   	for (var member in Nodes_2_Sessions) 
						   	{
									  Nodes_2_Sessions[member].forEach(function(entry){
									  $(entry).draggable({helper: 'clone'}).appendTo($('#catalog'));
															  });
									   Nodes_2_Sessions[member]=[];
							  
						   }
						   $('#catalog .SessionRemove').remove();
						   $.each(data, function(index, value) {
								    console.log(value.SessionID, value.RoomID);	 
									var temp_session = $('#catalog li[value="'+value.SessionID+'"]').remove();
									Nodes_2_Sessions[value.RoomID].push( temp_session.append('<img src="images/drag_delete.png" class="SessionRemove" style="margin-left:5px"/>') );
   
                            }); 
								
							
					       
					}
	}).done(function(){});
		
	}


$(document).ready(function() {
		$('#svgsketch').focus();
		$('.progress a').first().click();
		
		   });

function addSession(confid, mapid, itemz)
{
	$(currentCircle).find('.circle').removeClass('active').addClass('done').find('.label').html('&#10003;');
    
	$(itemz).find('.circle').removeClass('done').addClass('active');
	$('#popup').hide();
	//save current state
	//clear all global variables
	//hide sketchpad
	
	//load rooms and session then open sketchpad
	
	var funcString = $(currentCircle).attr('onMove');
	$.when( Room_2_Level_Save(confid,mapid,function(){Load_Structure(confid,mapid,viewPadClick);}) ).done(function() {
     //Load_Structure(confid,mapid,viewPadClick);
	Sessions_Load(confid, mapid);
	currentCircle = itemz;
  });
	//Room_2_Level_Save(7,11);


	
	$('#svgsketch').hide();
	$('#svgView').css("background-image","url('images/"+FloorPlan1[mapid]+"')").show().focus();
}


function addRoom(confid, mapid, itemz)
{
	$(currentCircle).find('.circle').removeClass('active').addClass('done').find('.label').html('&#10003;');
	$(itemz).find('.circle').removeClass('done').addClass('active');
	$('#popup').hide();
	//save current state
	
	//clear all global variables
	
	//hide sketchpad
	$('#svgView').hide();
	
	//load rooms and session then open sketchpad
	$('#svgsketch').css("background-image","url('images/"+FloorPlan1[mapid]+"')").show().focus();
	$.when( Sessions_Save(confid,mapid,function(){Load_Structure(confid,mapid,SurfaceClick,endDrag);}) ).done(function(abc) {
     //Load_Structure(confid,mapid,viewPadClick);
	
	currentCircle = itemz;
  });
}

var i = 1;
$('.progress .circle').removeClass().addClass('circle');
$('.progress .bar').removeClass().addClass('bar');
//$('.progress .circle:nth-of-type(' + i + ')').addClass('active');

</script>

<?php
		$query = mysql_query("SELECT * FROM images WHERE confID = '" . $_GET['confID'] . "' ORDER BY confID ASC");
		$images = mysql_fetch_assoc($query);
		
		$x = mysql_query("SELECT vScannerName, iScannerID FROM Scanners ORDER BY iScannerID ASC");
		echo '<script>
		var scannerList = [];';
		
		while ($row = mysql_fetch_object($x))
		{
			echo '
			scannerList['.$row->iScannerID.']=\''.$row->vScannerName.'\';
			
			';
		}
			echo '</script>';
         
		
		?>


<!-- Main area where pads are contained -->
<section class="main">
    <article style="float:left;margin-right: 20px;">

        <!-- pop up for session pad -->
    
    
    <div id='popup' class='tip-panel' style="width:270px;height:auto;border:#428bca solid 1px;-webkit-border-radius: 3px;-moz-border-radius: 3px;border-radius: 3px;position:fixed;display:none;background-color:white;">
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
                $query = mysql_query("SELECT vScannerName, iScannerID FROM Scanners ORDER BY iScannerID ASC");
                while ($row = mysql_fetch_object($query))
                    echo '<option value="'.$row->iScannerID.'" >'.$row->vScannerName.'</option>';
        ?>
        </select>
        </td>
        </tr>
        </table>
        <button id="popupconfirm" style="float:right;">Confirm</button>
	</div>
     <div id='databoxAddSession' style="width:270px;" >
             <div id='cart'>
            <p>Sessions in this Room</p>
            <ul>
                <li class="placeholder">Add your sessions here</li>
            </ul>
        </div>
        <div id="catalog">
            <p>Sessions &mdash; Conference Name</p>
            <ul>
              <?php
                $query = mysql_query("SELECT ID, concat(SUBSTRING(vSessionName, 1, 25),'...') as SessionNameShort, vSessionName as SessionNameFull, vSpeaker, dSessionBegin FROM Sessions where iEventGroupID = ".$FormData->{'EventGroup'}." ;");
                while ($row = mysql_fetch_object($query))
				 {
					 $fullInfo = $row->SessionNameFull." | ".$row->vSpeaker." | ".$row->dSessionBegin;
                     echo '<li value="'.$row->ID.'" title="'.$fullInfo.'" >'.$row->SessionNameShort.'</li>';
				 }
              ?>
               
            </ul>
        </div>
     </div>
    </div>
     <!-- end of pop up for session pad -->
     
        <!-- sketchpad -->
        <div id="svgsketch" oncontextmenu="return false" >
		</div>
        <!-- end of sketchpad -->
     
      <!-- session pad -->
		<div id="svgView">
		</div>
       <!-- end of pop up for session pad -->
	</article>
</section>
