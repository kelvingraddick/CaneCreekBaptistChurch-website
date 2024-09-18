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
	<title><?php echo $site_name ?> - Locations</title>
	
	<link rel="stylesheet" href="http://canecreekbaptistchurchga.org/admin/css/tictail/tt-uikit-0.11.0.min.css">
</head>
<body>
	<div class="app-container" style="max-width:100%;">
		<?php include '../navigation.php'; ?>
		
		<h3>Locations</h3>
	
		<form class="form-inline row" method="post">
			<div class="col-xs-8 col-md-11">
				<?php 
					if($search == "") {
						echo "<input name=\"search\" type=\"search\" placeholder=\"Search locations\" class=\"form-control\">";
					} else {
						echo "<input name=\"search\" type=\"search\" placeholder=\"Search locations\" class=\"form-control\" value=\"".$search."\">";
					}
				?>
			</div>
			<div class="col-xs-4 col-md-1">
				<button type="submit" class="btn btn-default">Search</button>
			</div>
		</form>
		
		<a href="edit.php" class="btn btn-default"><b>+</b> Add new location</a>
		
		<table class="table table-striped">
			<thead>
				<tr>
					<th>Location Id</th>
					<th>Name</th>
					<th>Photo</th>
					<th>Description</th>
					<th>Address</th>
					<!--<th>Hours</th>-->
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
				<?php
					$query = "SELECT * FROM `stores`";
					if($search <> "") {
						$search = "%".$search."%";
						$query = $query." WHERE 
							name LIKE '$search' OR 
							address1 LIKE '$search' OR 
							address2 LIKE '$search'";
					}
					$result = mysqli_query($c, $query) or die(mysqli_error());
					while($u = mysqli_fetch_array( $result, MYSQLI_ASSOC )) { 
						echo 
						"<tr>
							<td><a href=\"http://".$_SERVER['SERVER_NAME']."/store/?id=".$u["id"]."\" target=\"_blank\">".$u["id"]."</a></td>
							<td>".$u["name"]."</td>
							<td><img width=\"100px\" src=\"http://".$_SERVER['SERVER_NAME']."/".$u["photo"]."\" /></td>
							<td>".$u["description"]."</td>
							<td>
								".$u["address1"]."<br />
								".($u["address2"] <> "" ? $u["address2"]."<br />" : "")."
								".$u["city"]."&nbsp;".$u["state"]."&nbsp;".$u["zip"]."<br />
								".$u["phone"]."
							</td>
							<!--
							<td>
								Monday-Friday: ".$u["weekday_hours"]."<br />
								Saturday: ".$u["saturday_hours"]."<br />
								Sunday: ".$u["sunday_hours"]."
							</td>
							-->
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