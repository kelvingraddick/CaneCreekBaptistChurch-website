<?php
	include $_SERVER['DOCUMENT_ROOT'].'/admin/authentication.php';
	include $_SERVER['DOCUMENT_ROOT'].'/admin/utility/configuration.php';
	include $_SERVER['DOCUMENT_ROOT'].'/admin/utility/functions.php';
	$c = connect_to_database();
	$id = $_POST['id'];
	$title = addslashes($_POST['title']);
	$description = addslashes($_POST['description']);
	$date = $_POST['date'];
	$time = $_POST['time'];
	$quantity = ($_POST['quantity'] <> "" ? $_POST['quantity'] : "-1");
	$price = $_POST['price'];
	$sale_price = $_POST['sale_price'];
	$on_sale = isset($_POST['on_sale']) && $_POST['on_sale'] ? "yes" : "no";
	$featured = isset($_POST['featured']) && $_POST['featured'] ? "yes" : "no";
	$category1 = $_POST['category1'];
	$category2 = $_POST['category2'];
	$category3 = $_POST['category3'];
	$image1 = $_POST['image1']; if($image1 == "") { $image1 = "none"; }
	$image2 = $_POST['image2']; if($image2 == "") { $image2 = "none"; }
	$image3 = $_POST['image3']; if($image3 == "") { $image3 = "none"; }
	$image4 = $_POST['image4']; if($image4 == "") { $image4 = "none"; }
	$image5 = $_POST['image5']; if($image5 == "") { $image5 = "none"; }
	$image6 = $_POST['image6']; if($image6 == "") { $image6 = "none"; }
	$image7 = $_POST['image7']; if($image7 == "") { $image7 = "none"; }
	$image8 = $_POST['image8']; if($image8 == "") { $image8 = "none"; }
	$type1 = $_POST['type1']; if($type1 == "") { $type1 = "none"; }
	$type2 = $_POST['type2']; if($type2 == "") { $type2 = "none"; }
	$type3 = $_POST['type3']; if($type3 == "") { $type3 = "none"; }
	$type4 = $_POST['type4']; if($type4 == "") { $type4 = "none"; }
	$type5 = $_POST['type5']; if($type5 == "") { $type5 = "none"; }
	$type6 = $_POST['type6']; if($type6 == "") { $type6 = "none"; }
	$type7 = $_POST['type7']; if($type7 == "") { $type7 = "none"; }
	$type8 = $_POST['type8']; if($type8 == "") { $type8 = "none"; }
	
	$filenames = array($image1,$image2,$image3,$image4,$image5,$image6,$image7,$image8);
	$target_dir = "../../images/application/";
	$i = 0;
	$file_array = reArrayFiles($_FILES['file']);
	foreach($file_array as $file) {
        $extension = getExtension(stripslashes($file['name']));
        $extension = strtolower($extension);
		$filename = $i . date("YmdHis") . "product." . $extension;
		$target_file = $target_dir . $filename;
		if (move_uploaded_file($file["tmp_name"], $target_file)) { 
			$filenames[$i] = "/images/application/" . $filename;
			//echo "File uploaded.<br />"; 
		} else { }
		$i++;
	}
	
	if($id == "") {
		if(mysqli_query($c, "insert into products(title, description, date, time, quantity, price, sale_price, on_sale, featured, category1, category2, category3, image1, image2, image3, image4, image5, image6, image7, image8, type1, type2, type3, type4, type5, type6, type7, type8)  
						values('$title', '$description', '$date', '$time', '$quantity', '$price', '$sale_price', '$on_sale', '$featured', '$category1', '$category2', '$category3', '$filenames[0]', '$filenames[1]', '$filenames[2]', '$filenames[3]', '$filenames[4]', '$filenames[5]', '$filenames[6]', '$filenames[7]', '$type1', '$type2', '$type3', '$type4', '$type5', '$type6', '$type7', '$type8')")){
			header("Location: index.php");
		}else{ 
			//header("Location: error.php");
			echo '<img src="http://'.$_SERVER['SERVER_NAME'].'/images/error.png" style="height:20px;" />&nbsp;&nbsp;Database problem.<br>Contact wavelinkllc.com administrator.';
		}
	} else {
		if(mysqli_query($c, "update products set title = '$title', description = '$description', date = '$date', time = '$time', quantity = '$quantity', price = '$price', sale_price = '$sale_price', on_sale = '$on_sale', featured = '$featured', category1 = '$category1', category2 = '$category2', category3 = '$category3', image1 = '$filenames[0]', image2 = '$filenames[1]', image3 = '$filenames[2]', image4 = '$filenames[3]', image5 = '$filenames[4]', image6 = '$filenames[5]', image7 = '$filenames[6]', image8 = '$filenames[7]', type1 = '$type1', type2 = '$type2', type3 = '$type3', type4 = '$type4', type5 = '$type5', type6 = '$type6', type7 = '$type7', type8 = '$type8' where id = '$id'")){
			header("Location: index.php");
		}else{ 
			//header("Location: error.php");
			echo '<img src="http://'.$_SERVER['SERVER_NAME'].'/images/error.png" style="height:20px;" />&nbsp;&nbsp;Database problem.<br>Contact wavelinkllc.com administrator.';
		}
	}
?>