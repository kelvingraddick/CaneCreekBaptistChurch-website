<?php
	include $_SERVER['DOCUMENT_ROOT'].'/admin/authentication.php';
	include $_SERVER['DOCUMENT_ROOT'].'/admin/utility/configuration.php';
	include $_SERVER['DOCUMENT_ROOT'].'/admin/utility/functions.php';
	$c = connect_to_database();
	$setting = get_settings($c, "SELECT * FROM settings");
?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title><?php echo $site_name ?> - Settings</title>
	
	<link rel="stylesheet" href="http://canecreekbaptistchurchga.org/admin/css/tictail/tt-uikit-0.11.0.min.css">
</head>
<body>
	<div class="app-container" style="max-width:100%;">
		<?php include '../navigation.php'; ?>
	
		<header>
		  <h3>Settings</h3>
		</header>	
	
		<form class="form-grouped" action="submit.php" method="post" enctype="multipart/form-data" data-validate>		
		  <fieldset>
			<legend>Basic Information</legend>
			<div class="row form-group">
			  <div class="col-md-3 col-xs-8">
				<label>Logo</label>
				<img style="width:100%;" src="<?php if($setting['logo'] <> "" && $setting['logo'] <> "none") { echo 'http://'.$_SERVER['SERVER_NAME'].$setting['logo']; } ?>" />
				<input class="form-control" type="file" name="file[]">
				<input class="form-control" type="hidden" name="logo" <?php echo 'value="'.$setting['logo'].'"'; ?>>
			  </div>
			</div>
			<div class="row form-group">
			  <div class="col-md-6 col-xs-6">
				<label>Phone</label>
				<input class="form-control" type="phone" name="phone" <?php echo 'value="'.$setting['phone'].'"'; ?> required>
			  </div>
			  <div class="col-md-6 col-xs-6">
				<label>Email</label>
				<input class="form-control" type="email" name="email" <?php echo 'value="'.$setting['email'].'"'; ?> required>
			  </div>
			</div>
			<div class="row form-group">
			  <div class="col-md-12 col-xs-12">
				<label>Mission</label>
				<textarea class="form-control wysiwyg" name="aboutus" id="aboutus" rows="5"><?php echo $setting['aboutus']; ?></textarea>
			  </div>
			</div>
		  </fieldset>
		  <fieldset>
			<legend>Address</legend>
			<div class="row form-group">
			  <div class="col-md-6 col-xs-6">
				<label>Address 1</label>
				<input class="form-control" type="text" name="address1" <?php echo 'value="'.$setting['address1'].'"'; ?> required>
			  </div>
			  <div class="col-md-6 col-xs-6">
				<label>Address 2</label>
				<input class="form-control" type="text" name="address2" <?php echo 'value="'.$setting['address2'].'"'; ?>>
			  </div>
			</div>
			<div class="row form-group">
			  <div class="col-md-6 col-xs-6">
				<label>City</label>
				<input class="form-control" type="text" name="city" <?php echo 'value="'.$setting['city'].'"'; ?> required>
			  </div>
			  <div class="col-md-6 col-xs-6">
				<label>State</label>
				<input class="form-control" type="text" name="state" <?php echo 'value="'.$setting['state'].'"'; ?> required>
			  </div>
			  <div class="col-md-6 col-xs-6">
				<label>Zip</label>
				<input class="form-control" type="text" name="zip" <?php echo 'value="'.$setting['zip'].'"'; ?> required>
			  </div>
			</div>
		  </fieldset>
		  <!--
		  <fieldset>
			<legend>Hours</legend>
			<div class="row form-group">
			  <div class="col-md-6 col-xs-6">
				<label>Weekday</label>
				<input class="form-control" type="text" name="hours_weekday" <?php echo 'value="'.$setting['hours_weekday'].'"'; ?> required>
			  </div>
			  <div class="col-md-6 col-xs-6">
				<label>Saturday</label>
				<input class="form-control" type="text" name="hours_saturday" <?php echo 'value="'.$setting['hours_saturday'].'"'; ?> required>
			  </div>
			</div>
			<div class="row form-group">
			  <div class="col-md-6 col-xs-6">
				<label>Sunday</label>
				<input class="form-control" type="text" name="hours_sunday" <?php echo 'value="'.$setting['hours_sunday'].'"'; ?> required>
			  </div>
			</div>
		  </fieldset>
		  -->
		  <fieldset>
			<legend>Marketing</legend>
			<div class="row form-group">
			  <div class="col-md-12 col-xs-12">
				<label>Headline</label>
				<input class="form-control" type="text" name="headline" <?php echo 'value="'.$setting['headline'].'"'; ?>>
			  </div>
			</div>
		  </fieldset>
		  <fieldset>
			<legend>Invoice</legend>
			<div class="row form-group">
			  <div class="col-md-3 col-xs-8">
				<label>Logo</label>
				<img style="width:100%;" src="<?php if($setting['invoice_logo'] <> "" && $setting['invoice_logo'] <> "none") { echo 'http://'.$_SERVER['SERVER_NAME'].$setting['invoice_logo']; } ?>" />
				<input class="form-control" type="file" name="file[]">
				<input class="form-control" type="hidden" name="invoice_logo" <?php echo 'value="'.$setting['invoice_logo'].'"'; ?>>
			  </div>
			</div>
			<div class="row form-group">
			  <div class="col-md-6 col-xs-6">
				<label>Name</label>
				<input class="form-control" type="text" name="invoice_contact_name" <?php echo 'value="'.$setting['invoice_contact_name'].'"'; ?> required>
			  </div>
			  <div class="col-md-6 col-xs-6">
				<label>Title</label>
				<input class="form-control" type="text" name="invoice_contact_title" <?php echo 'value="'.$setting['invoice_contact_title'].'"'; ?> required>
			  </div>
			</div>
			<div class="row form-group">
			  <div class="col-md-6 col-xs-6">
				<label>Phone</label>
				<input class="form-control" type="phone" name="invoice_contact_phone" <?php echo 'value="'.$setting['invoice_contact_phone'].'"'; ?> required>
			  </div>
			  <div class="col-md-6 col-xs-6">
				<label>Email</label>
				<input class="form-control" type="email" name="invoice_contact_email" <?php echo 'value="'.$setting['invoice_contact_email'].'"'; ?> required>
			  </div>
			</div>
		  </fieldset>
		  <fieldset>
			<legend>Receipt</legend>
			<div class="row form-group">
			  <div class="col-md-3 col-xs-8">
				<label>Logo</label>
				<img style="width:100%;" src="<?php if($setting['receipt_logo'] <> "" && $setting['receipt_logo'] <> "none") { echo 'http://'.$_SERVER['SERVER_NAME'].$setting['receipt_logo']; } ?>" />
				<input class="form-control" type="file" name="file[]">
				<input class="form-control" type="hidden" name="receipt_logo" <?php echo 'value="'.$setting['receipt_logo'].'"'; ?>>
			  </div>
			</div>
			<div class="row form-group">
			  <div class="col-md-6 col-xs-6">
				<label>Name</label>
				<input class="form-control" type="text" name="receipt_contact_name" <?php echo 'value="'.$setting['receipt_contact_name'].'"'; ?> required>
			  </div>
			  <div class="col-md-6 col-xs-6">
				<label>Title</label>
				<input class="form-control" type="text" name="receipt_contact_title" <?php echo 'value="'.$setting['receipt_contact_title'].'"'; ?> required>
			  </div>
			</div>
			<div class="row form-group">
			  <div class="col-md-6 col-xs-6">
				<label>Phone</label>
				<input class="form-control" type="phone" name="receipt_contact_phone" <?php echo 'value="'.$setting['receipt_contact_phone'].'"'; ?> required>
			  </div>
			  <div class="col-md-6 col-xs-6">
				<label>Email</label>
				<input class="form-control" type="email" name="receipt_contact_email" <?php echo 'value="'.$setting['receipt_contact_email'].'"'; ?> required>
			  </div>
			</div>
		  </fieldset>
		  <fieldset>
			<legend>Social</legend>
			<div class="row form-group">
			  <div class="col-md-6 col-xs-6">
				<label>Facebook link</label>
				<input class="form-control" type="text" name="facebook_link" <?php echo 'value="'.$setting['facebook_link'].'"'; ?>>
			  </div>
			  <div class="col-md-6 col-xs-6">
				<label>Twitter link</label>
				<input class="form-control" type="text" name="twitter_link" <?php echo 'value="'.$setting['twitter_link'].'"'; ?>>
			  </div>
			</div>
			<div class="row form-group">
			  <div class="col-md-6 col-xs-6">
				<label>LinkedIn link</label>
				<input class="form-control" type="text" name="linkedin_link" <?php echo 'value="'.$setting['linkedin_link'].'"'; ?>>
			  </div>
			  <div class="col-md-6 col-xs-6">
				<label>Google+ link</label>
				<input class="form-control" type="text" name="googleplus_link" <?php echo 'value="'.$setting['googleplus_link'].'"'; ?>>
			  </div>
			</div>
			<div class="row form-group">
			  <div class="col-md-6 col-xs-6">
				<label>Instagram link</label>
				<input class="form-control" type="text" name="instagram_link" <?php echo 'value="'.$setting['instagram_link'].'"'; ?>>
			  </div>
			</div>
		  </fieldset>
		  <div class="form-actions">
			<button type="submit" class="btn btn-primary">Save</button>
		  </div>
		</form>
		
		<br /><br />
		
	<script src="http://code.jquery.com/jquery-1.10.1.min.js"></script>
	<script src="http://canecreekbaptistchurchga.org/admin/js/tictail/tt-uikit-0.11.0.min.js"></script>  
	<script src="http://canecreekbaptistchurchga.org/admin/js/tictail/tt.js"></script>
</body>
</html>