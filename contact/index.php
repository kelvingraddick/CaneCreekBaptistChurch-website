<?php
	include $_SERVER['DOCUMENT_ROOT'].'/utility/configuration.php';
	include $_SERVER['DOCUMENT_ROOT'].'/utility/functions.php';
	include $_SERVER['DOCUMENT_ROOT'].'/utility/Mobile_Detect.php';
	$c = connect_to_database();
	$setting = get_settings($c, "SELECT * FROM settings");
	$seo = get_seo($c, "contact");
	$metatags = build_metatags($seo, $setting); 
	$detect = new Mobile_Detect; 
	$result = mysqli_query($c, "SELECT * FROM `stores` LIMIT 1");
	if (!$result) {
		echo 'Could not find store specified.';
	}
	$location = mysqli_fetch_assoc($result);
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
				<div class="title text-uppercase"><i class="fa fa-calendar-o"></i>&nbsp;&nbsp;Contact Us</div>
				<div class="blog_box">
					<div class="blog_header">
						<div class="row">
							<div class="col-xs-12 col-md-4">
								<img class="blog_image" style="float:none; margin-bottom:0px;" src="<?php echo $location['photo']; ?>" />
							</div>
							<div class="col-xs-6 col-md-4">
								<iframe width="300" height="150" frameborder="0" style="border:0" src="https://www.google.com/maps/embed/v1/place?q=<?php echo str_replace(" ", "+", $setting['address1']." ".$setting['address2']." ".$setting['city'].",".$setting['state']." ".$setting['zip']); ?>&key=GOOGLE_MAPS_KEY"></iframe>
							</div>
							<div class="col-xs-6 col-md-4" style="text-align:right; font-size:50px;">
								<i class="fa fa-facebook" onclick="location.href='<?php echo $setting['facebook_link']; ?>';"></i><br />
								<i class="fa fa-twitter" onclick="location.href='<?php echo $setting['twitter_link']; ?>';"></i>
							</div>
						</div>
					</div>
					<div class="blog_content" style="height:auto;">
						<?php echo $location["address1"]; ?><br />
						<?php echo ($location["address2"] <> "" ? $location["address2"]."<br />" : ""); ?>
						<?php echo $location["city"]; ?>&nbsp;<?php echo $location["state"]; ?>&nbsp;<?php echo $location["zip"]; ?><br />
						<?php echo $location["phone"]; ?><br /><br />
						<?php echo $location["description"]; ?><br />
						<b>NEED US TO CONTACT YOU?</b><br /><br />
						<form id="contact_form">
					        Need:&nbsp;&nbsp;
					        <select name="type">
					        	<option value="question">Question</option>
								<option value="prayer request">Prayer request</option>
								<option value="join email list">Join email list</option>
							</select><br />
					        First name:&nbsp;&nbsp; 
					        <input type="input" name="first_name" value="" class="search_box" style="width:25%;" required>&nbsp;<br />
					        Last name:&nbsp;&nbsp; 
					        <input type="input" name="last_name" value="" class="search_box" style="width:25%;" required>&nbsp;<br />
					        Phone:&nbsp;&nbsp; 
					        <input type="input" name="phone" value="" class="search_box group" style="width:25%;">&nbsp;<br />
					        Email:&nbsp;&nbsp; 
					        <input type="input" name="email" value="" class="search_box group" style="width:25%;">&nbsp;<br /><br />
							Message:&nbsp;&nbsp; 
							<textarea name="message" class="search_box" style="height:25%;"></textarea><br />
							<button id="submit_button" type="submit" class="search_box_button text-uppercase" onclick="add_contact(); return false;">Submit</button>
							&nbsp;<span id="response"></span>
						</form>
					</div>
				</div>
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
	<script>
		function add_contact(){
			$( "#submit_button" ).hide();
			$( "#response" ).html( "Loading..." );
			$.post( "../add_contact.php", $( "#contact_form" ).serialize() )
			  .done(function( data ) {
				$( "#response" ).html( data );
			  })
			  .fail(function() {
			  	$( "#response" ).html( "Network error." );
				alert( "There was an network error. Please try again." );
			  })
			  .always(function() {
				$( "#submit_button" ).show();
			  });
		}
	</script>
</body>
</html>