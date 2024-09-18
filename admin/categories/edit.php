<?php
	include $_SERVER['DOCUMENT_ROOT'].'/admin/authentication.php';
	include $_SERVER['DOCUMENT_ROOT'].'/admin/utility/configuration.php';
	include $_SERVER['DOCUMENT_ROOT'].'/admin/utility/functions.php';
	$c = connect_to_database();
	$id = $_GET['id'];
	$result = mysqli_query($c, "SELECT * FROM categories WHERE id = '$id'");
	if (!$result) {
		echo 'Could not find category by the id specified.'; exit;
	}
	$u = mysqli_fetch_assoc($result);
?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title><?php echo $site_name ?> - Add/Edit Category</title>
	
	<link rel="stylesheet" href="http://canecreekbaptistchurchga.org/admin/css/tictail/tt-uikit-0.11.0.min.css">
</head>
<body>
	<div class="app-container" style="max-width:100%;">
		<?php include '../navigation.php'; ?>
	
		<header>
		  <a href="../categories/" class="btn btn-link">&larr; Go back to categories</a>
		  <h3>
		  	<?php
				if($id == "") {
					echo "Add New Category";
				} else {
					echo "Edit Category";
				}
			?>
		  </h3>
		</header>	
	
		<form class="form-grouped" action="submit.php" method="post" enctype="multipart/form-data" data-validate>
		  <?php if($id <> "") { echo '<input type="hidden" name="id" value="'.$u["id"].'" />'; } ?>			
		  <fieldset>
			<legend>Details</legend>
			<div class="row form-group">
			  <div class="col-md-12 col-xs-12">
				<label>Name</label>
				<input class="form-control" type="text" name="name" <?php echo 'value="'.$u["name"].'"'; ?> required>
			  </div>
			</div>
			<div class="row form-group">
			  <div class="col-md-12 col-xs-12">
				<label>Value</label>
				<input class="form-control" type="text" name="value" <?php echo 'value="'.$u["value"].'"'; ?> required>
			  </div>
			</div>
			<div class="row form-group">
			  <div class="col-md-12 col-xs-12">
				<label>Description</label>
				<textarea class="form-control" name="description" id="description" rows="5"><?php echo $u["description"]; ?></textarea>
			  </div>
			</div>
			<div class="row form-group">
			  <div class="col-md-12 col-xs-12">
				<label>URL</label>
				<input class="form-control" type="text" name="url" <?php echo 'value="'.$u["url"].'"'; ?>>
			  </div>
			</div>
			<div class="row form-group">
			  <div class="col-md-3 col-xs-3">
				<label>Image</label>
				<img style="width:100%;" src="<?php if($u["image"] <> "" && $u["image"] <> "none") { echo 'http://'.$_SERVER['SERVER_NAME'].$u["image"]; } ?>" />
				<input class="form-control" type="file" name="file[]">
				<input class="form-control" type="hidden" name="image" <?php echo 'value="'.$u["image"].'"'; ?>>
			  </div>
			  <div class="col-md-4 col-xs-4">
				<label>Type</label>
				<select name="type">
					<option value="none" <?php echo ($u["type"] == "none" ? "selected" : ""); ?>>None</option>
					<option value="phone" <?php echo ($u["type"] == "phone" ? "selected" : ""); ?>>Phone</option>
					<option value="tablet" <?php echo ($u["type"] == "tablet" ? "selected" : ""); ?>>Tablet</option>
					<option value="carrier" <?php echo ($u["type"] == "carrier" ? "selected" : ""); ?>>Carrier</option>
					<option value="manufacturer" <?php echo ($u["type"] == "manufacturer" ? "selected" : ""); ?>>Manufacturer</option>
					<option value="accessory" <?php echo ($u["type"] == "accessory" ? "selected" : ""); ?>>Accessory</option>
					<option value="part" <?php echo ($u["type"] == "part" ? "selected" : ""); ?>>Part</option>
				</select>
			  </div>
			  <div class="col-md-2 col-xs-2">
				<label>Featured?</label><br />
			    <div class="switch">
				 <input name="featured" type="checkbox" <?php if($u["featured"] == "yes") { echo 'checked'; } ?>>
			    </div>
			  </div>
			</div>
		  </fieldset>
		  <div class="form-actions">
			<a href="../categories/" class="btn btn-danger">Cancel</a>
			<button type="submit" class="btn btn-primary">Save</button>
		  </div>
		</form>
		
		<br /><br />
		
	<script src="http://code.jquery.com/jquery-1.10.1.min.js"></script>
	<script src="http://canecreekbaptistchurchga.org/admin/js/tictail/tt-uikit-0.11.0.min.js"></script>  
	<script src="http://canecreekbaptistchurchga.org/admin/js/tictail/tt.js"></script>  
</body>
</html>