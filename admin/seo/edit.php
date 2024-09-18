<?php
	include $_SERVER['DOCUMENT_ROOT'].'/admin/authentication.php';
	include $_SERVER['DOCUMENT_ROOT'].'/admin/utility/configuration.php';
	include $_SERVER['DOCUMENT_ROOT'].'/admin/utility/functions.php';
	$c = connect_to_database();
	$id = $_GET['id'];
	$result = mysqli_query($c, "SELECT * FROM seo WHERE id = '$id'");
	if (!$result) {
		echo 'Could not find seo item by the id specified.'; exit;
	}
	$u = mysqli_fetch_assoc($result);
?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title><?php echo $site_name ?> - Edit SEO</title>
	
	<link rel="stylesheet" href="http://canecreekbaptistchurchga.org/admin/css/tictail/tt-uikit-0.11.0.min.css">
</head>
<body>
	<div class="app-container" style="max-width:100%;">
		<?php include '../navigation.php'; ?>
	
		<header>
		  <a href="../seo/" class="btn btn-link">&larr; Go back to SEO</a>
		  <h3>Edit SEO for "<?php echo $u['display']; ?>" page</h3>
		</header>	
	
		<form class="form-grouped" action="submit.php" method="post" enctype="multipart/form-data" data-validate>
		  <?php if($id <> "") { echo '<input type="hidden" name="id" value="'.$u["id"].'" />'; } ?>			
		  <fieldset>
			<legend>Meta Tags</legend>
			<div class="row form-group">
			  <div class="col-md-12 col-xs-12">
				<label>Title</label>
				<input class="form-control" type="text" name="title" <?php echo 'value="'.$u["title"].'"'; ?> required>
			  </div>
			</div>
			<div class="row form-group">
			  <div class="col-md-12 col-xs-12">
				<label>Description</label>
				<input class="form-control" type="text" name="description" <?php echo 'value="'.$u["description"].'"'; ?> required>
			  </div>
			</div>
			<div class="row form-group">
			  <div class="col-md-12 col-xs-12">
				<label>Keywords</label>
				<input class="form-control" type="text" name="keywords" <?php echo 'value="'.$u["keywords"].'"'; ?> required>
			  </div>
			</div>
			<div class="row form-group">
			  <div class="col-md-12 col-xs-12">
				<label>Header</label>
				<textarea class="form-control wysiwyg" name="header" id="header" rows="5"><?php echo $u['header']; ?></textarea>
			  </div>
			</div>
		  </fieldset>
		  <div class="form-actions">
			<a href="../seo/" class="btn btn-danger">Cancel</a>
			<button type="submit" class="btn btn-primary">Save</button>
		  </div>
		</form>
		
		<br /><br />
		
	<script src="http://code.jquery.com/jquery-1.10.1.min.js"></script>
	<script src="http://canecreekbaptistchurchga.org/admin/js/tictail/tt-uikit-0.11.0.min.js"></script>  
	<script src="http://canecreekbaptistchurchga.org/admin/js/tictail/tt.js"></script>  
</body>
</html>