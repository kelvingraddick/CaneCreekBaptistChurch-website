<?php
	include $_SERVER['DOCUMENT_ROOT'].'/admin/authentication.php';
	include $_SERVER['DOCUMENT_ROOT'].'/admin/utility/configuration.php';
	include $_SERVER['DOCUMENT_ROOT'].'/admin/utility/functions.php';
	$c = connect_to_database();
	$id = $_GET['id'];
	$result = mysqli_query($c, "SELECT * FROM issues WHERE id = '$id'");
	if (!$result) {
		echo 'Could not find issue by the id specified.'; exit;
	}
	$u = mysqli_fetch_assoc($result);
?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title><?php echo $site_name ?> - Add/Edit Issue</title>
	
	<link rel="stylesheet" href="http://canecreekbaptistchurchga.org/admin/css/tictail/tt-uikit-0.11.0.min.css">
</head>
<body>
	<div class="app-container" style="max-width:100%;">
		<?php include '../navigation.php'; ?>
	
		<header>
		  <a href="../issues/" class="btn btn-link">&larr; Go back to issues</a>
		  <h3>
		  	<?php
				if($id == "") {
					echo "Add New Issue";
				} else {
					echo "Edit Issue";
				}
			?>
		  </h3>
		</header>	
	
		<form class="form-grouped" action="submit.php" method="post" enctype="multipart/form-data" data-validate>
		  <?php if($id <> "") { echo '<input type="hidden" name="id" value="'.$u["id"].'" />'; } ?>			
		  <fieldset>
			<legend>Details</legend>
			<div class="row form-group">
			  <div class="col-md-3 col-xs-3">
				<label>Issue Number</label>
				<input class="form-control" type="text" name="issue_number" <?php echo 'value="'.$u["issue_number"].'"'; ?> required>
			  </div>
			</div>
			<div class="row form-group">
				<div class="col-md-4 col-xs-4">
					<label>Month</label>
					<select name="month">
				  	<?php
				  		$months = array("January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");
					  	for ($i = 1; $i <= 12; $i++) {
					  		echo '<option value="'.$i.'" '.($i == $u["month"] ? "selected" : "").'>'.date('F', mktime(0, 0, 0, $i, 10)).'</option>';
						}
					?>
					</select>
				</div>
				<div class="col-md-4 col-xs-4">
					<label>Year</label>
					<select name="year">
				  	<?php
					  	for ($i = 2015; $i < intval(date('Y', strtotime('+30 years'))); $i++) {
					  		echo '<option value="'.$i.'" '.($i == $u["year"] ? "selected" : "").'>'.$i.'</option>';
						}
					?>
					</select>
				</div>
			</div>
		  </fieldset>
		  <fieldset>
			<legend>File</legend>
			<div class="row form-group">
			  <div class="col-md-3 col-xs-3">
				<label>PDF</label>
				<?php if($u["pdf_link"] <> "" && $u["pdf_link"] <> "none") { echo '<br /><embed src="http://'.$_SERVER['SERVER_NAME'].'/'.$u["pdf_link"].'" type="application/pdf" width="100" />'; } ?>
				<input class="form-control" type="file" name="file[]">
				<input class="form-control" type="hidden" name="pdf_link" <?php echo 'value="'.$u["pdf_link"].'"'; ?>>
			  </div>
			</div>
		  </fieldset>
		  <div class="form-actions">
			<a href="../issues/" class="btn btn-danger">Cancel</a>
			<button type="submit" class="btn btn-primary">Save</button>
		  </div>
		</form>
		
		<br /><br />
		
	<script src="http://code.jquery.com/jquery-1.10.1.min.js"></script>
	<script src="http://canecreekbaptistchurchga.org/admin/js/tictail/tt-uikit-0.11.0.min.js"></script>  
	<script src="http://canecreekbaptistchurchga.org/admin/js/tictail/tt.js"></script>  
</body>
</html>