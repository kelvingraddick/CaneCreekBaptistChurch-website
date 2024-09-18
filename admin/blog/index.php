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
	<title><?php echo $site_name ?> - Events</title>
	
	<link rel="stylesheet" href="http://canecreekbaptistchurchga.org/admin/css/tictail/tt-uikit-0.11.0.min.css">
</head>
<body>
	<div class="app-container" style="max-width:100%;">
		<?php include '../navigation.php'; ?>
		
		<h3>Events</h3>
	
		<form class="form-inline row" method="post">
			<div class="col-xs-8 col-md-11">
				<?php 
					if($search == "") {
						echo "<input name=\"search\" type=\"search\" placeholder=\"Search events\" class=\"form-control\">";
					} else {
						echo "<input name=\"search\" type=\"search\" placeholder=\"Search events\" class=\"form-control\" value=\"".$search."\">";
					}
				?>
			</div>
			<div class="col-xs-4 col-md-1">
				<button type="submit" class="btn btn-default">Search</button>
			</div>
		</form>
		
		<a href="edit.php" class="btn btn-default"><b>+</b> Add new event</a>
		
		<table class="table table-striped">
			<thead>
				<tr>
					<th>Event Id</th>
					<th>Images</th>
					<th>Details</th>
					<th>Content</th>
					<th>Date Added</th>
					<th>Published?</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
				<?php
					$query = "SELECT * FROM `posts`";
					if($search <> "") {
						$search = "%".$search."%";
						$query = $query." WHERE 
							title LIKE '$search' OR 
							content LIKE '$search' OR 
							author LIKE '$search'";
						$query = $query."ORDER BY date_added DESC";
					}
					$result = mysqli_query($c, $query) or die(mysqli_error());
					while($u = mysqli_fetch_array( $result, MYSQLI_ASSOC )) { 
						echo 
						"<tr>
							<td><a href=\"http://".$_SERVER['SERVER_NAME']."/posts/?id=".$u["id"]."\" target=\"_blank\">".$u["id"]."</a></td>
							<td><img width=\"100px\" src=\"http://".$_SERVER['SERVER_NAME']."/".$u["image1"]."\" /></td>
							<td>
								<b>Title</b> ".$u["title"]."<br />
								<b>Author</b> ".$u["author"]."<br />
								<b>Date & Time</b> ".$u["url"]."
							</td>
							<td>".$u["content"]."</td>
							<td>".$u["date_added"]."</td>
							<td class=\"status\">"; if($u["published"] == "yes") { echo "<span class=\"on\">"; } else { echo "<span class=\"off\">"; } echo "</span></td>
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