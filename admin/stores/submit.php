<?php
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);
	include $_SERVER['DOCUMENT_ROOT'].'/admin/authentication.php';
	include $_SERVER['DOCUMENT_ROOT'].'/admin/utility/configuration.php';
	include $_SERVER['DOCUMENT_ROOT'].'/admin/utility/functions.php';
	$c = connect_to_database();
	$id = $_POST['id'];
	$name = addslashes($_POST['name']);
	$phone = addslashes($_POST['phone']);
	$description = addslashes($_POST['description']);
	$address1 = addslashes($_POST['address1']);
	$address2 = addslashes($_POST['address2']);
	$city = addslashes($_POST['city']);
	$state = addslashes($_POST['state']);
	$zip = addslashes($_POST['zip']);
	$weekday_hours = addslashes($_POST['weekday_hours']);
	$saturday_hours = addslashes($_POST['saturday_hours']);
	$sunday_hours = addslashes($_POST['sunday_hours']);
	$photo = $_POST['photo']; if($photo == "") { $photo = "none"; }
	
	$filenames = array($photo);
	$target_dir = "../../images/application/";
	$i = 0;
	$file_array = reArrayFiles($_FILES['file']);
	foreach($file_array as $file) {
        $extension = getExtension(stripslashes($file['name']));
        $extension = strtolower($extension);
		$filename = $i . date("YmdHis") . "store." . $extension;
		$target_file = $target_dir . $filename;
		if (move_uploaded_file($file["tmp_name"], $target_file)) { 
			$filenames[$i] = "/images/application/" . $filename;
			//echo "File uploaded.<br />"; 
		} else { }
		$i++;
	}
	
	if($id == "") {
		if(mysqli_query($c, "insert into stores (name, photo, description, phone, address1, address2, city, state, zip, weekday_hours, saturday_hours, sunday_hours) 
						values('$name', '$filenames[0]', '$description', '$phone', '$address1', '$address2', '$city', '$state', '$zip', '$weekday_hours', '$saturday_hours', '$sunday_hours')")){
			header("Location: index.php");
		}else{ 
			//header("Location: error.php");
			echo '<img src="http://'.$_SERVER['SERVER_NAME'].'/images/error.png" style="height:20px;" />&nbsp;&nbsp;Database problem.<br>Contact wavelinkllc.com administrator.';
		}
	} else {
		if(mysqli_query($c, "update stores set name = '$name', photo = '$filenames[0]', description = '$description', phone = '$phone', address1 = '$address1', address2 = '$address2', city = '$city', state = '$state', zip = '$zip', weekday_hours = '$weekday_hours', saturday_hours = '$saturday_hours', sunday_hours = '$sunday_hours' where id = '$id'")){
			header("Location: index.php");
		}else{ 
			//header("Location: error.php");
			echo '<img src="http://'.$_SERVER['SERVER_NAME'].'/images/error.png" style="height:20px;" />&nbsp;&nbsp;Database problem.<br>Contact wavelinkllc.com administrator.';
		}
	}
?>