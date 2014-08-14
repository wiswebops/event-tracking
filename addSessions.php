 <?php /*
session_start();
if(isset($_SESSION['user'])) {
*/
?>
<?php include('head.php'); ?>
<?php include('header.php'); ?>
<div id='popup' class='tip-panel' style="width:270px;height:auto;border:1px solid #777;position:absolute;display:none;background-color: #ccc;-webkit-border-radius: 15px;
-moz-border-radius: 15px;
border-radius: 15px;">
<div id='close' style="float:right;width:20px;height:20px;" onClick="$(this).parent().hide();">X</div>
<table>
<tr>
<td>Room Name:</td>
<td>
<input name='roomname' type="text" maxlength="20" style="width:120px" >
</td>
</tr>
<tr>
<td>Scanner ID:</td>
<td>
<select name='scannerid'>
<?php
		$query = mysql_query("SELECT vScannerName, iScannerID FROM Scanners ORDER BY iScannerID ASC");
		while ($row = mysql_fetch_object($query))
			echo '<option value="'.$row->iScannerID.'" >'.$row->vScannerName.'</option>';
?>
</select>
</td>
</tr>
</table>
<button id="popupconfirm" style="float:right;">Confirm</button>
</div>
<section class="main">
	<article style="float:left;margin-right: 20px;">
		<?php
		$query = mysql_query("SELECT * FROM images WHERE confID = '" . $_GET['confID'] . "' ORDER BY confID ASC");
		$images = mysql_fetch_assoc($query);
		?>
		<div id="svgsketch1" oncontextmenu="return false">
		<svg version="1.1" width="100%" height="100%">
		<svg x="0" y="0" width="0" height="0" class="svg-graph"></svg>
		<svg x="0" y="0" width="0" height="0" class="svg-plot"></svg>
		<rect x="0" y="0" width="100%" height="100%" id="surface" fill="white"></rect>
		<?php
		$query1 = mysql_query("SELECT * FROM rooms WHERE confID = '" . $_GET['confID'] . "' ORDER BY confID ASC");
		while($rooms = mysql_fetch_assoc($query1)) {
		?>
		<rect x="<?php echo $rooms{'x'} ?>" y="<?php echo $rooms{'y'} ?>" width="<?php echo $rooms{'width'} ?>" height="<?php echo $rooms{'height'} ?>" fill="#FFE3BD" stroke="#FF8300" stroke-width="1" style="fill-opacity: .7;" class="rect1"></rect>
		<?php
		}
		?>
		</svg>
		</div>
	</article>
	
	<article style="float:left;">
	<h2>Rooms</h2>
		<table style="width:400px;">
        	<thead>
            	<tr style="background-color: inherit;">
                    <td style="font-weight:bold;">Room Name</td>
					<td style="font-weight:bold;">Scanner ID</td>
                </tr>
            </thead>
            <tbody class="domain_list">
				<?php
					$query2 = mysql_query("SELECT * FROM rooms WHERE confID = '" . $_GET['confID'] . "' ORDER BY name ASC");
						while($rooms2 = mysql_fetch_assoc($query2)) {
				?>
				<tr class="map">
					<td><?php echo $rooms2['name']; ?></td>
					<td><?php echo $rooms2['scannerID']; ?></td>
					<!--<td><a href="addMap.php?confID=<?php echo $rooms2['confID']; ?>">edit</a></td>-->
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