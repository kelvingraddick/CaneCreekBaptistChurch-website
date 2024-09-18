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
	<title><?php echo $site_name ?> - Categories</title>
	
	<link rel="stylesheet" href="http://canecreekbaptistchurchga.org/admin/css/tictail/tt-uikit-0.11.0.min.css">
</head>
<body>
	<div class="app-container" style="max-width:100%;">
		<?php include '../navigation.php'; ?>
		
		<a href="../products/" class="btn btn-link">&larr; Go back to products</a>
		
		<h3>Categories</h3>
		
		<form class="form-inline row" method="post">
			<div class="col-xs-8 col-md-11">
				<?php 
					if($search == "") {
						echo "<input name=\"search\" type=\"search\" placeholder=\"Search categories\" class=\"form-control\">";
					} else {
						echo "<input name=\"search\" type=\"search\" placeholder=\"Search categories\" class=\"form-control\" value=\"".$search."\">";
					}
				?>
			</div>
			<div class="col-xs-4 col-md-1">
				<button type="submit" class="btn btn-default">Search</button>
			</div>
		</form>
		
		<a href="edit.php" class="btn btn-default"><b>+</b> Add new category</a>
		
		<table class="table table-striped">
			<thead>
				<tr>
					<th>Id</th>
					<th>Image</th>
					<th>Name</th>
					<th>Value</th>
					<th>Type</th>
					<th>Details</th>
					<th>Featured</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
				<?php
					$query = "SELECT * FROM `categories`";
					if($search <> "") {
						$search = "%".$search."%";
						$query = $query." WHERE 
							name LIKE '$search' OR 
							value LIKE '$search' OR 
							type LIKE '$search' OR
							description LIKE '$search' OR
							url LIKE '$search'";
					}
					$result = mysqli_query($c, $query) or die(mysqli_error());
					while($u = mysqli_fetch_array( $result, MYSQLI_ASSOC )) { 
						echo 
						"<tr>
							<td>".$u["id"]."</td>
							<td>".($u["image"] <> "none" ? "<img width=\"100px\" src=\"http://".$_SERVER['SERVER_NAME']."/".$u["image"]."\" />" : "")."</td>
							<td>".$u["name"]."</td>
							<td>".$u["value"]."</td>
							<td>".$u["type"]."</td>
							<td>
								<b>Description</b> ".$u["description"]."<br />
								<b>URL</b> <a href=\"".$u["url"]."\" target=\"_blank\">".$u["url"]."</a>
							</td>
							<td class=\"status\">"; if($u["featured"] == "yes") { echo "<span class=\"on\">"; } else { echo "<span class=\"off\">"; } echo "</span></td>
							<td>
								<a href=\"edit.php?id=".$u["id"]."\" class=\"btn btn-default btn-sm\" style=\"display:inline;\">Edit</a><a href=\"delete.php?id=".$u["id"]."\" class=\"btn btn-danger btn-sm\" style=\"display:inline;\" onclick=\"return confirm('Are you sure you want to delete this?');\">Delete</a>
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