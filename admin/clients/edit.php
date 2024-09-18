<?php
	include $_SERVER['DOCUMENT_ROOT'].'/admin/authentication.php';
	include $_SERVER['DOCUMENT_ROOT'].'/admin/utility/configuration.php';
	include $_SERVER['DOCUMENT_ROOT'].'/admin/utility/functions.php';
	$c = connect_to_database();
	$id = $_GET['id'];
	$result = mysqli_query($c, "SELECT * FROM users WHERE id = '$id'");
	if (!$result) {
		echo 'Could not find client by the id specified.'; exit;
	}
	$u = mysqli_fetch_assoc($result);
?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title><?php echo $site_name ?> - Add/Edit Contact</title>
	
	<link rel="stylesheet" href="http://canecreekbaptistchurchga.org/admin/css/tictail/tt-uikit-0.11.0.min.css">
</head>
<body>
	<div class="app-container" style="max-width:100%;">
		<?php include '../navigation.php'; ?>
	
		<header>
		  <a href="../clients/" class="btn btn-link">&larr; Go back to contacts</a>
		  <h3>
		  	<?php
				if($id == "") {
					echo "Add New Contact";
				} else {
					echo "Edit Contact";
				}
			?>
		  </h3>
		</header>	
	
		<form class="form-grouped" action="submit.php" method="post" data-validate>
		  <?php if($id <> "") { echo '<input type="hidden" name="id" value="'.$u["id"].'" />'; } ?>			
		  <fieldset>
			<legend>Contact</legend>
			<div class="row form-group">
			  <div class="col-md-6 col-xs-6">
				<label>First Name</label>
				<input class="form-control" type="text" name="first_name" <?php echo 'value="'.$u["first_name"].'"'; ?> required>
				<!--<span class="help-block"></span>-->
			  </div>
			  <div class="col-md-6 col-xs-6">
				<label>Last Name</label>
				<input class="form-control" type="text" name="last_name" <?php echo 'value="'.$u["last_name"].'"'; ?> required>
				<!--<span class="help-block"></span>-->
			  </div>
			</div>
			<div class="row form-group">
			  <div class="col-md-6 col-xs-6">
				<label>Email</label>
				<input class="form-control" type="text" name="email" <?php echo 'value="'.$u["email"].'"'; ?> required>
				<!--<span class="help-block"></span>-->
			  </div>
			  <div class="col-md-6 col-xs-6">
				<label>Phone</label>
				<input class="form-control" type="text" name="phone" <?php echo 'value="'.$u["phone"].'"'; ?> required>
				<!--<span class="help-block"></span>-->
			  </div>
			</div>
			<div class="row form-group">
			  <div class="col-md-12 col-xs-12">
				<label>URL</label>
				<input class="form-control" type="text" name="url" <?php echo 'value="'.$u["url"].'"'; ?> required>
				<!--<span class="help-block"></span>-->
			  </div>
			</div>
		  </fieldset>
		  <fieldset>
			<legend>Description</legend>
			<div class="row form-group">
			  <div class="col-md-12 col-xs-12">
				<label>Business Name</label>
				<input class="form-control" type="text" name="business_name" <?php echo 'value="'.$u["business_name"].'"'; ?> required>
				<span class="help-block">Legal name of the business..</span>
			  </div>
			</div>
			<div class="row form-group">
			  <div class="col-md-12 col-xs-12">
			  	<label>Description</label>
				<input class="form-control" type="text" name="description" <?php echo 'value="'.$u["description"].'"'; ?> required>
				<span class="help-block">Description of what this client/business needs..</span>
			  </div>
			</div>
		  </fieldset>
		  <fieldset>
			<legend>Status</legend>
			<div class="row form-group">
			  <div class="col-md-12 col-xs-12">
				<label>Progress</label>
				<select name="status">
					<option value="hot" <?php if($u["status"] == "hot") { echo 'selected'; } ?>>Hot</option>
					<option value="cold" <?php if($u["status"] == "cold") { echo 'selected'; } ?>>Cold</option>
					<option value="paid" <?php if($u["status"] == "paid") { echo 'selected'; } ?>>Paid</option>
					<option value="unknown" <?php if($u["status"] == "unknown") { echo 'selected'; } ?>>Unknown</option>
				</select>
				<!--<span class="help-block"></span>-->
			  </div>
			</div>
			<div class="row form-group">
				<div class="col-xs-3">
				  <label>Survey Completed?</label>	
				  <div class="switch">
					<input name="survey_completed" type="checkbox"  <?php if($u["survey_completed"] == "yes") { echo 'checked'; } ?>>
				  </div>
				</div>
			</div>
		  </fieldset>
		  <!--
		  <fieldset>
			<legend>Dates</legend>
			<div class="row form-group">
			  <div class="col-md-12 col-xs-12">
				<label>Date Added</label>
				<input type="text" id="date_added" name="date_added">
				<span class="help-block"></span>
			  </div>
			</div>
			<div class="row form-group">
			  <div class="col-md-12 col-xs-12">
				<label>Date Last Contacted</label>
				<input type="text" id="datepicker" required>
				<span class="help-block"></span>
			  </div>
			</div>
		  </fieldset>
		  -->
		  <div class="form-actions">
			<a href="../clients/" class="btn btn-danger">Cancel</a>
			<button type="submit" class="btn btn-primary">Save</button>
		  </div>
		</form>
		
		<br /><br />
		
	<link rel="stylesheet" href="//code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">	
	<script src="http://code.jquery.com/jquery-1.10.1.min.js"></script>
	<script src="//code.jquery.com/ui/1.11.2/jquery-ui.js"></script>
	<script src="http://canecreekbaptistchurchga.org/admin/js/tictail/tt-uikit-0.11.0.min.js"></script>  
	<script src="http://canecreekbaptistchurchga.org/admin/js/tictail/tt.js"></script>  
	<script>
	  $(function() {
		$( "#date_added" ).datepicker();
		//$( "#date_last_contacted" ).datepicker();
	  });
	</script>
</body>
</html>