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
	<title><?php echo $site_name ?> - Appointments</title>
	
	<link rel="stylesheet" href="http://canecreekbaptistchurchga.org/admin/css/tictail/tt-uikit-0.11.0.min.css">
</head>
<body>
	<div class="app-container" style="max-width:100%;">
		<?php include '../navigation.php'; ?>
		
		<h3>Appointments</h3>
	
		<form class="form-inline row" method="post">
			<div class="col-xs-8 col-md-11">
				<?php 
					if($search == "") {
						echo "<input name=\"search\" type=\"search\" placeholder=\"Search appointments\" class=\"form-control\">";
					} else {
						echo "<input name=\"search\" type=\"search\" placeholder=\"Search appointments\" class=\"form-control\" value=\"".$search."\">";
					}
				?>
			</div>
			<div class="col-xs-4 col-md-1">
				<button type="submit" class="btn btn-default">Search</button>
			</div>
		</form>
		
		<a href="settings.php" class="btn btn-default">Appointment Settings</a>
		
		<table class="table table-striped">
			<thead>
				<tr>
					<th>Appointment Id</th>
					<th>Contact</th>
					<th>Date</th>
					<th>Time(s)</th>
					<th>Completed?</th>
					<th>Type</th>
					<th>Notes</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
				<?php
					$query = "SELECT a.id AS id, a.user_id AS user_id, month, day, year, start, end, type, notes, first_name, last_name, business_name, email, phone
							  FROM `appointments` AS a INNER JOIN `users` AS u ON u.id = a.user_id";
					if($search <> "") {
						$search = "%".$search."%";
						$query = $query." WHERE 
							month LIKE '$search' OR 
							day LIKE '$search' OR 
						    year LIKE '$search' OR 
							start LIKE '$search' OR 
							end LIKE '$search' OR 
							type LIKE '$search' OR
							notes LIKE '$search' OR 
							user_id LIKE '$search' OR
							first_name LIKE '$search' OR 
							last_name LIKE '$search' OR 
							business_name LIKE '$search' OR 
							email LIKE '$search' OR 
							phone LIKE '$search'";
					}
					$result = mysqli_query($c, $query) or die(mysqli_error());
					while($u = mysqli_fetch_array( $result, MYSQLI_ASSOC )) { 
						echo 
						"<tr>
							<td><a href=\"".$u["id"]."\" target=\"_blank\">".$u["id"]."</a></td>
							<td>
								".$u["first_name"]." ".$u["last_name"]." (".$u["business_name"].")<br />
								".$u["email"]." &middot; ".$u["phone"]."
							</td>
							<td>
								".$u["month"]."-".$u["day"]."-".$u["year"]."
							</td>
							<td>
								".$u["start"]."-".$u["end"]."
							</td>
							<td class=\"status\">"; if($u["completed"] <> 0) { echo "<span class=\"on\">"; } else { echo "<span class=\"off\">"; } echo "</span></td>
							<td>".$u["type"]."</td>
							<td>".$u["notes"]."</td>
							<td>
								<a href=\"delete.php?id=".$u["id"]."\" class=\"btn btn-danger btn-sm\" style=\"display:inline;\" onclick=\"return confirm('Are you sure you want to delete this?');\">Delete</a>
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