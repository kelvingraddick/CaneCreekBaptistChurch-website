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
	<title><?php echo $site_name ?> - Home Page Settings</title>
	
	<link rel="stylesheet" href="http://canecreekbaptistchurchga.org/admin/css/tictail/tt-uikit-0.11.0.min.css">
</head>
<body>
	<div class="app-container" style="max-width:100%;">
		<?php include '../navigation.php'; ?>
	
		<header>
		  <h3>Home Page Settings</h3>
		</header>	
	
		<form class="form-grouped" action="submit.php" method="post" enctype="multipart/form-data" data-validate>		
		  <fieldset>
			<legend>Presentation Section</legend>
			<div class="row form-group" style="display:none;">
			  <div class="col-md-3 col-xs-8">
				<label>Background Image 1</label>
				<img style="width:100%;" src="<?php if($setting['home_page_background1'] <> "" && $setting['home_page_background1'] <> "none") { echo 'http://'.$_SERVER['SERVER_NAME'].$setting['home_page_background1']; } ?>" />
				<input class="form-control" type="file" name="file[]">
				<input class="form-control" type="hidden" name="home_page_background1" <?php echo 'value="'.$setting['home_page_background1'].'"'; ?>>
			  </div>
			  <div class="col-md-3 col-xs-8">
				<label>Background Image 2</label>
				<img style="width:100%;" src="<?php if($setting['home_page_background2'] <> "" && $setting['home_page_background2'] <> "none") { echo 'http://'.$_SERVER['SERVER_NAME'].$setting['home_page_background2']; } ?>" />
				<input class="form-control" type="file" name="file[]">
				<input class="form-control" type="hidden" name="home_page_background2" <?php echo 'value="'.$setting['home_page_background2'].'"'; ?>>
			  </div>
			  <div class="col-md-3 col-xs-8">
				<label>Background Image 3</label>
				<img style="width:100%;" src="<?php if($setting['home_page_background3'] <> "" && $setting['home_page_background3'] <> "none") { echo 'http://'.$_SERVER['SERVER_NAME'].$setting['home_page_background3']; } ?>" />
				<input class="form-control" type="file" name="file[]">
				<input class="form-control" type="hidden" name="home_page_background3" <?php echo 'value="'.$setting['home_page_background3'].'"'; ?>>
			  </div>
			  <div class="col-md-3 col-xs-8">
				<label>Background Image 4</label>
				<img style="width:100%;" src="<?php if($setting['home_page_background4'] <> "" && $setting['home_page_background4'] <> "none") { echo 'http://'.$_SERVER['SERVER_NAME'].$setting['home_page_background4']; } ?>" />
				<input class="form-control" type="file" name="file[]">
				<input class="form-control" type="hidden" name="home_page_background4" <?php echo 'value="'.$setting['home_page_background4'].'"'; ?>>
			  </div>
			</div>
			<div class="row form-group">
			  <div class="col-md-12 col-xs-12">
				<label>Slogan</label>
				<input class="form-control" type="text" name="slogan" <?php echo 'value="'.$setting['slogan'].'"'; ?> required>
			  </div>
			</div>
			<div class="row form-group">
			  <div class="col-md-12 col-xs-12">
				<label>Pitch</label>
				<input class="form-control" type="text" name="pitch" <?php echo 'value="'.$setting['pitch'].'"'; ?> required>
			  </div>
			</div>
		  </fieldset>
		  <fieldset>
			<legend>Features Section</legend>
			<div class="row form-group">
			  <div class="col-md-3 col-xs-8">
				<label>1st Feature Photo</label>
				<img style="width:100%;" src="<?php if($setting['feature1_photo'] <> "" && $setting['feature1_photo'] <> "none") { echo 'http://'.$_SERVER['SERVER_NAME'].$setting['feature1_photo']; } ?>" />
				<input class="form-control" type="file" name="file[]">
				<input class="form-control" type="hidden" name="feature1_photo" <?php echo 'value="'.$setting['feature1_photo'].'"'; ?>>
			  </div>
			</div>
			<div class="row form-group">
			  <div class="col-md-12 col-xs-12">
				<label>1st Feature Title</label>
				<input class="form-control" type="text" name="feature1_title" <?php echo 'value="'.$setting['feature1_title'].'"'; ?> required>
			  </div>
			</div>
			<div class="row form-group">
			  <div class="col-md-12 col-xs-12">
				<label>1st Feature Description</label>
				<input class="form-control" type="text" name="feature1_description" <?php echo 'value="'.$setting['feature1_description'].'"'; ?> required>
			  </div>
			</div>
			<div class="row form-group">
			  <div class="col-md-3 col-xs-8">
				<label>2nd Feature Photo</label>
				<img style="width:100%;" src="<?php if($setting['feature2_photo'] <> "" && $setting['feature2_photo'] <> "none") { echo 'http://'.$_SERVER['SERVER_NAME'].$setting['feature2_photo']; } ?>" />
				<input class="form-control" type="file" name="file[]">
				<input class="form-control" type="hidden" name="feature2_photo" <?php echo 'value="'.$setting['feature2_photo'].'"'; ?>>
			  </div>
			</div>
			<div class="row form-group">
			  <div class="col-md-12 col-xs-12">
				<label>2nd Feature Title</label>
				<input class="form-control" type="text" name="feature2_title" <?php echo 'value="'.$setting['feature2_title'].'"'; ?> required>
			  </div>
			</div>
			<div class="row form-group">
			  <div class="col-md-12 col-xs-12">
				<label>2nd Feature Description</label>
				<input class="form-control" type="text" name="feature2_description" <?php echo 'value="'.$setting['feature2_description'].'"'; ?> required>
			  </div>
			</div>
			<div class="row form-group">
			  <div class="col-md-3 col-xs-8">
				<label>Feature 3 Photo</label>
				<img style="width:100%;" src="<?php if($setting['feature3_photo'] <> "" && $setting['feature3_photo'] <> "none") { echo 'http://'.$_SERVER['SERVER_NAME'].$setting['feature3_photo']; } ?>" />
				<input class="form-control" type="file" name="file[]">
				<input class="form-control" type="hidden" name="feature3_photo" <?php echo 'value="'.$setting['feature3_photo'].'"'; ?>>
			  </div>
			</div>
			<div class="row form-group">
			  <div class="col-md-12 col-xs-12">
				<label>Feature 3 Title</label>
				<input class="form-control" type="text" name="feature3_title" <?php echo 'value="'.$setting['feature3_title'].'"'; ?> required>
			  </div>
			</div>
			<div class="row form-group">
			  <div class="col-md-12 col-xs-12">
				<label>Feature 3 Description</label>
				<input class="form-control" type="text" name="feature3_description" <?php echo 'value="'.$setting['feature3_description'].'"'; ?> required>
			  </div>
			</div>
		  </fieldset>
		  <fieldset>
			<legend>Pastor</legend>
			<div class="row form-group">
			  <div class="col-md-3 col-xs-8">
				<label>Photo</label>
				<img style="width:100%;" src="<?php if($setting['testimonial1_photo'] <> "" && $setting['testimonial1_photo'] <> "none") { echo 'http://'.$_SERVER['SERVER_NAME'].$setting['testimonial1_photo']; } ?>" />
				<input class="form-control" type="file" name="file[]">
				<input class="form-control" type="hidden" name="testimonial1_photo" <?php echo 'value="'.$setting['testimonial1_photo'].'"'; ?>>
			  </div>
			</div>
			<div class="row form-group">
			  <div class="col-md-12 col-xs-12">
				<label>Title</label>
				<input class="form-control" type="text" name="testimonial1_name" <?php echo 'value="'.$setting['testimonial1_name'].'"'; ?> required>
			  </div>
			</div>
			<div class="row form-group">
			  <div class="col-md-12 col-xs-12">
				<label>From the Pastor's Deck</label>
				<textarea class="form-control wysiwyg" name="testimonial1_quote" id="testimonial1_quote" rows="5"><?php echo $setting['testimonial1_quote']; ?></textarea>
			  </div>
			</div>
			<div class="row form-group">
			  <div class="col-md-12 col-xs-12">
				<label>Biography</label>
				<textarea class="form-control wysiwyg" name="testimonial2_quote" id="testimonial2_quote" rows="5"><?php echo $setting['testimonial2_quote']; ?></textarea>
			  </div>
			</div>
			<!--
			<div class="row form-group">
			  <div class="col-md-3 col-xs-8">
				<label>2nd Advertisement Photo</label>
				<img style="width:100%;" src="<?php if($setting['testimonial2_photo'] <> "" && $setting['testimonial2_photo'] <> "none") { echo 'http://'.$_SERVER['SERVER_NAME'].$setting['testimonial2_photo']; } ?>" />
				<input class="form-control" type="file" name="file[]">
				<input class="form-control" type="hidden" name="testimonial2_photo" <?php echo 'value="'.$setting['testimonial2_photo'].'"'; ?>>
			  </div>
			</div>
			<div class="row form-group">
			  <div class="col-md-12 col-xs-12">
				<label>2nd Advertisement Link</label>
				<input class="form-control" type="text" name="testimonial2_quote" <?php echo 'value="'.$setting['testimonial2_quote'].'"'; ?> required>
			  </div>
			</div>
			<div class="row form-group">
			  <div class="col-md-12 col-xs-12">
				<label>2nd Advertisement Name</label>
				<input class="form-control" type="text" name="testimonial2_name" <?php echo 'value="'.$setting['testimonial2_name'].'"'; ?> required>
			  </div>
			</div>
			<div class="row form-group">
			  <div class="col-md-3 col-xs-8">
				<label>3rd Advertisement Photo</label>
				<img style="width:100%;" src="<?php if($setting['testimonial3_photo'] <> "" && $setting['testimonial3_photo'] <> "none") { echo 'http://'.$_SERVER['SERVER_NAME'].$setting['testimonial3_photo']; } ?>" />
				<input class="form-control" type="file" name="file[]">
				<input class="form-control" type="hidden" name="testimonial3_photo" <?php echo 'value="'.$setting['testimonial3_photo'].'"'; ?>>
			  </div>
			</div>
			<div class="row form-group">
			  <div class="col-md-12 col-xs-12">
				<label>3rd Advertisement Link</label>
				<input class="form-control" type="text" name="testimonial3_quote" <?php echo 'value="'.$setting['testimonial3_quote'].'"'; ?> required>
			  </div>
			</div>
			<div class="row form-group">
			  <div class="col-md-12 col-xs-12">
				<label>3rd Advertisement Name</label>
				<input class="form-control" type="text" name="testimonial3_name" <?php echo 'value="'.$setting['testimonial3_name'].'"'; ?> required>
			  </div>
			</div>
			-->
		  </fieldset>
		  <div class="form-actions">
			<a href="../products/" class="btn btn-danger">Cancel</a>
			<button type="submit" class="btn btn-primary">Save</button>
		  </div>
		</form>
		
		<br /><br />
		
	<script src="http://code.jquery.com/jquery-1.10.1.min.js"></script>
	<script src="http://canecreekbaptistchurchga.org/admin/js/tictail/tt-uikit-0.11.0.min.js"></script>  
	<script src="http://canecreekbaptistchurchga.org/admin/js/tictail/tt.js"></script>  
</body>
</html>