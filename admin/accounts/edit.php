<?php
	include $_SERVER['DOCUMENT_ROOT'].'/admin/authentication.php';
	include $_SERVER['DOCUMENT_ROOT'].'/admin/utility/configuration.php';
	include $_SERVER['DOCUMENT_ROOT'].'/admin/utility/functions.php';
	$c = connect_to_database();
	$id = $_GET['id'];
	$result = mysqli_query($c, "SELECT * FROM accounts WHERE id = '$id'");
	if (!$result) {
		echo 'Could not find account by the id specified.'; exit;
	}
	$u = mysqli_fetch_assoc($result);
?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title><?php echo $site_name ?> - Add/Edit Account</title>
	
	<link rel="stylesheet" href="http://canecreekbaptistchurchga.org/admin/css/tictail/tt-uikit-0.11.0.min.css">
</head>
<body>
	<div class="app-container" style="max-width:100%;">
		<?php include '../navigation.php'; ?>
	
		<header>
		  <a href="../accounts/" class="btn btn-link">&larr; Go back to accounts</a>
		  <h3>
		  	<?php
				if($id == "") {
					echo "Add New Account";
				} else {
					echo "Edit Account";
				}
			?>
		  </h3>
		</header>	
	
		<form class="form-grouped" action="submit.php" method="post" enctype="multipart/form-data" data-validate>
		  <?php if($id <> "") { echo '<input type="hidden" name="id" value="'.$u["id"].'" />'; } ?>			
		  <fieldset>
			<legend>Contact</legend>
			<div class="row form-group">
			  <div class="col-md-6 col-xs-6">
				<label>Business Name</label>
				<input class="form-control" type="text" name="business_name" <?php echo 'value="'.$u["business_name"].'"'; ?> required>
			  </div>
			  <div class="col-md-6 col-xs-6">
				<label>Phone</label>
				<input class="form-control" type="text" name="phone" <?php echo 'value="'.$u["phone"].'"'; ?> required>
			  </div>
			</div>
			<div class="row form-group">
			  <div class="col-md-6 col-xs-6">
				<label>First Name</label>
				<input class="form-control" type="text" name="first_name" <?php echo 'value="'.$u["first_name"].'"'; ?> required>
			  </div>
			  <div class="col-md-6 col-xs-6">
				<label>Last Name</label>
				<input class="form-control" type="text" name="last_name" <?php echo 'value="'.$u["last_name"].'"'; ?> required>
			  </div>
			</div>
		  </fieldset>
		  <fieldset>
			<legend>Login Credentials</legend>
		  	<div class="row form-group">
			  <div class="col-md-6 col-xs-6">
				<label>Email</label>
				<input class="form-control" type="email" name="email" <?php echo 'value="'.$u["email"].'"'; ?> required>
			  </div>
			  <div class="col-md-6 col-xs-6">
				<label>Password</label>
				<input class="form-control" type="text" name="password" <?php echo 'value="'.$u["password"].'"'; ?> required>
			  </div>
			</div>
		  </fieldset>
		  <fieldset>
			<legend>Account Status</legend>
			<div class="row form-group">
			  <div class="col-md-4 col-xs-4">
				<label>Status</label>
				<select name="status">
					<option value="active" <?php if($u["status"] == "active") { echo 'selected'; } ?>>Active</option>
					<option value="inactive" <?php if($u["status"] == "inactive") { echo 'selected'; } ?>>Inactive</option>
				</select>
			  </div>
			  <div class="col-md-4 col-xs-4">
				<label>Product Id</label>
				<input class="form-control" type="digits" name="product_id" <?php echo 'value="'.$u["product_id"].'"'; ?> required>
			  </div>
			  <div class="col-md-4 col-xs-4">
				<label>Last Payment Date</label>
				<input class="form-control" type="date" id="last_payment_date" name="last_payment_date" <?php echo 'value="'.$u["last_payment_date"].'"'; ?> required>
			  </div>
			</div>
		  </fieldset>
		  <fieldset>
			<legend>File</legend>
			  <div class="col-md-12 col-xs-12">
			  	<a href="<?php if($u["file_url"] <> "" && $u["file_url"] <> "none") { echo 'http://'.$_SERVER['SERVER_NAME'].$u["file_url"]; } ?>" target=\"_blank\">
				  	<?php if($u["file_url"] <> "" && $u["file_url"] <> "none") { echo $u["file_url"]; } ?>
			  	</a><br /><br />
				<input class="form-control" type="file" name="file[]">
				<input class="form-control" type="hidden" name="file_url" <?php echo 'value="'.$u["file_url"].'"'; ?>>
			  </div>
		  </fieldset>
		  <div class="form-actions">
			<a href="../accounts/" class="btn btn-danger">Cancel</a>
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
	  	$( "#last_payment_date" ).datepicker();
		$( "#last_payment_date" ).datepicker("option", "dateFormat", "yy-mm-dd");
		$( "#last_payment_date" ).datepicker( "setDate", "<?php echo $u["last_payment_date"]; ?>" );
	  });
	</script>
</body>
</html>