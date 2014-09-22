<?php 
include('head.php');
include 'includes/connect.php';
?> 
<script>
$('button').live('click', function(){

    if($(this).parent().find('input[value=],select[value=-1]').length == 0)
     $(this).parent().submit();
    else
     alert("One or more fields are empty!");

});
</script>

<?php 
      include('nav.php');
  	 
  	  include('includes/functions.php');
	  ?>
<div class="row">
	<div class="col-lg-4">
		<div class="panel panel-primary">
			<div class="panel-heading">
				<h3 class="panel-title"><i class="fa fa-barcode"></i> Create New Scanner</h3>
			</div>
			<div class="panel-body">  
				<form class="form-newscanner" role="form" method="post" action='ProcessScanner.php'>
					
                    
                    <select name="ConfID" type="text" class="form-control" required autofocus>
                    <?php
                          echo '<option class="form-control" value = "-1" disabled">Select a Conference</option>';                          
                          $query = mysql_query("SELECT ID, name FROM confs");
		                  while ($row = mysql_fetch_object($query))
			              echo '<option value="'.$row->ID.'" >'.$row->name.'</option>';
                    ?>
                    </select>
					
					<p style="color: #999; font-size: 11px;"> </p>
					<input name="ScannerName" type="text" class="form-control" placeholder="Scanner Name" required> 
					
					<p style="color: #999; font-size: 11px;">Example: 00:1B:5F:00:1A:B9</p>
					<input name="SeriNum" type="text" class="form-control" placeholder="Scanner Serial Number" required> 
					
					<p style="color: #999; font-size: 11px;">Example: SDF09</p>
					<input name="ModelNum" type="text" class="form-control" placeholder="Scanner Model Number" required> 
					
					<button type="button" class="btn btn-primary float-right">Submit</button>
				</form>
			</div>
		</div>
	</div>
</div>