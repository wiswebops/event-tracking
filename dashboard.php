<?php include('head.php'); ?>

 <div id="wrapper">

      <!-- Navigation -->
   

     
      <div id="page-wrapper">

        <div class="row">
          <div class="col-lg-12">
            <h1>Dashboard</h1>
          </div>
        </div><!-- /.row -->


        <!-- <div class="row">
          <div class="col-lg-4">
            <div class="panel panel-primary">
              <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-barcode"></i> Create New Scanners</h3>
              </div>
              <div class="panel-body">
                
            <form class="form-newscanner" role="form">
            <input type="text" class="form-control" placeholder="Conference ID" required autofocus>
            <p style="color: #999; font-size: 11px;">Example: 00:1B:5F:00:1A:B9</p>
            <input type="text" class="form-control" placeholder="Scanner Serial Number" required>
            
            <a href="#" class="openform"><button type="button" class="btn btn-primary float-right" type="submit">Submit</button></a>
            </form>
              </div>
            </div>
          </div>
		 </div>


        <div class="row">
          <div class="col-lg-4">
            <div class="panel panel-primary">
              <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-calendar"></i> Create New Event Wizard</h3>
              </div>
              <div class="panel-body">
                
            <form class="form-newevent" role="form">
            <input type="text" class="form-control" placeholder="Conference ID" required autofocus>
            <input type="text"  class="form-control" placeholder="Event Name" required>
            <input type="text"  class="form-control" placeholder="Location" required>
            <input type="text"  class="form-control" placeholder="Date" required>
            <div class="btn-group dropdown">
            <button type="button" placeholder="EventGroup" class="btn btn-default">Select Event Group Name</button>
            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
              <span class="caret"></span>
              <span class="sr-only">Toggle Dropdown</span>
            </button>
            <ul class="dropdown-menu" role="menu">
            <?php /*
				$query = mysql_query("SELECT DISTINCT iEventGroupID, vGroupName FROM Sessions WHERE dSessionBegin >= DATE_FORMAT( CURDATE( ) ,  '%Y-1-1' )");
				
				while ($row = mysql_fetch_object($query))
				{
					echo '<li value="'.$row->iEventGroupID.'">'.$row->vGroupName.'</li>';
				}*/
				
		    ?>
             
            </ul>
          </div>
          <br />
          <div id="floorplans">
		 <div id="floorselection">
          </div>
          <button id="AddFloorPlan" type="button" class="btn btn-primary " type="button">Add more</button>
          </div>
          <div>
            <button id="StartWizard" type="button" class="btn btn-primary float-right" type="button">Start Wizard</button>
            </div>
            </form>
              </div>
            </div>
          </div>
		

          <div class="col-lg-8">
            <div class="panel panel-primary">
              <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-clock-o"></i> Recent Events</h3>
              </div>
              <div class="panel-body">
                <div class="table-responsive">
              <table class="table table-hover table-striped tablesorter">
                <thead>
                  <tr>
                    <th>Name</th>
                    <th>Location</th>
                    <th>Date</th>
                    <th>&nbsp;</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>HR 2014</td>
                    <td>Orlando, FL</td>
                    <td>March 11-14, 2014</td>
                    <td><a href="#">Edit</a></td>
                  </tr>
                  <tr>
                    <td>SuccessFactors 2014</td>
                    <td>Orlando, FL</td>
                    <td>March 11-14, 2014</td>
                    <td><a href="#">Edit</a></td>
                  </tr>
                  <tr>
                    <td>GRC 2014</td>
                    <td>Orlando, FL</td>
                    <td>March 18-21, 2014</td>
                    <td><a href="#">Edit</a></td>
                  </tr>
                  <tr>
                    <td>Financials 2014</td>
                    <td>Orlando, FL</td>
                    <td>March 18-21, 2014</td>
                    <td><a href="#">Edit</a></td>
                  </tr>
                  <tr>
                    <td>HANA 2014</td>
                    <td>Orlando, FL</td>
                    <td>March 24-27, 2014</td>
                    <td><a href="#">Edit</a></td>
                  </tr>
                </tbody>
              </table>
            </div>
                <div class="text-right">
                  <a href="#">View All Events <i class="fa fa-arrow-circle-right"></i></a>
                </div>
              </div>
            </div>
          </div>
		</div>
          <div class="col-lg-4">-->

             <div class="row">
          <div class="col-md-5">
            <div class="panel panel-info">
              <div class="panel-heading">
                <div class="row">
                  <div class="col-xs-12">
                    <p class="announcement-heading"><a href="addScanner.php">Create New Scanner</a></p>
                    
                  </div>
                </div>
              </div>
             
            </div>
          </div>
          <div class="col-md-5">
            <div class="panel panel-info">
              <div class="panel-heading">
                <div class="row">
                 <div class="col-xs-12">
                    <p class="announcement-heading"><a href="addEvent.php">Create New Event</a></p>
                    
                  </div>
                </div>
              </div>
              
            </div>
          </div>
          </div>

        <div class="row">
          <div class="col-md-10 col-xs-12">
            <div class="panel panel-primary">
              <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-clock-o"></i> Recent Events</h3>
              </div>
              <div class="panel-body">
                <div class="table-responsive">
              <table class="table table-hover table-striped tablesorter">
                <thead>
                  <tr>
                    <th>Name</th>
                    <th>Location</th>
                    <th>Date</th>
                    <th>&nbsp;</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>HR 2014</td>
                    <td>Orlando, FL</td>
                    <td>March 11-14, 2014</td>
                    <td><a href="#">Edit</a></td>
                  </tr>
                  <tr>
                    <td>SuccessFactors 2014</td>
                    <td>Orlando, FL</td>
                    <td>March 11-14, 2014</td>
                    <td><a href="#">Edit</a></td>
                  </tr>
                  <tr>
                    <td>GRC 2014</td>
                    <td>Orlando, FL</td>
                    <td>March 18-21, 2014</td>
                    <td><a href="#">Edit</a></td>
                  </tr>
                  <tr>
                    <td>Financials 2014</td>
                    <td>Orlando, FL</td>
                    <td>March 18-21, 2014</td>
                    <td><a href="#">Edit</a></td>
                  </tr>
                  <tr>
                    <td>HANA 2014</td>
                    <td>Orlando, FL</td>
                    <td>March 24-27, 2014</td>
                    <td><a href="#">Edit</a></td>
                  </tr>
                </tbody>
              </table>
            </div>
                <div class="text-right">
                  <a href="#">View All Events <i class="fa fa-arrow-circle-right"></i></a>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-4">
            
            
        </div><!-- /.row -->

      </div><!-- /#page-wrapper -->

    </div><!-- /#wrapper -->

   <?php include('footer.php'); ?>
            
            


 <script>

