<?php
session_start();
if(isset($_SESSION['user'])) {
?>


<?php include('head.php'); ?>
<?php include('includes/functions.php'); ?>
<div id="wrapper">

        

        
      <!-- Navigation -->
      
        <?php include('nav.php'); ?>


      <div id="page-wrapper">

        <div class="row">
          <div class="col-lg-12">
            <h1>Events</h1>
          </div>
        </div><!-- /.row -->

       

        <div class="row">

          <div class="col-lg-6">
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
				<?php
					$queryConfs = mysqli_query(Database::getConnection(),"SELECT * FROM confs ORDER BY name ASC");
						while($confs = mysqli_fetch_assoc($queryConfs)) {
				?>
                  <tr>
                    <td><?php echo $confs['name']; ?></td>
                    <td><?php echo $confs['location']; ?></td>
                    <td><?php echo $confs['date']; ?></td>
                    <td><a onclick="openEditWizard(<?php echo $confs['ID']; ?>);">Edit</a></td>
                  </tr>
				  <?php 
					}
				?>
                </tbody>
              </table>
            </div>
          </div>

         

			<!--<div class="col-lg-6">
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
          </div>--> 
            
        </div><!-- /.row -->

      </div><!-- /#page-wrapper -->

    </div><!-- /#wrapper -->

   <?php include('footer.php'); ?>
   
<?php
} else {
	header("location: login.php");
}
?>
