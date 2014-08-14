 <?php /*
session_start();
if(isset($_SESSION['user'])) {
*/
?>
<?php include('head.php'); ?>
<?php include('head2.php'); ?>
<?php include('header.php'); ?>
<style>
li {list-style-type: none;}
ul{padding:0;}
#cart {padding:0 5px;background-color:#9cc4e4;color:#1b325f;float: left;width: 49%;}
#catalog {padding:0 5px;background-color:#9cc4e4;color: #1b325f;float: right;width: 49%;}
#catalog li, #cart li {border-top:1px solid white;}
#catalog li {cursor:pointer;}
</style>
<script>
$( ".map" ).live( "hover", function( event ) {
  $( this ).addClass( "hover" );
  //console.log('hello');
});

$( ".map" ).live( "hover",
  function() {
    $( this ).addClass( "hover" );
  }, function() {
    $( this ).removeClass( "hover" );
  });
</script>

<script>
  $(function() {
  
  $( ".SessionRemove" ).live('click',function(){
									console.log($(this).parent().val());
									var returningBlock = $(this).parent();
									returningBlock.draggable({helper: 'clone'});
									$(this).remove();
									Nodes_2_Sessions[currentNode.attr('id')].splice(returningBlock, 1);
									
									if (Nodes_2_Sessions[currentNode.attr('id')].length == 0)
									{
										 $(returningBlock).parent().append('<li class="placeholder">Add your sessions here</li>');
									}
									returningBlock.appendTo($('#catalog'));
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
		ui.draggable.append('<img src="images/drag_delete.png" class="SessionRemove" style="margin-left:5px;cursor:pointer;"/>');
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
  function Sessions_Save(event_id, floor_id)
	{
		
		$.ajax({
           			type: "POST",
          			url: "SessionDoAdd.php",
           			data: {Nodes: Prepare_Session_Data(), confID: event_id, level_id: floor_id},
		   			cache: false,
					//dataType: "json",
		   			success: function(data){ 
					       console.log(data);
					}
	}).done(function(){});
		
	}
	
	function Sessions_Load()
	{
		
		
	}
  </script>
  
  <script>
  $(function() {
    $( "#expand" ).accordion({
		heightStyle: "content",
		active: false,
		collapsible: true,
    });
  });
  </script>
  <style>
	.ui-accordion .ui-accordion-content {
		height: 600px !important;
		width: 800px;
		position: fixed;
		top: 40px;
		left: 0px;
	}
	.ui-state-active {
		position:fixed !important;
		top: 0px;
		left: 0px;
	}
  </style>
  
<section class="main">
	<article style="float:left;margin-right: 20px;">
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
        <div id='popup' class='tip-panel' style="width:230px;height:auto;border:#428bca solid 1px;-webkit-border-radius: 3px;-moz-border-radius: 3px;border-radius: 3px;position:absolute;display:none;background-color:white;">
<div id='close' style="width:220px;height:20px;text-align:right;cursor:pointer;" onClick="$(this).parent().hide();">X</div>
<div id='databox'  style="width:270px;" ></div>
<div id="expand">
	<h3 id="expandButton" style="padding-left:20px;">Add/Manage Sessions</h3>
	<div id="expandContent">
	<div id='cart'>
		<p style="font-weight:bold;">Sessions Already Added to this Room</p>
		<ul>
			<li class="placeholder">Add your sessions here</li>
		</ul>
	</div>
	<div id="catalog">
		<p style="font-weight:bold;">Sessions to be Added</p>
		<ul>
			<li value='7809'>OCT 4 | 1:00pm - 2:00pm | How The World Goes Round | Al Gore</li>
			<li value='7772'>OCT 5 | 2:00pm - 3:00pm | Steak Tips for Dinner | Al Gore</li>
			<li value='7804'>OCT 6 | 11:00am - 12:00pm | Web for Geniuses | Al Gore</li>
		</ul>
	</div>
	</div>
</div>
</div>
		<div id="svgView">
		</div>
	</article>
	
	<!-- <article>
	<form id='requestForm' action='roomsDoAdd.php' method='post'>
		<div id="forms">
		</div>
		<table class='add_domain' name ='submitcol' style='width: 100%;'><tr style='background-color: inherit;'><td clospan='2'><input type='submit' name='submit' /></td></tr></table>
	</form>
	</article> -->

</section>
<?php include('footer.php'); ?>
<?php
/*
} else {
	header("location: login.php");
}*/
mysql_close();
?> 