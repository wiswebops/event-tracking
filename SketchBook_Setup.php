<style type="text/css">

#tips ul { width: auto; }
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
#svgView { width: 800px; height: 600px; border: 1px solid #484; background-image: none; background-repeat: no-repeat;background-size: 100%;}
form table{float:left;}
#WizardNav{clear:both;}
.hover {fill:#FF8300; background-color:#FF8300;} 
h3{margin:5px;}
    
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

    
@-webkit-keyframes inglow
{
        1% { fill: hsl(40, 100%, 55%);}
        50% { fill: hsl(20, 100%, 40%); }
        100% { fill: hsl(40, 100%, 55%);}
}
@-webkit-keyframes outglow
{
       1% { fill: hsl(40, 100%, 55%); -webkit-transform: scale(1.1);opacity: .5;}
       50% { fill: hsl(20, 100%, 40%); -webkit-transform: scale(1.18);opacity: .2;}
       100% { fill: hsl(40, 100%, 55%);-webkit-transform: scale(1.21);opacity: 0;}
}

.selectedRect
{
    position:absolute;
    -webkit-transform-origin: 50% 50% 0;
    -webkit-animation: inglow linear 1.5s infinite ;
}
    
.selectedRectOut
{
    position:absolute;
    pointer-events:none;
    -webkit-transform-origin: 50% 50% 0;
    -webkit-animation: outglow linear .7s infinite ;
}
</style>

<link rel="stylesheet" type="text/css" href="js/jquery.svg.css"/>



<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script>
var X = $.noConflict(true);
</script>
<script type="text/javascript" src="js/jquery-1.7.2.js"></script>

<script type="text/javascript" src="js/jquery.svg.js"></script>
<script type="text/javascript" src="js/jquery.svganim.js"></script>
<script type="text/javascript" src="js/jquery.svgdom.js"></script>
<script type="text/javascript" src="js/jquery.svgfilter.js"></script>
<script type="text/javascript" src="js/jquery.svggraph.js"></script>
<script type="text/javascript" src="js/jquery.svgplot.js"></script>
<script type="text/javascript" src="js/jquery.chili-2.2.js"></script>
<script type="text/javascript" src="js/utility_functions.js"></script>

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.23/jquery-ui.min.js"></script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.1/themes/smoothness/jquery-ui.css">

<script type="text/javascript" src="js/fancyBox/source/jquery.fancybox.pack.js"></script>
<link rel="stylesheet" href="css/jquery.fancybox.css" type="text/css" media="screen" />
<script type="text/javascript">

//shared globals
var offset = null; 
var selectedNode = null;

//universal setting
var settings = { fill: 'orange', stroke: '#FF8300', strokeWidth: 1, style:'fill-opacity: .5;'}; 

//step 2 globals
var drawNodes = []; 
var sketchpad = null; 
var start = null; 
var outline = null; 

//step 3 globals
var Nodes_2_Sessions = new Object; 
var viewPad = null;


$(function() {
     //sketchpad if exist
     $('#svgsketch').svg({onLoad: function(svg) {
		offset = ($.browser.msie ? {left: 0, top: 0} : $('#svgsketch').offset());
        sketchpad = svg; 
        var surface = svg.rect(0, 0, '100%', '100%', {id: 'surface', fill: 'white'}); 
        $(surface).mousedown(startDrag).mousemove(dragging).mouseup(endDrag);
        resetSize(svg, '100%', '100%');
		// $('#svgsketch').focus();
	}}); 
	 
	//viewpad if exist
	$('#svgView').svg({onLoad: function(svg) {
		offset = ($.browser.msie ? {left: 0, top: 0} : $('#svgView').offset());
        viewPad = svg; 
        resetSize(svg, '100%', '100%');
		var surface = svg.rect(0, 0, '100%', '100%', {id: 'surface', fill: 'white'}); 
		$(surface).click(function(){ $('#popup').fadeOut();});
		//$(surface).mousedown(startDrag).mousemove(dragging).mouseup(endDrag);
        //viewMap_Load(7,11);
		}});
});


function Progress_makeCircle(divClass, EventID, MapID, LevelName, statusClass, OnStep)
{

    
	var circleDiv1 = X('<div>',{class: "circle "+(OnStep==1?"Active":statusClass)});
	var circleDiv2 = X('<div>',{class: "circle "+(OnStep==2?"Active":(OnStep==1?"":statusClass))});
	var spanLabel1 = X('<span>',{text: "1", class: "label"});
	var spanLabel2 = X('<span>',{text: "2", class: "label"});
	var spanp1 = X('<p>',{text:  "Rooms", class: "title spacer"});
	var spanp2 = X('<p>',{text: "Sessions", class: "title"});
	var bar = X('<span>',{class: "bar"});
    circleDiv1.append(spanLabel1).append(spanp1);
	circleDiv2.append(spanLabel2).append(spanp2);
	X("."+divClass).append(circleDiv1).append(bar).append(circleDiv2);
}
    
function startDrag(event) {
   $(selectedNode).removeClass('selectedRect');
     $('.selectedRectOut').remove();
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
	i++;
	console.log(left + ', ' + top + ', ' + (right - left) + ', ' + (bottom - top));
	return node;
}; 
    
function SurfaceClick(event)
{
	offset = ($.browser.msie ? {left: 0, top: 0} : $('#svgsketch').offset()); 
	
	offseted_X =event.clientX-offset.left
    offseted_Y =event.clientY-offset.top;
	currentNode = $(this);
    
    //$(this).attr('filter','url(#glowout)');
    
	if(event.button == 2)
	{
		drawNodes[drawNodes.indexOf(this)].setAttribute('delete', 'true');
		//drawNodes.splice((drawNodes.indexOf(this)),1);
		if(currentNode.is($(selectedNode)))
		{
			
            
            $('#popup').hide();
             $('.selectedRectOut').remove();
           // $(selectedNode).removeClass('selectedRect');
            selectedNode = null;
		}
		$(this).remove();
        optionUpdate();
	}
	else
	{
	    $('.selectedRectOut').remove();
       if(currentNode.is($(selectedNode)))
	   {
           $('#popup').fadeToggle(function(){
				if($(this).attr('display') == null)
				{
							
							$(this).find('input').val($(currentNode).attr('roomname'));
							$(this).find('select').val($(currentNode).attr('scannerid'));
				}
				
			});
           var svg = document.getElementById('svgsketch').getElementsByTagName('svg')[0];
           svg.appendChild(currentNode.clone().addClass('selectedRectOut').last()[0]);
           $(selectedNode).addClass('selectedRect');
	   }
	   else
	   {
		  
           var svg = document.getElementById('svgsketch').getElementsByTagName('svg')[0];
           svg.appendChild(currentNode.clone().addClass('selectedRectOut').last()[0]);
           $(selectedNode).removeClass('selectedRect');
           $(currentNode).addClass('selectedRect');
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
    
function viewPadClick(event)
{
	//offset = ($.browser.msie ? {left: 0, top: 0} : $('#svgView').offset()); 
	 
	//offseted_X =event.clientX-offset.left
    //offseted_Y =event.clientY-offset.top;
	currentNode = $(this);
    $('.selectedRectOut').remove();
    var svg = document.getElementById('svgView').getElementsByTagName('svg')[0];
    svg.appendChild(currentNode.clone().addClass('selectedRectOut').last()[0]);
	if(!currentNode.is($(selectedNode)))

	{
          
           $(selectedNode).removeClass('selectedRect');
           $(currentNode).addClass('selectedRect');
           
		   selectedNode=currentNode;
	   	   $('#popupSession').fadeOut(function(){
					var alt_ref = this;
					//$(this).css({"left":parseInt($(currentNode).attr('x'))+parseInt($(currentNode).attr('width'))*.5+offset.left,"top":parseInt($(currentNode).attr('y'))+parseInt($(currentNode).attr('height'))*.5+offset.top});
					$('#Panel_roomName').html($(currentNode).attr('roomname'));
                    $('#Panel_scanner').html(scannerList[$(currentNode).attr('scannerid')]);
                   
					
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
    
    
    
function nodes_to_data ()
{
	var dataString=[];
	$('rect:not("#surface"):not(".selectedRectOut")').each(function(){
        var paraArray= new Array();
        for(var i = 0;i<this.attributes.length;i++)
        {
            var temp = this.attributes[i];
            
            paraArray[temp.name] = temp.value;  
            paraArray.length = i+1;
        }
		dataString.push(paraArray);
	});	
	return dataString;
}
    
function drawNodes_to_JSON ()
{
	var dataString=[];
	var i;
	var serializer = new XMLSerializer();
	drawNodes.forEach(function(SVGNode){
		dataString.push(serializer.serializeToString(SVGNode));
	});
   
	return dataString;
	
	
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
					     console.log(data);
					}
	}).done(functionx());
	
}
    
    
function Load_Structure(event_id, floor_id, MDFunction, MUFunction, pad)
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
								var temp =drawShape(pad, Nodes.x, Nodes.y, parseInt(Nodes.x)+parseInt(Nodes.width), parseInt(Nodes.y)+parseInt(Nodes.height), settings, ExtraData);	
							    //$(temp).mousedown(SurfaceClick).mouseup(endDrag);
								 $(temp).mousedown(MDFunction).mouseup(MUFunction);
								 if(!Nodes_2_Sessions[Nodes.ID]) Nodes_2_Sessions[Nodes.ID]=[];
								 
								 
						   });
							 
					}
					
	}).done(function(){optionUpdate();});
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
					     
					}
	}).done();
		
}   

</script>