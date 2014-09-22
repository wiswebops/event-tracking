<?php 
include('head.php');
include 'includes/connect.php';
?> 

<link rel="stylesheet" href="//code.jquery.com/ui/1.11.1/themes/smoothness/jquery-ui.css">
<style>
.ui-datepicker {
	margin-left: 238px;
	margin-top: -34px;
}

.img_preview {
	width: 215px;
	height: 134px;
	border: 1px solid black;
	margin: 20px auto;
	-webkit-border-radius: 5px;
	-moz-border-radius: 5px;
	border-radius: 5px;
}

.float-right {
	float:right;
}

.close_btn {
	float: right;
	width: 30px;
	height: 30px;
}

.close_btn_image {
	width: 30px;
}

.panel-primary {
	float: left;
	width: 100%;
}
</style>

<div class="row">
	<div class="col-lg-6">
		<div class="panel panel-primary">
			<div class="panel-heading">
				<h3 class="panel-title"><i class="fa fa-barcode"></i> Edit Room Info</h3>
			</div>
			<div class="panel-body" style="width: 50%;float: left;">  
				<form class="form-newscanner" role="form" method="post" action='ProcessScanner.php'>
					
					<p style="color: #999; font-size: 11px;"> </p>
					<input name="ConferenceID" type="text" class="form-control" value="ConferenceID" required> 
					
					<p style="color: #999; font-size: 11px;"> </p>
					<input name="EventName" type="text" class="form-control" value="EventName" required> 
					
					<p style="color: #999; font-size: 11px;"></p>
					<input name="Location" type="text" class="form-control" value="Location" required> 
					
					<p style="color: #999; font-size: 11px;"></p>
					<input name="Date" type="datetime" class="datetime form-control" value="Thursday, 4 September, 2014" required> 
					
				</form>
			</div>
			<div class="panel-body" style="width: 50%;float: left;">  
					
					<p style="color: #999; font-size: 11px;"> </p>
					<a href="#" class="openform"><button class="btn btn-primary float-left" >Add New Floor</button></a>
					<div class="img_preview_div">
						<div class="img_preview">
							<div class="close_btn">
								<a href=""><img class="close_btn_image" src="images/close.png" /></a>
							</div>
							<img src="" />
						</div>
						<div class="img_preview">
							<div class="close_btn">
								<a href=""><img class="close_btn_image" src="images/close.png" /></a>
							</div>
							<img src="" />
						</div>
					</div>
					
					<p style="color: #999; font-size: 11px;"></p>
					<a href="#" class="openform"><button class="btn btn-primary float-right" >Exit</button></a>
					<a href="#" class="openform"><button class="btn btn-primary float-right" type="submit" style="margin-right:10px;">Save &amp; Exit</button></a>
					
			</div>
		</div>
	</div>

</div>

<script>
 $( ".datetime" ).datepicker({ dateFormat: "DD, d MM, yy"});
</script>