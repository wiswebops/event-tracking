
<script>
$('#StartWizard').on('click', function(){
		$(window).scrollTop(0);
	/*	$.fancybox({
		maxWidth	: 800,
		maxHeight	: 700,
		fitToView	: false,
		width		: '100%',
		height		: '100%',
		autoSize	: false,
		closeClick	: false,
		openEffect	: 'none',
		closeEffect	: 'none',
		scrolling: 'no',
	});
*/
									   
									   });
</script>


    <div id="wrapper">

      <!-- Navigation -->
     <?php include('head.php'); ?> 
      <?php include('nav.php'); ?>


      <div id="page-wrapper">

        <div class="row">
          <div class="col-lg-12">
            <h1>Dashboard</h1>
          </div>
        </div><!-- /.row -->


         <div class="row">
          <div class="col-lg-4">
            <div class="panel panel-primary">
              <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-barcode"></i> Create New Scanner</h3>
              </div>
              <div class="panel-body">
                
            <form class="form-newevent" role="form">
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
            <button type="button" class="btn btn-default">Select Event Group Name</button>
            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
              <span class="caret"></span>
              <span class="sr-only">Toggle Dropdown</span>
            </button>
            <ul class="dropdown-menu">
             <li>BI and IT 2014</li>
             <li>Projects, Reporting, and Outsourcing 2014</li>
             <li>SCM and CRM 2014</li>
            </ul>
          </div>
		  <div class="btn-group dropdown">
            <button type="button" class="btn btn-default">Select Floor Plan</button>
            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
              <span class="caret"></span>
              <span class="sr-only">Toggle Dropdown</span>
            </button>
            <ul class="dropdown-menu">
             <li>Walt Disney World Swan and Dolphin - FL</li>
             <li>Nice Acropolis Convention Center - Nice</li>
             <li>MGM Grand Hotel and Casino -NV</li>
            </ul>
          </div>
          <input type="file" class="float-right" title="Search for a file to add">
            <button id="StartWizard" type="button" class="btn btn-primary float-right" type="button">Start Wizard</button>
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
          <div class="col-lg-4">
            
            
			</div><!-- /.row -->

      </div><!-- /#page-wrapper -->

    </div><!-- /#wrapper -->

 



<div id='DataLoading' style='display:none;'>
     <!-- ADD STEP 2 HERE -->
</div>
  <?php include('footer.php'); ?>