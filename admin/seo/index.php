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
	<title><?php echo $site_name ?> - SEO</title>
	
	<link rel="stylesheet" href="http://canecreekbaptistchurchga.org/admin/css/tictail/tt-uikit-0.11.0.min.css">
</head>
<body>
	<div class="app-container" style="max-width:100%;">
		<?php include '../navigation.php'; ?>
		
		<h3>Search Engine Optimization</h3>
		
		<table class="table table-striped">
			<thead>
				<tr>
					<th>Page</th>
					<th>Title</th>
					<th>Description</th>
					<th>Keywords</th>
					<th>Header</th>
				</tr>
			</thead>
			<tbody>
				<?php
					$result = mysqli_query($c, "SELECT * FROM `seo`") or die(mysqli_error());
					while($u = mysqli_fetch_array( $result, MYSQLI_ASSOC )) { 
						echo 
						"<tr>
							<td>".$u["display"]."</td>
							<td>".$u["title"]."</td>
							<td>".$u["description"]."</td>
							<td>".$u["keywords"]."</td>
							<td>".$u["header"]."</td>
							<td>
								<a href=\"edit.php?id=".$u["id"]."\" class=\"btn btn-default btn-sm\" style=\"display:inline;\">Edit</a>
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