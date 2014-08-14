 <?php /*
session_start();
if(isset($_SESSION['user'])) {
*/
?>

<?php include('head2.php'); ?>
<div id='popup' class='tip-panel' style="width:auto;height:auto;border:#428bca solid 1px;-webkit-border-radius: 3px;-moz-border-radius: 3px;border-radius: 3px;position:fixed;display:none;background-color:white;">
<div id='close' style="float:right;width:20px;height:20px;cursor:pointer;" onClick="$(this).parent().hide();">X</div>
<table>
<tr>
<td>
<input name='roomname' type="text" maxlength="20" style="width:120px"  placeholder="Room Name" >
</td>
</tr>
<tr>
<td>
<select name='scannerid'>
<option>Select Scanner</option>
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
	<article>
		<?php
		$query = mysql_query("SELECT * FROM images WHERE confID = '" . $_GET['confID'] . "' ORDER BY confID ASC");
		$images = mysql_fetch_assoc($query);
		?>
        
		<div id="svgsketch" oncontextmenu="return false" >
		</div>
        X:<span id='Xcoor1'>?</span>
        Y:<span id='Ycoor1'>?</span>
	</article>
	
	<article>
	<form id='requestForm' action='roomsDoAdd.php' method='post'>
		<div id="forms">
		</div>
		<table class='add_domain' name ='submitcol' style='width: 100%;'><tr style='background-color: inherit;'><td clospan='2'><input type='button' name='submit' value='Save'/><input type='button'  value='Load'/></td></tr></table>
	</form>
	</article>

</section>

<?php
/*
} else {
	header("location: login.php");
}*/
mysql_close();
?> 