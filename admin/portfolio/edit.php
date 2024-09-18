<?php
	include $_SERVER['DOCUMENT_ROOT'].'/admin/authentication.php';
	include $_SERVER['DOCUMENT_ROOT'].'/admin/utility/configuration.php';
	include $_SERVER['DOCUMENT_ROOT'].'/admin/utility/functions.php';
	$c = connect_to_database();
	$id = $_GET['id'];
	$result = mysqli_query($c, "SELECT * FROM portfolio WHERE id = '$id'");
	if (!$result) {
		echo 'Could not find portfolio item by the id specified.'; exit;
	}
	$u = mysqli_fetch_assoc($result);
?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title><?php echo $site_name ?> - Add/Edit Gallery item</title>
	
	<link rel="stylesheet" href="http://canecreekbaptistchurchga.org/admin/css/tictail/tt-uikit-0.11.0.min.css">
</head>
<body>
	<div class="app-container" style="max-width:100%;">
		<?php include '../navigation.php'; ?>
	
		<header>
		  <a href="../portfolio/" class="btn btn-link">&larr; Go back to gallery</a>
		  <h3>
		  	<?php
				if($id == "") {
					echo "Add new Gallery item";
				} else {
					echo "Edit Gallery item";
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
				<label>Title</label>
				<input class="form-control" type="text" name="title" <?php echo 'value="'.$u["title"].'"'; ?> required>
			  </div>
			</div>
			<div class="row form-group">
			  <div class="col-md-12 col-xs-12">
				<label>Description</label>
				<textarea class="form-control" name="description" id="description" rows="5"><?php echo $u["description"]; ?></textarea>
			  </div>
			</div>
		  </fieldset>
		  <fieldset>
			<legend>Images</legend>
			<div class="row form-group">
			  <div class="col-md-3 col-xs-3">
				<label>Image 1</label>
				<img style="width:100%;" src="<?php if($u["image1"] <> "" && $u["image1"] <> "none") { echo 'http://'.$_SERVER['SERVER_NAME'].$u["image1"]; } ?>" />
				<input class="form-control" type="file" name="file[]">
				<input class="form-control" type="hidden" name="image1" <?php echo 'value="'.$u["image1"].'"'; ?>>
			  </div>
			<!--
			  <div class="col-md-3 col-xs-3">
				<label>Image 2</label>
				<img style="width:100%;" src="<?php if($u["image2"] <> "" && $u["image2"] <> "none") { echo 'http://'.$_SERVER['SERVER_NAME'].$u["image2"]; } ?>" />
				<input class="form-control" type="file" name="file[]">
				<input class="form-control" type="hidden" name="image2" <?php echo 'value="'.$u["image2"].'"'; ?>>
			  </div>
			  <div class="col-md-3 col-xs-3">
				<label>Image 3</label>
				<img style="width:100%;" src="<?php if($u["image3"] <> "" && $u["image3"] <> "none") { echo 'http://'.$_SERVER['SERVER_NAME'].$u["image3"]; } ?>" />
				<input class="form-control" type="file" name="file[]">
				<input class="form-control" type="hidden" name="image3" <?php echo 'value="'.$u["image3"].'"'; ?>>
			  </div>
			  <div class="col-md-3 col-xs-3">
				<label>Image 4</label>
				<img style="width:100%;" src="<?php if($u["image4"] <> "" && $u["image4"] <> "none") { echo 'http://'.$_SERVER['SERVER_NAME'].$u["image4"]; } ?>" />
				<input class="form-control" type="file" name="file[]">
				<input class="form-control" type="hidden" name="image4" <?php echo 'value="'.$u["image4"].'"'; ?>>
			  </div>
			</div>
			<div class="row form-group">
			  <div class="col-md-3 col-xs-3">
				<label>Image 5</label>
				<img style="width:100%;" src="<?php if($u["image5"] <> "" && $u["image5"] <> "none") { echo 'http://'.$_SERVER['SERVER_NAME'].$u["image5"]; } ?>" />
				<input class="form-control" type="file" name="file[]">
				<input class="form-control" type="hidden" name="image5" <?php echo 'value="'.$u["image5"].'"'; ?>>
			  </div>
			  <div class="col-md-3 col-xs-3">
				<label>Image 6</label>
				<img style="width:100%;" src="<?php if($u["image6"] <> "" && $u["image6"] <> "none") { echo 'http://'.$_SERVER['SERVER_NAME'].$u["image6"]; } ?>" />
				<input class="form-control" type="file" name="file[]">
				<input class="form-control" type="hidden" name="image6" <?php echo 'value="'.$u["image6"].'"'; ?>>
			  </div>
			  <div class="col-md-3 col-xs-3">
				<label>Image 7</label>
				<img style="width:100%;" src="<?php if($u["image7"] <> "" && $u["image7"] <> "none") { echo 'http://'.$_SERVER['SERVER_NAME'].$u["image7"]; } ?>" />
				<input class="form-control" type="file" name="file[]">
				<input class="form-control" type="hidden" name="image7" <?php echo 'value="'.$u["image7"].'"'; ?>>
			  </div>
			  <div class="col-md-3 col-xs-3">
				<label>Image 8</label>
				<img style="width:100%;" src="<?php if($u["image8"] <> "" && $u["image8"] <> "none") { echo 'http://'.$_SERVER['SERVER_NAME'].$u["image8"]; } ?>" />
				<input class="form-control" type="file" name="file[]">
				<input class="form-control" type="hidden" name="image8" <?php echo 'value="'.$u["image8"].'"'; ?>>
			-->
			</div>
		  </fieldset>
		  <fieldset>
			<legend>Categories</legend>
			<div class="row form-group">
			  	<?php
				  	for($i = 1; $i <= 3; $i++) {
				  		echo '
				  		<div class="col-md-4 col-xs-4">
							<label>Category '.$i.'</label>
							<select name="category'.$i.'">
							<option value="none" '.($u["category$i"] == "" || $u["category$i"] == "none" ? "selected" : "").'>None</option>';
							$categories_result = array();
							$result = mysqli_query($c, "SELECT * FROM categories") or die(mysqli_error());
							while($cat = mysqli_fetch_array( $result, MYSQLI_ASSOC )) { 
								echo '<option value="'.$cat['value'].'" '.($u["category$i"] == $cat['value'] ? "selected" : "").'>'.$cat['name'].'</option>';
							}
						echo '
							</select>
						</div>';
					}
				?>
			</div>
		  </fieldset>
		  <div class="form-actions">
			<a href="../portfolio/" class="btn btn-danger">Cancel</a>
			<button type="submit" class="btn btn-primary">Save</button>
		  </div>
		</form>
		
		<br /><br />
		
	<script src="http://code.jquery.com/jquery-1.10.1.min.js"></script>
	<script src="http://canecreekbaptistchurchga.org/admin/js/tictail/tt-uikit-0.11.0.min.js"></script>  
	<script src="http://canecreekbaptistchurchga.org/admin/js/tictail/tt.js"></script>  
</body>
</html>