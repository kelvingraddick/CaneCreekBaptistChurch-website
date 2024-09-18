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
	<title><?php echo $site_name ?> - Issues</title>
	
	<link rel="stylesheet" href="http://canecreekbaptistchurchga.org/admin/css/tictail/tt-uikit-0.11.0.min.css">
</head>
<body>
	<div class="app-container" style="max-width:100%;">
		<?php include '../navigation.php'; ?>
		
		<h3>Issues</h3>
	
		<form class="form-inline row" method="post">
			<div class="col-xs-8 col-md-11">
				<?php 
					if($search == "") {
						echo "<input name=\"search\" type=\"search\" placeholder=\"Search issues\" class=\"form-control\">";
					} else {
						echo "<input name=\"search\" type=\"search\" placeholder=\"Search issues\" class=\"form-control\" value=\"".$search."\">";
					}
				?>
			</div>
			<div class="col-xs-4 col-md-1">
				<button type="submit" class="btn btn-default">Search</button>
			</div>
		</form>
		
		<a href="edit.php" class="btn btn-default"><b>+</b> Add new issue</a>
		
		<table class="table table-striped">
			<thead>
				<tr>
					<th>Id</th>
					<th>Preview</th>
					<th>Issue Number</th>
					<th>Month</th>
					<th>Year</th>
					<th>Links</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
				<?php
					$query = "SELECT * FROM issues";
					if($search <> "") {
						$query = $query." WHERE 
							id = '$search' OR 
							issue_number = '$search' OR 
							month = '$search' OR 
							year = '$search'";
					}
					$query .= " ORDER BY year DESC, month DESC";
					$result = mysqli_query($c, $query) or die(mysqli_error());
					while($u = mysqli_fetch_array( $result, MYSQLI_ASSOC )) { 
						echo 
						"<tr>
							<td>".$u["id"]."</td>
							<td><embed src=\"http://".$_SERVER['SERVER_NAME']."/".$u["pdf_link"]."\" width=\"100\" type=\"application/pdf\" /></td>
							<td>".$u["issue_number"]."</td>
							<td>".date('F', mktime(0, 0, 0, intval($u["month"]), 10))."</td>
							<td>".$u["year"]."</td>
							<td>
								Public Link: <a target=\"_blank\" href=\"http://".$_SERVER['SERVER_NAME']."/archive/?issue=".$u["issue_number"]."\">http://".$_SERVER['SERVER_NAME']."/archive/?issue=".$u["issue_number"]."</a><br />
								Direct Link: http://".$_SERVER['SERVER_NAME'].$u["pdf_link"]."
							</td>
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