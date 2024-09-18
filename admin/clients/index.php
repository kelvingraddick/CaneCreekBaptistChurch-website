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
	<title><?php echo $site_name ?> - Contacts</title>
	
	<link rel="stylesheet" href="http://canecreekbaptistchurchga.org/admin/css/tictail/tt-uikit-0.11.0.min.css">
</head>
<body>
	<div class="app-container" style="max-width:100%;">
		<?php include '../navigation.php'; ?>
		
		<h3>Contacts</h3>
	
		<form class="form-inline row" method="post">
			<div class="col-xs-8 col-md-11">
				<?php 
					if($search == "") {
						echo "<input name=\"search\" type=\"search\" placeholder=\"Search contacts\" class=\"form-control\">";
					} else {
						echo "<input name=\"search\" type=\"search\" placeholder=\"Search contacts\" class=\"form-control\" value=\"".$search."\">";
					}
				?>
			</div>
			<div class="col-xs-4 col-md-1">
				<button type="submit" class="btn btn-default">Search</button>
			</div>
		</form>
		
		<a href="edit.php" class="btn btn-default"><b>+</b> Add new contact</a>
		
		<table class="table table-striped">
			<thead>
				<tr>
					<th>Id</th>
					<th>Contact</th>
					<th>Business</th>
					<th>Description</th>
					<th>Status</th>
					<th>Survey Completed</th>
					<th>Date Added</th>
					<th>Last Contacted</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
				<?php
					$query = "SELECT * FROM `users`";
					if($search <> "") {
						$search = "%".$search."%";
						$query = $query." WHERE 
							id LIKE '$search' OR 
							first_name LIKE '$search' OR 
							last_name LIKE '$search' OR 
							business_name LIKE '$search' OR 
							email LIKE '$search' OR 
							phone LIKE '$search' OR 
							description LIKE '$search' OR
							url LIKE '$search'";
					}
					$result = mysqli_query($c, $query) or die(mysqli_error());
					while($u = mysqli_fetch_array( $result, MYSQLI_ASSOC )) { 
						echo 
						"<tr>
							<td><a href=\"".$u["url"]."\" target=\"_blank\">".$u["id"]."</a></td>
							<td>
								".$u["first_name"]." ".$u["last_name"]."<br />
								".$u["email"]."<br />
								".$u["phone"]."<br />
								<a href=\"".$u["url"]."\" target=\"_blank\">".$u["url"]."</a>
							</td>
							<td>".$u["business_name"]."</td>
							<td>".$u["description"]."</td>
							<td>".$u["status"]."</td>
							<td>".$u["survey_completed"]."</td>
							<td>".$u["date_added"]."</td>
							<td>".$u["date_last_contacted"]."</td>
							<td>
								<a href=\"edit.php?id=".$u["id"]."\" class=\"btn btn-default btn-sm\" style=\"display:inline;\">Edit</a>&nbsp;<a href=\"../contracts/edit.php?user_id=".$u["id"]."\" class=\"btn btn-default btn-sm\" style=\"display:inline;\">Add contract</a>&nbsp;<a href=\"delete.php?id=".$u["id"]."\" class=\"btn btn-danger btn-sm\" style=\"display:inline;\" onclick=\"return confirm('Are you sure you want to delete this?');\">Delete</a>
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