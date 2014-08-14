function resetSize(svg, width, height) {
	svg.configure({width: width || $(svg._container).width(),
		height: height || $(svg._container).height()});
}

function checkOverlap (node)
{
	for(var i = 0; i<drawNodes.length; i++)
	{
		if(drawNodes[i].getAttribute('delete') != 'true'){
		var x1,x2,y1,y2;
		x1=parseInt(drawNodes[i].getAttribute('x'));
		x2=parseInt(drawNodes[i].getAttribute('x'))+parseInt(drawNodes[i].getAttribute('width'));
		y1=parseInt(drawNodes[i].getAttribute('y'));
		y2=parseInt(drawNodes[i].getAttribute('y'))+parseInt(drawNodes[i].getAttribute('height'));
		if((x1 < (node.x+node.width)) && (y1 < (node.y+ node.height)) && (x2 > node.x) && (y2 > node.y))
		{
		   return true;
		}}
	}
	return false;
}

function optionUpdate()
{
	$('#popup select option').attr('disabled',false);
	 drawNodes.forEach(function(nodez){
							
			if(nodez.getAttribute('delete') != 'true')
					$('#popup select').find('option[value='+nodez.getAttribute('scannerid')+']').attr('disabled',true);				
	 });
}