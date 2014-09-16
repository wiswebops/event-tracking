<?php

phpinfo();

require 'includes/connect.php';

require 'WizardSteps.php';

require 'WizardClass.php';

ob_start();
require 'SketchBook_Setup.php';

?>
<html>
<head>
<meta charset="utf-8">

<script>
var cur_floor;
var cur_event;
    
function getData(option)
{
    var datax;
    return $.ajax({
           		type: "POST",
          		url: "DataRetrieve.php",
           	    data: {choice: option},
		        cache: false,
				dataType: "json",
		        success: function(x){
                    return x;
                }});
    
}
    

    
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
    
 
    
    
    
     $(document).ready(function(){ 
        if ( $( "#svgView" ).length )
        {
            console.log(cur_event+" "+cur_floor);
            Load_Structure(cur_event,cur_floor,viewPadClick,null,viewPad );
            
             $('button[name=next]').live('click',function(e){
       
       
            alert('ahah');
        var ParentForm = $(this).parents('form');
        Sessions_Save(cur_event,cur_floor,function(){ParentForm.submit();});
    
            });
            
        }
         
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
		$x = mysql_query("SELECT vScannerName, iScannerID FROM Scanners ORDER BY iScannerID ASC");
		while ($row = mysql_fetch_object($x))
		{
			echo '
			scannerList['.$row->iScannerID.']=\''.$row->vScannerName.'\';
			
			';
		}
			echo '</script>';

                $queryx = mysql_query("SELECT vScannerName, iScannerID FROM Scanners ORDER BY iScannerID ASC");
                
                while ($row = mysql_fetch_object($queryx))
                {
                  echo '<option value="'.$row->iScannerID.'">'.$row->vScannerName.'</option>';
                }
                
        ?>
        </select></td></tr></table></div> <button id="popupconfirm" style="float:right;">Confirm</button></div>   
   
    
  

<div id="ProgressBar">
</div>
<form method="POST">
<table id="formBody">
<tr id="title">
<td colspan="2"></td>
</tr>
<tr>
<td>
<div class="progress">
</div>
</td>
</tr>
<tr> 
<td id="Wizard" >
</td>
<td>
<div id='popupSession' class='tip-panel' style="width:350px;height:600px;border:#428bca solid 1px;-webkit-border-radius: 3px;-moz-border-radius: 3px;border-radius: 3px;position:relative;display:none;background-color:white;">
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
</tr></table> 
<div id="WizardNav">
<button name="next">Next</button>
</div>
</form>
    
<?php

//for testing

//-------------- initiate wizard object ---------------------
$testobj = new Wizard($steps_create, isset($_POST['next'])?$_POST['next']:null, 'http://www.google.com');
//-------------- initiate result array ---------------------


$result=array();

//-------------- if process exists call function ---------------------
if(isset($_POST['process']))
{
   $callback=preg_replace('/\s+/', "",$_POST['process']);
   $result=call_user_func($callback);
      
   //-------------- terminate wizard on failure ---------------------
   if($result['status']=='Fail')
   {
        echo '<script>$("body").empty();</script>';
        echo $result['message'];
        return;   
   }
   //-------------- initiate wizard object ---------------------
    $testobj->setIdentifier($result['EventID']);
   if(array_key_exists('currentFloorMap', $result))
   {
        echo '<script>$(function() {$(".hasSVG").css("background-image","url('.$result['currentFloorMap']['fileName'].')");});
        cur_event = '.$result['EventID'].';
        cur_floor = '.$result['currentFloorID'].';
        $("form").append(\'<input name="currentFloorID" type="hidden" value="'.$result['currentFloorID'].'"/>\');';
       /* 
       for($i = 0;$i<sizeof($result['FloorLevel']);$i++)
        {
            echo  '$("form").append(\'<input name="FloorLevel['.$i.'][FloorID]" type="hidden" value="'.$result['FloorLevel'][$i]['FloorID'].'"/>\');';
            echo  '$("form").append(\'<input name="FloorLevel['.$i.'][MapID]" type="hidden" value="'.$result['FloorLevel'][$i]['MapID'].'"/>\');';
        }*/
        
         echo  '$("form").append(\'<input name="FloorLevel" type="hidden" value=\\\''.json_encode($result['FloorLevel']).'\\\'/>\');';
       
     //progress bar
        if (is_array($result['FloorLevel'])==1)
        {
             foreach($result['FloorLevel']['processed'] as $key => $value)
            {
                $step = ($key==sizeof($result['FloorLevel']['processed'])-1)?($testobj->getCurrectStep()=='Create and Add'?1:2):0;
                 // $step = $testobj->getCurrectStep()=='Create and Add'?1:2;
                echo 'Progress_makeCircle("progress",cur_event,cur_floor,"'.$value['LevelName'].'", "done", '.$step.');';
            }
            foreach($result['FloorLevel']['new'] as $key => $value)  
            {
                echo 'Progress_makeCircle("progress",cur_event,cur_floor,"'.$value['LevelName'].'","",0);'; 
            }
          
        }
        echo '</script>';
        
    
   }
    
    //-------------- populate sessions ---------------------
        $queryd = mysql_query("SELECT ID, concat(SUBSTRING(vSessionName, 1, 25),'...') as SessionNameShort, vSessionName as SessionNameFull, vSpeaker, dSessionBegin, iEventGroupID FROM Sessions where iEventGroupID = ".$result['EventID']." limit 10;");
        
        echo '<script>';
    
        while ($row = mysql_fetch_object($queryd))
		{
			$fullInfo = $row->SessionNameFull." | ".$row->vSpeaker." | ".$row->dSessionBegin;
                echo '$("#catalog ul").append("<li value=\"'.$row->ID.'\" title=\"'.$fullInfo.'\" >'.$row->SessionNameShort.'</li>");';
        }
        echo '</script>';
   
    //var_dump( $result);
   
}

if(!$testobj->checkCompleted())
{
    ob_end_flush();
    if (sizeof($result['FloorLevel']['new'])>0 && $testobj->getCurrectStep()=='Review')
    {
        $testobj->SetNext('Create and Add');
    }
    $testobj->Render('Wizard', $result['FloorLevel']);
    
}
?>    


</body>
</html>
     
