<?php
	include $_SERVER['DOCUMENT_ROOT'].'/admin/authentication.php';
	include $_SERVER['DOCUMENT_ROOT'].'/admin/utility/configuration.php';
	include $_SERVER['DOCUMENT_ROOT'].'/admin/utility/functions.php';
	$c = connect_to_database();
	$id = $_GET['id'];
	$result = mysqli_query($c, "SELECT * FROM stores WHERE id = '$id'");
	if (!$result) {
		echo 'Could not find store by the id specified.'; exit;
	}
	$u = mysqli_fetch_assoc($result);
?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title><?php echo $site_name ?> - Add/Edit location</title>
	
	<link rel="stylesheet" href="http://canecreekbaptistchurchga.org/admin/css/tictail/tt-uikit-0.11.0.min.css">
</head>
<body>
	<div class="app-container" style="max-width:100%;">
		<?php include '../navigation.php'; ?>
	
		<header>
		  <a href="../stores/" class="btn btn-link">&larr; Go back to locations</a>
		  <h3>
		  	<?php
				if($id == "") {
					echo "Add New Location";
				} else {
					echo "Edit Location";
				}
			?>
		  </h3>
		</header>	
	
		<form class="form-grouped" action="submit.php" method="post" enctype="multipart/form-data" data-validate>
		  <?php if($id <> "") { echo '<input type="hidden" name="id" value="'.$u["id"].'" />'; } ?>			
		  <fieldset>
			<legend>Details</legend>
			<div class="row form-group">
			  <div class="col-md-6 col-xs-12">
				<label>Name</label>
				<input class="form-control" type="text" name="name" <?php echo 'value="'.$u["name"].'"'; ?> required>
			  </div>
			  <div class="col-md-6 col-xs-12">
				<label>Phone</label>
				<input class="form-control" type="text" name="phone" <?php echo 'value="'.$u["phone"].'"'; ?> required>
			  </div>
			</div>
			<div class="row form-group">
			  <div class="col-md-12 col-xs-12">
				<label>Description</label>
				<textarea class="form-control wysiwyg" name="description" id="description" rows="5"><?php echo $u["description"]; ?></textarea>
			  </div>
			</div>
			<div class="col-md-3 col-xs-3">
				<label>Photo</label>
				<img style="width:100%;" src="<?php if($u["photo"] <> "" && $u["photo"] <> "none") { echo 'http://'.$_SERVER['SERVER_NAME'].$u["photo"]; } ?>" />
				<input class="form-control" type="file" name="file[]">
				<input class="form-control" type="hidden" name="photo" <?php echo 'value="'.$u["photo"].'"'; ?>>
			</div>
		  </fieldset>
		  <fieldset>
			<legend>Address</legend>
			<div class="row form-group">
			  <div class="col-md-12 col-xs-12">
				<label>Address 1</label>
				<input class="form-control" type="text" name="address1" <?php echo 'value="'.$u["address1"].'"'; ?> required>
			  </div>
			</div>
			<div class="row form-group">
			  <div class="col-md-12 col-xs-12">
				<label>Address 2</label>
				<input class="form-control" type="text" name="address2" <?php echo 'value="'.$u["address2"].'"'; ?>>
			  </div>
			</div>
			<div class="row form-group">
			  <div class="col-md-4 col-xs-12">
				<label>City</label>
				<input class="form-control" type="text" name="city" <?php echo 'value="'.$u["city"].'"'; ?> required>
			  </div>
			  <div class="col-md-4 col-xs-12">
				<label>State</label>
				<input class="form-control" type="text" name="state" <?php echo 'value="'.$u["state"].'"'; ?> required>
			  </div>
			  <div class="col-md-4 col-xs-12">
				<label>Zip</label>
				<input class="form-control" type="text" name="zip" <?php echo 'value="'.$u["zip"].'"'; ?> required>
			  </div>
			</div>
		  </fieldset>
		  <!--
		  <fieldset>
			<legend>Hours</legend>
			<div class="row form-group">
			  <div class="col-md-4 col-xs-12">
				<label>Monday - Friday</label>
				<input class="form-control" type="text" name="weekday_hours" <?php echo 'value="'.$u["weekday_hours"].'"'; ?>>
			  </div>
			  <div class="col-md-4 col-xs-12">
				<label>Saturday</label>
				<input class="form-control" type="text" name="saturday_hours" <?php echo 'value="'.$u["saturday_hours"].'"'; ?>>
			  </div>
			  <div class="col-md-4 col-xs-12">
				<label>Sunday</label>
				<input class="form-control" type="text" name="sunday_hours" <?php echo 'value="'.$u["sunday_hours"].'"'; ?>>
			  </div>
			</div>
		  </fieldset>
		  -->
		  <div class="form-actions">
			<a href="../stores/" class="btn btn-danger">Cancel</a>
			<button type="submit" class="btn btn-primary">Save</button>
		  </div>
		</form>
		
		<br /><br />
		
	<script src="http://code.jquery.com/jquery-1.10.1.min.js"></script>
	<script src="http://canecreekbaptistchurchga.org/admin/js/tictail/tt-uikit-0.11.0.min.js"></script>  
	<script src="http://canecreekbaptistchurchga.org/admin/js/tictail/tt.js"></script>  
</body>
</html>