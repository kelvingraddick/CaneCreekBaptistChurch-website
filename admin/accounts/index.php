<?php
	include $_SERVER['DOCUMENT_ROOT'].'/admin/authentication.php';
	include $_SERVER['DOCUMENT_ROOT'].'/admin/utility/configuration.php';
	include $_SERVER['DOCUMENT_ROOT'].'/admin/utility/functions.php';
	$c = connect_to_database();
	$search = $_POST['search'];
?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title><?php echo $site_name ?> - Accounts</title>
	
	<link rel="stylesheet" href="http://canecreekbaptistchurchga.org/admin/css/tictail/tt-uikit-0.11.0.min.css">
</head>
<body>
	<div class="app-container" style="max-width:100%;">
		<?php include '../navigation.php'; ?>
		
		<h3>Accounts</h3>
	
		<form class="form-inline row" method="post">
			<div class="col-xs-8 col-md-11">
				<?php 
					if($search == "") {
						echo "<input name=\"search\" type=\"search\" placeholder=\"Search accounts\" class=\"form-control\">";
					} else {
						echo "<input name=\"search\" type=\"search\" placeholder=\"Search accounts\" class=\"form-control\" value=\"".$search."\">";
					}
				?>
			</div>
			<div class="col-xs-4 col-md-1">
				<button type="submit" class="btn btn-default">Search</button>
			</div>
		</form>
		
		<a href="edit.php" class="btn btn-default"><b>+</b> Add new account</a>
		
		<table class="table table-striped">
			<thead>
				<tr>
					<th>Id</th>
					<th>Contact</th>
					<th>Email</th>
					<th>Password</th>
					<th>Status</th>
					<th>Product</th>
					<th>Dates</th>
					<th>File URL</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
				<?php
					$query = "SELECT accounts.id AS id, business_name, first_name, last_name, phone, email, password, status, products.title AS product_title, sign_up_date, last_payment_date, file_url 
							  FROM `accounts` LEFT JOIN `products` ON accounts.product_id = products.id";
					if($search <> "") {
						$search = "%".$search."%";
						$query = $query." WHERE 
							accounts.id LIKE '$search' OR 
							business_name LIKE '$search' OR 
							first_name LIKE '$search' OR 
							last_name LIKE '$search' OR 
							email LIKE '$search' OR 
							phone LIKE '$search' OR
							product_id LIKE '$search'";
					}
					$result = mysqli_query($c, $query); if(!$result) { echo "<br />".mysqli_error($c)."<br />"; }
					while($u = mysqli_fetch_array( $result, MYSQLI_ASSOC )) { 
						echo 
						"<tr>
							<td>".$u["id"]."</td>
							<td>
								".$u["business_name"]."<br />
								".$u["first_name"]." ".$u["last_name"]."<br />
								".$u["phone"]."
							</td>
							<td>".$u["email"]."</td>
							<td>".$u["password"]."</td>
							<td>".$u["status"]."</td>
							<td>".$u["product_title"]."</td>
							<td>
								Sign Up : ".$u["sign_up_date"]."<br />
								Last Payment : ".$u["last_payment_date"]."
							</td>
							<td><a href=\"http://".$_SERVER['SERVER_NAME'].$u["file_url"]."\" target=\"_blank\">".$u["file_url"]."</a></td>
							<td>
								<a href=\"edit.php?id=".$u["id"]."\" class=\"btn btn-default btn-sm\" style=\"display:inline;\">Edit</a>&nbsp;<a href=\"delete.php?id=".$u["id"]."\" class=\"btn btn-danger btn-sm\" style=\"display:inline;\" onclick=\"return confirm('Are you sure you want to delete this?');\">Delete</a>
							</td>
						</tr>";
					}
				?>
			</tbody>
		</table>
		
		<br /><br />
		
	<script src="http://code.jquery.com/jquery-1.10.1.min.js"></script>
	<script src="http://canecreekbaptistchurchga.org/admin/js/tictail/tt-uikit-0.11.0.min.js"></script>  
	<script src="http://canecreekbaptistchurchga.org/admin/js/tictail/tt.js"></script>  
</body>
</html>