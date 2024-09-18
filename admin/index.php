<?php
	include $_SERVER['DOCUMENT_ROOT'].'/admin/utility/configuration.php';
	include $_SERVER['DOCUMENT_ROOT'].'/admin/utility/functions.php';
	$c = connect_to_database();

	$session = $_COOKIE['email'].$_SERVER["REMOTE_ADDR"];
	//echo $session."<br />";
	if(mysqli_num_rows(mysqli_query($c, "SELECT * FROM `users` WHERE session='$session'"))){
		header("location:login.php");
	}

	$error = $_GET['error'];
	$email = $_GET['email'];
	$password = $_GET['password'];
?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title><?php echo $site_name ?> - Administration Panel</title>
	
	<link rel="stylesheet" href="http://canecreekbaptistchurchga.org/admin/css/tictail/tt-uikit-0.11.0.min.css">
</head>
<body>
	<div class="app-container">
		<header>
		  <a href="http://www.wavelinkllc.com"><img style="height:100px;" src="http://www.wavelinkllc.com/images/WaveLink_Logo.png" alt="Wave Link, LLC - High-Quality Mobile Apps, Websites, & Graphics" /></a>
		  <h1>Administration Panel</h1>
		</header>
		<form id="login_form" class="form-grouped" action="login.php" method="post" data-validate>
		  <fieldset>
			  <legend>Login</legend>
			  <div class="form-group">
				 <label for="email">Email</label>
				 <input class="form-control" type="text" name="email" id="email" minlength="2" <?php echo 'value="'.$email.'"'; ?> required>
			  </div>
			  <div class="form-group">
				 <label for="password">Password</label>
				 <input class="form-control" type="password" name="password" id="password" minlength="2" <?php echo 'value="'.$password.'"'; ?> required>
			  </div>
		  </fieldset>
		  <div class="form-actions">
		  	<?php if($error == "yes") { echo '<span style="color:#e74c3c;">The username/password entered are incorrect. Please try again! &nbsp;</span>'; } ?>
			<!--<a class="btn btn-link">Forgot password?</a>-->
			<input type="submit" value="Login" class="btn btn-primary">
		  </div>
		</form>
	</div>
	
	<script src="http://code.jquery.com/jquery-1.10.1.min.js"></script>  
	<script src="http://canecreekbaptistchurchga.org/admin/js/tictail/tt-uikit-0.11.0.min.js"></script>  
	<script src="http://canecreekbaptistchurchga.org/admin/js/tictail/tt.js"></script>
</body>
</html>