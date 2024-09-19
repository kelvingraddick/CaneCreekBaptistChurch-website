<?php
	include $_SERVER['DOCUMENT_ROOT'].'/utility/configuration.php';
	include $_SERVER['DOCUMENT_ROOT'].'/utility/functions.php';
	include $_SERVER['DOCUMENT_ROOT'].'/utility/Mobile_Detect.php';
	$c = connect_to_database();
	$setting = get_settings($c, "SELECT * FROM settings");
	$seo = get_seo($c, "home");
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
		include 'css/main.php'; 
	?>
</head>
<body>
	<?php include $_SERVER['DOCUMENT_ROOT'].'/header.php'; ?>
	<div class="container">
		<div class="row slideshow">
			<div class="col-xs-12 col-md-12 slideshow_image" style="background-image: url('<?php echo $setting['feature1_photo']; ?>');">
				<div class="presentation_box">
					<div id="presentation_title" class="presentation_title">
						<?php echo $setting['feature1_title']; ?>
					</div>	
					<div id="presentation_subtitle" class="presentation_subtitle">
						<?php echo $setting['feature1_description']; ?>
					</div>
				</div>
				<div class="row presentation_dots">
					<div class="col-xs-4 col-md-4">
						<div id="presentation_dot_1" class="presentation_dot presentation_dot_selected"></div>
					</div>
					<div class="col-xs-4 col-md-4">
						<div id="presentation_dot_2" class="presentation_dot"></div>
					</div>
					<div class="col-xs-4 col-md-4">
						<div id="presentation_dot_3" class="presentation_dot"></div>
					</div>
				</div>
				
			</div>
		</div>
		<div class="row">
			<div class="col-xs-12 col-md-4 live_div">
				<div class="title text-uppercase"><i class="fa fa-twitter" onclick="location.href='<?php echo $setting['twitter_link']; ?>';"></i>&nbsp;&nbsp;Live</div>
				<a class="twitter-timeline" data-height="900" data-theme="light" href="https://twitter.com/YouVersion?ref_src=twsrc%5Etfw">Tweets by YouVersion</a> <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
			</div>
			<div class="col-xs-12 col-md-8 blog_div">
				<div class="title text-uppercase"><i class="fa fa-newspaper-o"></i>&nbsp;&nbsp;News</div>
				<div class="blog_box" style="height: 370px;">
					<div class="blog_header">
						<?php echo $setting['testimonial1_name']; ?>
					</div>
					<div class="blog_content" style="height: 280px;">
						<img class="blog_image" src="<?php echo $setting['testimonial1_photo']; ?>" />
						<?php echo $setting['testimonial1_quote']; ?>
					</div>
					<div class="blog_link" onclick="location.href='http://<?php echo $_SERVER['SERVER_NAME']; ?>/pastor/';">More&nbsp;&nbsp;<i class="fa fa-arrow-right"></i></div>
				</div><br />
				<?php
					$query = "SELECT * FROM `posts` WHERE published = 'yes'";
					if($id <> "") {
						$query = $query." AND id = '$id'";
					}
					$query = $query." ORDER BY date_added DESC";
					$result = mysqli_query($c, $query) or die(mysqli_error());
					while($blog = mysqli_fetch_array( $result, MYSQLI_ASSOC )) { 
						echo 
						"<div class=\"blog_box\">
							<div class=\"blog_header\">
								".$blog['title']." &middot; <i>".$blog['url']."</i>
							</div>
							<div class=\"blog_content\">
								<img class=\"blog_image\" src=\"".$blog['image1']."\" />
								".$blog['content']."
							</div>
						</div><br />";
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
	<?php include 'js/main.php'; ?>
	<script>
		$( document ).ready(function() {
			var images = [<?php echo "'".$setting['feature1_photo']."', '".$setting['feature2_photo']."', '".$setting['feature3_photo']."'"; ?>];
			var titles = [<?php echo "'".$setting['feature1_title']."', '".$setting['feature2_title']."', '".$setting['feature3_title']."'"; ?>];
			var descriptions = [<?php echo "'".$setting['feature1_description']."', '".$setting['feature2_description']."', '".$setting['feature3_description']."'"; ?>];
			var numberOfRotations = 6;
			var count = 0;
			window.setInterval(function(){
				if(numberOfRotations != 0) {
					$('.slideshow_image').fadeTo('slow', 0, function() {
				    	$(this).css('background-image', 'url("'+ images[count] +'")');
					}).fadeTo(400, 1);
					count++;
					$('#presentation_dot_1').removeClass('presentation_dot_selected');
					$('#presentation_dot_2').removeClass('presentation_dot_selected');
					$('#presentation_dot_3').removeClass('presentation_dot_selected');
					if(count == 3) { 
						count = 0; 
					}
					$('#presentation_dot_' + (count + 1).toString()).addClass('presentation_dot_selected');
					$('#presentation_title').html(titles[count]);
					$('#presentation_subtitle').html(descriptions[count]); 
					numberOfRotations--;
				}
			}, 10000);
		});
	</script>
</body>
</html>