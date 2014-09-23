<?php 
include('head.php');
include 'includes/connect.php';
?> 

<div class="row">
	<div class="col-lg-4">
		<div class="panel panel-primary">
			<div class="panel-heading">
				<h3 class="panel-title"><i class="fa fa-barcode"></i> Scanners</h3>
			</div>
			<div class="panel-body">  
				<table>
					<tr>
						<th>Scanner Name</th>
						<th>Scanner Serial Number</th>
						<th>Model Number</th>
						<th>Service Date and Time</th>
					</tr>
					<?php
						$scannerQuery = mysqli_query($connection,"SELECT * FROM Scanners ORDER BY dInService DESC");
						while($scannerView = mysqli_fetch_assoc($scannerQuery)) {
					?>
					<tr>
						<td><?php echo $scannerView['vScannerName']; ?></td>
						<td><?php echo $scannerView['vScannerSerialNum']; ?></td>
						<td><?php echo $scannerView['vModelNumber']; ?></td>
						<td><?php echo $scannerView['dInService']; ?></td>
						<td><a href="http://wis-helpdesk.com/map/editScanner.php?id=<?php echo $scannerView['iScannerID']; ?>">edit</a></td>
					</tr>
					<?php 
					}
					?>
				</table>
			</div>
		</div>
	</div>
</div>
