<?php include('head.php'); ?> 

<div class="row">
	<div class="col-lg-4">
		<div class="panel panel-primary">
			<div class="panel-heading">
				<h3 class="panel-title"><i class="fa fa-barcode"></i> Upload New Floor Plan</h3>
			</div>
			<div class="panel-body">  
				<form class="form-newscanner" role="form" enctype="multipart/form-data">
					<input type="text" class="form-control" placeholder="Conference ID" required autofocus>
					
					<p style="color: #999; font-size: 11px;"> </p>
					<input type="text" class="form-control" placeholder="Floor Plan Name" required> 
					
					<p style="color: #999; font-size: 11px;"> </p>
					<input type="file" class="form-control" name="imgName" placeholder="Select Image" required id="imgName"/>
					
					<a href="#" class="openform"><button type="button" class="btn btn-primary float-right" type="submit">Submit</button></a>
				</form>
			</div>
		</div>
	</div>
</div>




<?php
/*
the following needs to be added to the functions.php page
then add this function to the floor plan image function as uploadImage();
also change the $target to the location of the floor plan images folder


function uploadImage() {	
	$target = "../preview_feed/images/"; 
 	$target = $target . basename($_FILES['imgName']['name']) ; 	
 	$ok=1; 
 
// //This is our size condition 
// if ($uploaded_size > 9999999) 
// { 
// echo "Your file is too large.<br>"; 
// $ok=0; 
// } 
// 
// //This is our limit file type condition 
// if ($uploaded_type =="text/php") 
// { 
// echo "No PHP files<br>"; 
// $ok=0; 
// } 
 
 //Here we check that $ok was not set to 0 by an error 
 if ($ok==0) 
 { 
 echo "Sorry your file was not uploaded"; 
 } 
 
 //If everything is ok we try to upload it 
 else 
 { 
 if(move_uploaded_file($_FILES['imgName']['tmp_name'], $target)) 
 { 
 	//this is to copy to other location as well --> copy("../preview_feed/images/" . $_FILES['imgName']['name'], "../" . $_POST['feedName'] . "/images/" . $_FILES['imgName']['name']);
 	//echo "The file " .$target . " has been uploaded<br><br>"; 
 	header("Location: images.php?feedName=" . $_POST['feedName']);
 } 
 else 
 { 
 	//echo "Sorry, there was a problem uploading your file.<br><br>"; 
 	header("Location: images.php?feedName=" . $_POST['feedName']);
 } 
 } 

} 

*/
?>