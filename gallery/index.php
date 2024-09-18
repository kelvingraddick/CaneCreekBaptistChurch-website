<?php
	include $_SERVER['DOCUMENT_ROOT'].'/utility/configuration.php';
	include $_SERVER['DOCUMENT_ROOT'].'/utility/functions.php';
	include $_SERVER['DOCUMENT_ROOT'].'/utility/Mobile_Detect.php';
	$c = connect_to_database();
	$setting = get_settings($c, "SELECT * FROM settings");
	$seo = get_seo($c, "gallery");
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
			<div class="col-xs-12 col-md-12">
				<div class="title text-uppercase"><i class="fa fa-photo"></i>&nbsp;&nbsp;Gallery</div>
				<?php
					$query = "SELECT * FROM `portfolio`";
					$result = mysqli_query($c, $query) or die(mysqli_error());
					$count = 0;
					while($portfolio = mysqli_fetch_array( $result, MYSQLI_ASSOC )) { 
						if ($count % 4 == 0 && $count != 0) {
							echo "</div><div class=\"row content\">";
						}
						$count++;
						echo
						"<div class=\"col-sm-12 col-md-3\">
							<div class=\"thumbnail\">
							  <a href=\"".$portfolio['image1']."\" data-lightbox=\"Portfolio\" data-title=\"".$portfolio['title']."\"><img src=\"".$portfolio['image1']."\" alt=\"".$portfolio['title']."\"></a>
							  <div class=\"content_panel_title\">".$portfolio['title']."</div>
							  ".$portfolio['description']."
							</div>
						</div>";
					}
				?>
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