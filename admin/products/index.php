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
	<title><?php echo $site_name ?> - Products</title>
	
	<link rel="stylesheet" href="http://canecreekbaptistchurchga.org/admin/css/tictail/tt-uikit-0.11.0.min.css">
</head>
<body>
	<div class="app-container" style="max-width:100%;">
		<?php include '../navigation.php'; ?>
		
		<h3>Products</h3>
	
		<form class="form-inline row" method="post">
			<div class="col-xs-8 col-md-11">
				<?php 
					if($search == "") {
						echo "<input name=\"search\" type=\"search\" placeholder=\"Search products\" class=\"form-control\">";
					} else {
						echo "<input name=\"search\" type=\"search\" placeholder=\"Search products\" class=\"form-control\" value=\"".$search."\">";
					}
				?>
			</div>
			<div class="col-xs-4 col-md-1">
				<button type="submit" class="btn btn-default">Search</button>
			</div>
		</form>
		
		<a href="edit.php" class="btn btn-default"><b>+</b> Add new product</a>
		<a href="../categories/" class="btn btn-default"><b>+</b> Add/Edit Categories</a>
		
		<table class="table table-striped">
			<thead>
				<tr>
					<th>Product Id</th>
					<th>Images</th>
					<th>Details</th>
					<th>Price</th>
					<th>Sale Price</th>
					<th>On Sale?</th>
					<th>Featured?</th>
					<th>Quantity</th>
					<th>Type(s)</th>
					<th>Category(s)</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
				<?php
					$query = "SELECT * FROM `products`";
					if($search <> "") {
						$search = "%".$search."%";
						$query = $query." WHERE 
							title LIKE '$search' OR 
							description LIKE '$search' OR 
							category1 LIKE '$search' OR 
							category2 LIKE '$search' OR 
							category3 LIKE '$search'";
					}
					$query = $query." ORDER BY id ASC";
					$result = mysqli_query($c, $query) or die(mysqli_error());
					while($u = mysqli_fetch_array( $result, MYSQLI_ASSOC )) { 
						$date = explode("-", $u["date"]);
						$month = (count($date) > 0 ? $date[0] : "");
						$day = (count($date) > 1 ? $date[1] : "");
						$year = (count($date) > 2 ? $date[2] : "");
						$time = explode(":", $u["time"]);
						$hour = (count($time) > 0 ? $time[0] : "");
						$minute = (count($time) > 1 ? $time[1] : "");
						echo 
						"<tr>
							<td><a href=\"http://".$_SERVER['SERVER_NAME']."/products/?id=".$u["id"]."\" target=\"_blank\">".$u["id"]."</a></td>
							<td><img width=\"100px\" src=\"http://".$_SERVER['SERVER_NAME']."/".$u["image1"]."\" /></td>
							<td>
								<b>Name</b> ".$u["title"]."<br />
								<b>When</b> ".date("F jS, Y g:ia", mktime($hour, $minute, 0, $month, $day, $year))."<br />
								<b>About</b> ".$u["description"]."<br />
								<b>Payment Link</b> <a href=\"http://".$_SERVER['SERVER_NAME']."/invoice/?id=".$u["id"]."\" target=\"_blank\">http://".$_SERVER['SERVER_NAME']."/invoice/?id=".$u["id"]."</a>
							</td>
							<td>$".$u["price"]."</td>
							<td>$".$u["sale_price"]."</td>
							<td class=\"status\">"; if($u["on_sale"] == "yes") { echo "<span class=\"on\">"; } else { echo "<span class=\"off\">"; } echo "</span></td>
							<td class=\"status\">"; if($u["featured"] == "yes") { echo "<span class=\"on\">"; } else { echo "<span class=\"off\">"; } echo "</span></td>
							<td>".($u["quantity"] == -1 ? "Unlimited" : $u["quantity"])."</td>
							<td>
								".($u["type1"] <> "none" ? $u["type1"]."<br />" : '')."
								".($u["type2"] <> "none" ? $u["type2"]."<br />" : '')."
								".($u["type3"] <> "none" ? $u["type3"]."<br />" : '')."
								".($u["type4"] <> "none" ? $u["type4"]."<br />" : '')."
								".($u["type5"] <> "none" ? $u["type5"]."<br />" : '')."
								".($u["type6"] <> "none" ? $u["type6"]."<br />" : '')."
								".($u["type7"] <> "none" ? $u["type7"]."<br />" : '')."
								".($u["type8"] <> "none" ? $u["type8"] : '')."
							</td>
							<td>
								".($u["category1"] <> "none" ? $u["category1"]."<br />" : '')."
								".($u["category2"] <> "none" ? $u["category2"]."<br />" : '')."
								".($u["category3"] <> "none" ? $u["category3"] : '')."
							</td>
							<td>
								<a href=\"edit.php?id=".$u["id"]."\" class=\"btn btn-default btn-sm\" style=\"display:inline;\">Edit</a>&nbsp;<a href=\"invoice.php?id=".$u["id"]."\" class=\"btn btn-default btn-sm\" style=\"display:inline;\">Invoice</a>&nbsp;<a href=\"receipt.php?id=".$u["id"]."\" class=\"btn btn-default btn-sm\" style=\"display:inline;\">Receipt</a>&nbsp;<a href=\"delete.php?id=".$u["id"]."\" class=\"btn btn-danger btn-sm\" style=\"display:inline;\" onclick=\"return confirm('Are you sure you want to delete this?');\">Delete</a>
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