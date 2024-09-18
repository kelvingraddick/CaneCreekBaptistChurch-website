<?php
	include $_SERVER['DOCUMENT_ROOT'].'/admin/authentication.php';
	include $_SERVER['DOCUMENT_ROOT'].'/admin/utility/configuration.php';
	include $_SERVER['DOCUMENT_ROOT'].'/admin/utility/functions.php';
	$c = connect_to_database();
	$id = $_GET['id'];
	$result = mysqli_query($c, "SELECT * FROM products WHERE id = '$id'");
	if (!$result) {
		echo 'Could not find product by the id specified.'; exit;
	}
	$u = mysqli_fetch_assoc($result);
?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title><?php echo $site_name ?> - Add/Edit Product</title>
	
	<link rel="stylesheet" href="http://canecreekbaptistchurchga.org/admin/css/tictail/tt-uikit-0.11.0.min.css">
	<link rel="stylesheet" type="text/css" href="http://<?php echo $_SERVER['SERVER_NAME']; ?>/admin/css/jquery.datetimepicker.css">
</head>
<body>
	<div class="app-container" style="max-width:100%;">
		<?php include '../navigation.php'; ?>
	
		<header>
		  <a href="../products/" class="btn btn-link">&larr; Go back to products</a>
		  <h3>
		  	<?php
				if($id == "") {
					echo "Add New Product";
				} else {
					echo "Edit Product";
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
			  <div class="col-md-6 col-xs-6">
				<label>Date</label>
				<input id="date" class="form-control" type="text" name="date" <?php echo 'value="'.htmlspecialchars($u["date"]).'"'; ?>>
			  </div>
			  <div class="col-md-6 col-xs-6">
				<label>Time</label>
				<input id="time" class="form-control" type="text" name="time" <?php echo 'value="'.htmlspecialchars($u["time"]).'"'; ?>>
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
			</div>
		  </fieldset>
		  <fieldset>
			<legend>Prices</legend>
			<div class="row form-group">
			  <div class="col-md-4 col-xs-4">
				<label>Price</label>
				<input class="form-control" type="text" name="price" <?php echo 'value="'.$u["price"].'"'; ?> required>
			  </div>
			  <div class="col-md-4 col-xs-4">
				<label>Sale Price</label>
				<input class="form-control" type="text" name="sale_price" <?php echo 'value="'.$u["sale_price"].'"'; ?> required>
			  </div>
			  <div class="col-md-4 col-xs-4">
				<label>Quantity</label>
				<input class="form-control" type="text" name="quantity" <?php echo 'value="'.$u["quantity"].'"'; ?>>
			  </div>
			 </div>
			 <div class="row form-group">
			  <div class="col-md-2 col-xs-2">
				<label>On Sale?</label><br />
			    <div class="switch">
				 <input name="on_sale" type="checkbox" <?php if($u["on_sale"] == "yes") { echo 'checked'; } ?>>
			    </div>
			  </div>
			  <div class="col-md-2 col-xs-2">
				<label>Featured?</label><br />
			    <div class="switch">
				 <input name="featured" type="checkbox" <?php if($u["featured"] == "yes") { echo 'checked'; } ?>>
			    </div>
			  </div>
			</div>
		  </fieldset>
		  <fieldset>
			<legend>Types</legend>
			<div class="row form-group">
			  <div class="col-md-3 col-xs-3">
				<label>Type 1</label>
				<input class="form-control" type="text" name="type1" <?php echo 'value="'.($u["type1"] <> "none" ? $u["type1"] : "").'"'; ?>>
			  </div>
			  <div class="col-md-3 col-xs-3">
				<label>Type 2</label>
				<input class="form-control" type="text" name="type2" <?php echo 'value="'.($u["type2"] <> "none" ? $u["type2"] : "").'"'; ?>>
			  </div>
			  <div class="col-md-3 col-xs-3">
				<label>Type 3</label>
				<input class="form-control" type="text" name="type3" <?php echo 'value="'.($u["type3"] <> "none" ? $u["type3"] : "").'"'; ?>>
			  </div>
			  <div class="col-md-3 col-xs-3">
				<label>Type 4</label>
				<input class="form-control" type="text" name="type4" <?php echo 'value="'.($u["type4"] <> "none" ? $u["type4"] : "").'"'; ?>>
			  </div>
			</div>
			<div class="row form-group">
			  <div class="col-md-3 col-xs-3">
				<label>Type 5</label>
				<input class="form-control" type="text" name="type5" <?php echo 'value="'.($u["type5"] <> "none" ? $u["type5"] : "").'"'; ?>>
			  </div>
			  <div class="col-md-3 col-xs-3">
				<label>Type 6</label>
				<input class="form-control" type="text" name="type6" <?php echo 'value="'.($u["type6"] <> "none" ? $u["type6"] : "").'"'; ?>>
			  </div>
			  <div class="col-md-3 col-xs-3">
				<label>Type 7</label>
				<input class="form-control" type="text" name="type7" <?php echo 'value="'.($u["type7"] <> "none" ? $u["type7"] : "").'"'; ?>>
			  </div>
			  <div class="col-md-3 col-xs-3">
				<label>Type 8</label>
				<input class="form-control" type="text" name="type8" <?php echo 'value="'.($u["type8"] <> "none" ? $u["type8"] : "").'"'; ?>>
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
							<select name="category'.$i.'">';
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
			<a href="../products/" class="btn btn-danger">Cancel</a>
			<button type="submit" class="btn btn-primary">Save</button>
		  </div>
		</form>
		
		<br /><br />
		
	<script src="http://code.jquery.com/jquery-1.10.1.min.js"></script>
	<script src="http://canecreekbaptistchurchga.org/admin/js/tictail/tt-uikit-0.11.0.min.js"></script>  
	<script src="http://canecreekbaptistchurchga.org/admin/js/tictail/tt.js"></script>
	<script src="http://<?php echo $_SERVER['SERVER_NAME']; ?>/admin/js/jquery.datetimepicker.js"></script>
	<script>
		jQuery('#date').datetimepicker({
			timepicker:false,
			format:'m-d-Y'
		});
		jQuery('#time').datetimepicker({
			datepicker:false,
			format:'H:i',
			step:5
		});
	</script>
</body>
</html>