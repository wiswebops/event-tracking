 <?php /*
session_start();
if(isset($_SESSION['user'])) {
*/
?>
<?php include('head.php'); ?>
<?php include('header.php'); ?>
<section class="main">
	<article>
	<h2>Rooms</h2>
		<table>
        	<thead>
            	<tr style="background-color: inherit;">
                	<td style="font-weight:bold;">Conference ID</td>
                    <td style="font-weight:bold;">Name</td>
					<td style="font-weight:bold;">Scanner ID</td>
					<td style="font-weight:bold;">x</td>
					<td style="font-weight:bold;">y</td>
					<td style="font-weight:bold;">width</td>
					<td style="font-weight:bold;">height</td>
                </tr>
            </thead>
            <tbody class="domain_list">
				<?php
					$query = mysql_query("SELECT * FROM rooms ORDER BY name ASC");
						while($rooms = mysql_fetch_assoc($query)) {
				?>
				<tr>
        			<td><?php echo $rooms['confID']; ?></td>
					<td><?php echo $rooms['name']; ?></td>
					<td><?php echo $rooms['scannerID']; ?></td>
					<td><?php echo $rooms['x']; ?></td>
					<td><?php echo $rooms['y']; ?></td>
					<td><?php echo $rooms['width']; ?></td>
					<td><?php echo $rooms['height']; ?></td>
					<!--<td><a href="addMap.php?confID=<?php echo $rooms['confID']; ?>">edit</a></td>-->
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