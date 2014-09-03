<?php define('TITLE', 'WIS | Event Tracking System'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="">
<meta name="author" content="">
<title><?php echo TITLE; ?></title>
<script type="text/javascript" src="js/jquery-1.7.2.js"></script>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.23/jquery-ui.min.js"></script>
<!-- Bootstrap core CSS -->
<link href="css/bootstrap.min.css" rel="stylesheet">
<!-- Add custom CSS here -->
<link href="css/custom.css" rel="stylesheet">
<link href="css/sb-admin.css" rel="stylesheet">
<link href="css/font-awesome.min.css" rel="stylesheet" >
<!-- Page Specific CSS -->
<link rel="stylesheet" href="http://cdn.oesmith.co.uk/morris-0.4.3.min.css">
<link rel="stylesheet" href="css/jquery.fancybox.css" type="text/css" media="screen" />
<link rel="stylesheet" type="text/css" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.23/themes/south-street/jquery-ui.css"/>
<link rel="stylesheet" type="text/css" href="js/jquery.bookmark.css"/>


<script>
$(function() {
		   
$(document).ready(function() {
						  
	$(".various").fancybox({
		maxWidth	: 800,
		maxHeight	: 600,
		fitToView	: false,
		width		: '70%',
		height		: '70%',
		autoSize	: false,
		closeClick	: false,
		openEffect	: 'none',
		closeEffect	: 'none',
		scrolling: 'no',
	});
});	
});

</script>
</head>

<body>
<?php 
$url = $_SERVER['REQUEST_URI'];
?>