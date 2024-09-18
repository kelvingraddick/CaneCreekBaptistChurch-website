<?php
	include $_SERVER['DOCUMENT_ROOT'].'/utility/configuration.php';
	include $_SERVER['DOCUMENT_ROOT'].'/utility/functions.php';
	include $_SERVER['DOCUMENT_ROOT'].'/utility/Mobile_Detect.php';
	$c = connect_to_database();
	$setting = get_settings($c, "SELECT * FROM settings");
	$seo = get_seo($c, "comingsoon");
	$metatags = build_metatags($seo, $setting); 
	$detect = new Mobile_Detect; 
	
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php 
		echo $metatags; 
		include '../css/main.php'; 
	?>
</head>
<body>
	<?php include $_SERVER['DOCUMENT_ROOT'].'/header.php'; ?>
	<div class="container">
		<div class="row">
			<div class="col-xs-12 col-md-12 live_div">
				<div class="title text-uppercase"><i class="fa fa-exclamation"></i>&nbsp;&nbsp;This page is coming soon!</div>
			</div>
		</div>
		<div class="row">
			<div class="col-xs-12 col-md-12">
				<br />
			</div>
		</div>
	</div>
	<?php include $_SERVER['DOCUMENT_ROOT'].'/footer.php'; ?>
	<?php include '../js/main.php'; ?>
</body>
</html>