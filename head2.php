
<style type="text/css">
@import "js/jquery.svg.css";
#tips ul { width: auto; }
table { width: 100%; }
pre { clear: none; }
div > svg { overflow: hidden; }
.ui-widget-content pre.ui-state-active { color: #000; font-weight: normal; }
.svgdiv { background: #transparent; border: 1px solid #3c8243; }
#svgintro { float: right; width: 150px; height: 150px; margin-right: 30px; background: #fff; border: 1px solid #3c8243; }
.svgsample { float: left; width: 48%; margin: 0% 1% 0% 0%; padding: 5px; }
.drawOpt { float: left; width: 25%; }
.row { clear: both; }
#domMods { display: none; }
#surface {fill-opacity: .1;}
#svgsketch { width: 800px; height: 600px; border: 1px solid #484; background-image: none; background-repeat: no-repeat;background-size: 100%;}
#svgView { width: 800px; height: 600px; border: 1px solid #484; background-image: none; background-repeat: no-repeat;background-size: 100%;display:none;}
.hover {fill:#FF8300; background-color:#FF8300;}
</style>
<!-- SVG modified version -->


<link rel="stylesheet" type="text/css" href="js/jquery.svg.css"/>
<script type="text/javascript" src="js/jquery.svg.js"></script>
<script type="text/javascript" src="js/jquery.svganim.js"></script>
<script type="text/javascript" src="js/jquery.svgdom.js"></script>
<script type="text/javascript" src="js/jquery.svgfilter.js"></script>
<script type="text/javascript" src="js/jquery.svggraph.js"></script>
<script type="text/javascript" src="js/jquery.svgplot.js"></script>
<script type="text/javascript" src="js/jquery.chili-2.2.js"></script>
<script type="text/javascript" src="js/utility_functions.js"></script>

<!-- Drag and drop ui -->
<link rel="stylesheet" href="//code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css">
<script src="//code.jquery.com/ui/1.10.4/jquery-ui.js"></script>


<script type="text/javascript">

//shared globals
var offset = null; 
var selectedNode = null;

//universal setting
var settings = {fill: '#FFE3BD', stroke: '#FF8300', strokeWidth: 1, style:'fill-opacity: .7;'}; 

//step 2 globals
var drawNodes = []; 
var sketchpad = null; 
var start = null; 
var outline = null; 

//step 3 globals
var Nodes_2_Sessions = new Object; 
var viewPad = null;


$('.hasSVG').live('focus', function(){
											  
															 
								if(this.id == 'svgsketch')
								{
									 $('#databoxAddSession').hide();
									 $('#databoxSketch').show();
									 
									
								}
								else
								{
									 $('#databoxAddSession').show();
									 $('#databoxSketch').hide();
									 
								}
															 
															 });


//initiation
$(function() {
     //sketchpad if exist
	
	
     $('#svgsketch').svg({onLoad: function(svg) {
		offset = ($.browser.msie ? {left: 0, top: 0} : $('#svgsketch').offset());
        sketchpad = svg; 
        var surface = svg.rect(0, 0, '100%', '100%', {id: 'surface', fill: 'white'}); 
        $(surface).mousedown(startDrag).mousemove(dragging).mouseup(endDrag);
        resetSize(svg, '100%', '100%');
		// $('#svgsketch').focus();
	
	
    } 
}); 
	 
	//viewpad if exist
	$('#svgView').svg({onLoad: function(svg) {
		offset = ($.browser.msie ? {left: 0, top: 0} : $('#svgView').offset()); 
	
        viewPad = svg; 
        resetSize(svg, '100%', '100%');
		var surface = svg.rect(0, 0, '100%', '100%', {id: 'surface', fill: 'white'}); 
		$(surface).click(function(){ $('#popup').fadeOut();});
		//viewMap_Load(7,11);
		
    } 
});


	
});




function startDrag(event) { 

  
   $('#popup').fadeOut();
   selectedNode = null;
   
   offset = ($.browser.msie ? {left: 0, top: 0} : $('#svgsketch').offset()); 
 
    if (!$.browser.msie) { 
        offset.left -= document.documentElement.scrollLeft || document.body.scrollLeft; 
        offset.top -= document.documentElement.scrollTop || document.body.scrollTop; 
    } 
    start = {X: event.clientX - offset.left, Y: event.clientY - offset.top}; 
    event.preventDefault(); 
	
} 
/* Provide feedback as we drag */ 
function dragging(event) {
	
	/* shows coordinate */
	$('#Xcoor1').html(event.clientX - offset.left);
	$('#Ycoor1').html(event.clientY - offset.top);
	
    if (!start ) { 
        return; 
    } 
    if (!outline) { 
        outline = sketchpad.rect(0, 0, 0, 0, 
            {fill: 'none', stroke: '#c0c0c0', strokeWidth: 1, strokeDashArray: '2,2'}); 
       // $(outline).mouseup(endDrag); 
    } 
   if ((checkOverlap({x: Math.min(event.clientX - offset.left, start.X), 
        y: Math.min(event.clientY - offset.top, start.Y), 
        width: Math.abs(event.clientX - offset.left - start.X), 
        height: Math.abs(event.clientY - offset.top - start.Y)})))
   return;
   sketchpad.change(outline, {x: Math.min(event.clientX - offset.left, start.X), 
        y: Math.min(event.clientY - offset.top, start.Y), 
        width: Math.abs(event.clientX - offset.left - start.X), 
        height: Math.abs(event.clientY - offset.top - start.Y)}); 
   event.preventDefault(); 
} 
/* Draw where we finish */ 
function endDrag(event) {
	
	if (!start) { 
        return; 
    } 
   
	if (!(start.X == event.clientX - offset.left && start.Y == event.clientY - offset.top) && (outline.getAttribute('width') > 25) && (outline.getAttribute('height') > 25))
	{
		var temp = drawShape(sketchpad, parseInt(outline.getAttribute('x')), parseInt(outline.getAttribute('y')),parseInt(outline.getAttribute('x'))+parseInt(outline.getAttribute('width')),parseInt(outline.getAttribute('y'))+parseInt(outline.getAttribute('height')), settings); 
		 $(temp).mousedown(SurfaceClick).mouseup(endDrag);
		$(temp).mousedown();
	}
	start = null;
    $(outline).remove(); 
    outline = null;
    event.preventDefault(); 
} 

var i = 1;
/* Draw the selected element on the canvas */ 
function drawShape(pad ,x1, y1, x2, y2, settings, ExtraData) { 
    var left = Math.min(x1, x2); 
    var top = Math.min(y1, y2); 
    var right = Math.max(x1, x2); 
    var bottom = Math.max(y1, y2); 
	var winner = Math.random();
   
    var node = null; 
    node = pad.rect(left, top, right - left, bottom - top, settings, ExtraData); 
   

    drawNodes[drawNodes.length] = node; 
    
    /* $('#svgsketch').focus(); 
	
	$( "#forms" ).append( "<div id='form" + i + "'><table class='add_domain p_scnt'  style='margin-right: 19px;'><tr class='confID' style='background-color: inherit;'><td><label for='confID'>Conference ID <span style='color:red;'>*</span></label></td><td><input type='text' name='confID' value='" + z + "' /></td></tr><tr class='name' style='background-color: inherit;'><td><label for='name'>Name <span style='color:red;'>*</span></label></td><td><input type='text' name='name' /></td></tr><tr class='scannerID' style='background-color: inherit;'><td><label for='scannerID'>scannerID <span style='color:red;'>*</span></label></td><td><input type='text' name='scannerID' /></td></tr><tr class='x' style='background-color: inherit;'><td><label for='x'>x <span style='color:red;'>*</span></label></td><td><input type='text' name='x' value='" + left + "' /></td></tr><tr class='y' style='background-color: inherit;'><td><label for='y'>y <span style='color:red;'>*</span></label></td><td><input type='text' name='y' value='" + top + "' /></td></tr><tr class='width' style='background-color: inherit;'><td><label for='width'>width <span style='color:red;'>*</span></label></td><td><input type='text' name='width' value='" + (right - left) + "' /></td></tr><tr class='height' style='background-color: inherit;'><td><label for='height'>height <span style='color:red;'>*</span></label></td><td><input type='text' name='height' value='" + (bottom - top) + "' /></td></tr></table></div><hr>"); */
	i++;
	//$('.rect').attr('id', winner);
	//$('.rect').append('<img xlink:href="images/delete.png" alt="" />');
	console.log(left + ', ' + top + ', ' + (right - left) + ', ' + (bottom - top));
	return node;
}; 
function viewPadClick(event)
{
	offset = ($.browser.msie ? {left: 0, top: 0} : $('#svgView').offset()); 
	
	offseted_X =event.clientX-offset.left
    offseted_Y =event.clientY-offset.top;
	currentNode = $(this);
	if(currentNode.is($(selectedNode)))
	{
			 $('#popup').fadeToggle(function(){
				if($(this).attr('display') == null)
				{
					//content change
					$(this).find('#databox').html('Room Name: '+$(currentNode).attr('roomname')+'</br>Scanner ID: '+scannerList[$(currentNode).attr('scannerid')]);
					
					
				}
				
			});
	}
    else
	{
		   selectedNode=currentNode;
	   	   $('#popup').fadeOut(function(){
					var alt_ref = this;
					$(this).css({"left":parseInt($(currentNode).attr('x'))+parseInt($(currentNode).attr('width'))*.5+offset.left,"top":parseInt($(currentNode).attr('y'))+parseInt($(currentNode).attr('height'))*.5+offset.top});
					$(this).find('#databox').html('Room Name: '+$(currentNode).attr('roomname')+'</br>Scanner ID: '+scannerList[$(currentNode).attr('scannerid')]);
					
	                $(this).find('div[id="cart"] ul li').remove();
					//$(this).find('div[id="cart"] ul').append('<li>');
					if(Nodes_2_Sessions[selectedNode.attr('id')].length > 0)
					{
					Nodes_2_Sessions[selectedNode.attr('id')].forEach(function(draggables){
									$(alt_ref).find('div[id="cart"] ul').append(draggables);
																			   });
					}
					else
					{
						 $(this).find('div[id="cart"] ul').append('<li class="placeholder">Add your sessions here</li>');
					}
					
				}).fadeIn();
	}
}

function SurfaceClick(event)
{
	offset = ($.browser.msie ? {left: 0, top: 0} : $('#svgsketch').offset()); 
	
	offseted_X =event.clientX-offset.left
    offseted_Y =event.clientY-offset.top;
	currentNode = $(this);
	
	if(event.button == 2)
	{
		drawNodes[drawNodes.indexOf(this)].setAttribute('delete', 'true');
		//drawNodes.splice((drawNodes.indexOf(this)),1);
		
		if(currentNode.is($(selectedNode)))
		{
			$('#popup').hide();
			selectedNode = null;
		}
		$(this).remove();
		optionUpdate();
	}
	else
	{
	   if(currentNode.is($(selectedNode)))
	   {
			 $('#popup').fadeToggle(function(){
				if($(this).attr('display') == null)
				{
							
							$(this).find('input').val($(currentNode).attr('roomname'));
							$(this).find('select').val($(currentNode).attr('scannerid'));
				}
				
			});
	   }
	   else
	   {
		   selectedNode=currentNode;
	   	   $('#popup').fadeOut(function(){
					$(this).css({"left":parseInt($(currentNode).attr('x'))+parseInt($(currentNode).attr('width'))*.5+offset.left,"top":parseInt($(currentNode).attr('y'))+parseInt($(currentNode).attr('height'))*.5+offset.top});
					$(this).find('input').val($(currentNode).attr('roomname'));
					$(this).find('select').val($(currentNode).attr('scannerid'));
				}).fadeIn();
	   }
	}
}



$('#popupconfirm').live('click',function(){
										 
			
			 $(this).parent().find('tr input,select').each(function(){
							
							$(currentNode).attr(this.name, this.value);	
			 });
			 optionUpdate();
			 $(this).parents('.tip-panel').fadeOut(); 
});
 
/* Remove the last drawn element */ 
$('#undo').click(function() { 
    if (!drawNodes.length) { 
        return; 
    } 
    sketchpad.remove(drawNodes[drawNodes.length - 1]); 
    drawNodes.splice(drawNodes.length - 1, 1); 
}); 
 
/* Clear the canvas */ 
$('#clear2').click(function() { 
    while (drawNodes.length) { 
        $('#undo').trigger('click'); 
    } 
}); 
 
/* Convert to text */ 
$('#toSVG').click(function() { 
    alert(sketchpad.toSVG()); 
});

function drawNodes_to_JSON ()
{
	var dataString=[];
	var i;
	var serializer = new XMLSerializer();
	drawNodes.forEach(function(SVGNode){
		dataString.push(serializer.serializeToString(SVGNode));
	});	
	return JSON.stringify(dataString);
	
	
}

function Room_2_Level_Save(event_id, floor_id, functionx)
{	   
	$.ajax({
           			type: "POST",
          			url: "roomsDoAdd.php",
           			data: {Nodes: drawNodes_to_JSON(), confID: event_id, level_id: floor_id},
		   			cache: false,
					//dataType: "json",
		   			success: function(data){ 
					     
					}
	}).done(function(){functionx();});
	
}

function Load_Structure(event_id, floor_id, MDFunction, MUFunction)
{
		$.ajax({
           			type: "POST",
          			url: "roomsDoLoad.php",
           			data: {confID: event_id, level_id: floor_id},
		   			cache: false,
					dataType: "json",
		   			success: function(data){
						
						   drawNodes=[];
						   
						   $('rect').not('[id="surface"]').remove();
					       data.forEach(function(Nodes){
								
								var ExtraData = {id: Nodes.ID, roomname: Nodes.name, scannerid: Nodes.iScannerID};
								var temp =drawShape(MUFunction == null? viewPad : sketchpad, Nodes.x, Nodes.y, parseInt(Nodes.x)+parseInt(Nodes.width), parseInt(Nodes.y)+parseInt(Nodes.height), settings, ExtraData);	
							    //$(temp).mousedown(SurfaceClick).mouseup(endDrag);
								 $(temp).mousedown(MDFunction).mouseup(MUFunction);
								 if(!Nodes_2_Sessions[Nodes.ID]) Nodes_2_Sessions[Nodes.ID]=[];
								 
								 
						   });
							 
					}
					
	}).done(function(){optionUpdate();});
}

/*
function viewMap_Load(event_id, floor_id)
{
		$.ajax({
           			type: "POST",
          			url: "roomsDoLoad.php",
           			data: {confID: event_id, level_id: floor_id},
		   			cache: false,
					dataType: "json",
		   			success: function(data){
						
						   drawNodes=[];
						   $('rect').not('[id="surface"]').remove();
					       data.forEach(function(Nodes){
								
								var ExtraData = {id: Nodes.ID, roomname: Nodes.name, scannerid: Nodes.iScannerID};
								var temp = drawShape(viewPad, Nodes.x, Nodes.y, parseInt(Nodes.x)+parseInt(Nodes.width), parseInt(Nodes.y)+parseInt(Nodes.height), settings, ExtraData);
								  $(temp).mousedown(viewPadClick);
								 //initiating session data 
								 Nodes_2_Sessions[Nodes.ID]=[];
							});
											  
					}
					
	});
}
*/

</script>