$(document).ready(function() {
	
		$('#AddFloorImg').clone().contents().appendTo($('#floorselection'));
		   });

$('.dropdown').find('li').live('click', function(){ 
									var optionText = $(this).text();
									var optionValue = $(this).attr('value');
									var identifiedButton = $(this).parent().parent().find('button').first();
									identifiedButton.html(optionText).val(optionValue);
												});
$('#AddFloorPlan').live('click', function(){ 
							//var temp = $('#AddFloorImg').prepend('<button class="deldiv">X</button>');
							//.prepend('<button class="deldiv">X</button>')
							$('#AddFloorImg').clone().contents().prepend('<span class="deldiv" style="float:left;">X</span>').appendTo($('#floorselection'));
												});
$('.deldiv').live('click', function(){ 
									$(this).parent().remove();
									});
$('#StartWizard').live('click', function(){
		var FormData = {};								 
		$('.form-newevent').find('input, button').map(function(){
			     if(FormData[$(this).attr('placeholder')] != null )
				 {
					 if( $.isArray(FormData[$(this).attr('placeholder')]) == false )
				  		FormData[$(this).attr('placeholder')] =$.makeArray(FormData[$(this).attr('placeholder')]);
				     FormData[$(this).attr('placeholder')].push( $(this).val());
				 }
				 else
				 {
					 FormData[$(this).attr('placeholder')] = $(this).val();
				 }
				});

					console.log(JSON.stringify(FormData)	);		 
	$(window).scrollTop(0);
	$.fancybox({
		maxWidth	: 800,
		maxHeight	: 700,
		fitToView	: false,
		width		: '100%',
		height		: '100%',
		autoSize	: false,
		closeClick	: false,
		openEffect	: 'none',
		closeEffect	: 'none',
		scrolling : 'no',
		type : 'ajax',
		href : 'WizardController.php',
		ajax : { type : 'POST', data: {Conf: JSON.stringify(FormData)}}
		
		
	});

									   
									   });





</script>
<div id='testdiv'>

</div>


<div id='AddFloorImg' style='display:none;'>
    <div class="btn-group dropdown">
            <button type="button" placeholder="FloorPlan" class="btn btn-default">Select Floor Plan</button>
            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
              <span class="caret"></span>
              <span class="sr-only">Toggle Dropdown</span>
            </button>
            <ul class="dropdown-menu">
             <?php
				$query = mysql_query("SELECT DISTINCT ID, imageName FROM images");
				
				while ($row = mysql_fetch_object($query))
				{
					echo '<li value="'.$row->ID.'">'.$row->imageName.'</li>';
				}
				
		    ?>
            </ul>
             <input type="file" class="float-right" title="Search for a file to add">
          </div>
</div>
  