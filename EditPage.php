<?php

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



<form method="POST">
<table id="formBody">
<tr id="title">
<td></td>
</tr>
<tr> 
<td id="Wizard" >
</td>
   
</tr></table> 
<div id="WizardNav">
<button name="next">Next</button>
</div>
</form>
    
<?php

//for testing

//-------------- initiate wizard object ---------------------
$testobj = new Wizard($steps_edit_floors, isset($_POST['next'])?$_POST['next']:null, '#');
//-------------- initiate result array ---------------------

var_dump($_POST);

$floorID = 11;
$FloorInfo = mysqli_fetch_object(mysqli_query(Database::getConnection(), 'select * from floorlevel a inner join images b on a.iMapID = b.ID where a.ID ='.$floorID));

var_dump($FloorInfo);
echo '<script>';
if($FloorInfo!=null)
{
    echo '$(document).ready(function(){$("[name=Floorplans]").val("'.$FloorInfo->iMapID.'");});';
    
}
else
{
    
    
}
echo '</script>';

$results= array();
if(!$testobj->checkCompleted())
{
    ob_end_flush();
    if (sizeof($result['FloorLevel']['new'])>0 && $testobj->getCurrectStep()=='Review')
    {
        $testobj->SetNext('Create and Add');
    }
    $testobj->Render('Wizard', null);
    
}
?>    


</body>
</html>
     