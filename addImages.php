 <?php /*
session_start();
if(isset($_SESSION['user'])) {
*/
?>
<?php include('head.php'); ?>
<?php include('header.php'); ?>
<section class="main">
	<article class="top_main" style="">
		<h2>Add New Conference</h2>
		<span style="color:red;margin-left:10px;font-size:12px;font-style:italic;">* = required</span>
	</article>
	<article class="bottom_main">
		<form id="requestForm" action="imagesDoAdd.php" method="post" enctype="multipart/form-data">
			<div id="p_scents">
				<table class="add_domain" class="p_scnt" style="margin-right: 19px;">
					<tr>
						<td><label for="confID">Conference ID <span style="color:red;">*</span></label></td><td><input type="text" name="confID" /></td>
					</tr>
					<tr>
						<td><label for="fileName">Enter Image</label></td><td><input type="file" name="fileName"  id="fileName"/></td>
					</tr>
					<tr>
						<td><label for="name">Name <span style="color:red;">*</span></label></td><td><input type="text" name="name" /></td>
					</tr>
				</table>
			</div>
			<table class="add_domain" name ="submitcol" style="width: 100%;">
				<tr style="background-color: inherit;">
					<td clospan="2"><input type="submit" name="submit" /></td>
				</tr>
			</table>
		</form>
	</article>
	
	<article>
	<h2>Images</h2>
		<table>
        	<thead>
            	<tr style="background-color: inherit;">
                	<td style="font-weight:bold;">Conference ID</td>
                    <td style="font-weight:bold;">File</td>
					<td style="font-weight:bold;">Name</td>
                </tr>
            </thead>
            <tbody class="domain_list">
				<?php
					$query = mysql_query("SELECT * FROM images ORDER BY name ASC");
						while($images = mysql_fetch_assoc($query)) {
				?>
				<tr>
        			<td><?php echo $images['confID']; ?></td>
					<td><?php echo $images['fileName']; ?></td>
					<td><?php echo $images['name']; ?></td>
                </tr>
				<?php 
					}
				?>
	        </tbody>
    	</table>
	</article>
	
</section>
<?php include('footer.php'); ?>
<?php
/*
} else {
	header("location: login.php");
}*/
mysql_close();
?> 