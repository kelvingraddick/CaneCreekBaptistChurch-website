<?php
	include $_SERVER['DOCUMENT_ROOT'].'/admin/authentication.php';
	include $_SERVER['DOCUMENT_ROOT'].'/admin/utility/configuration.php';
	include $_SERVER['DOCUMENT_ROOT'].'/admin/utility/functions.php';
	$c = connect_to_database();
	$id = $_POST['id'];
	$business_name = addslashes($_POST['business_name']);
	$first_name = addslashes($_POST['first_name']);
	$last_name = addslashes($_POST['last_name']);
	$email = addslashes($_POST['email']);
	$password = stripslashes($_POST['password']); $password = mysqli_real_escape_string($c, $password);
	$phone = addslashes($_POST['phone']);
	$status = $_POST['status'];
	$product_id = $_POST['product_id'];
	$last_payment_date = $_POST['last_payment_date'];
	$file_url = $_POST['file_url']; if($file_url == "") { $file_url = "none"; }
	
	$filenames = array($file_url);
	$target_dir = "../../files/";
	$i = 0;
	$file_array = reArrayFiles($_FILES['file']);
	foreach($file_array as $file) {
        $extension = getExtension(stripslashes($file['name']));
        $extension = strtolower($extension);
		$filename = $i . date("YmdHis") . "file." . $extension;
		$target_file = $target_dir . $filename;

		if (move_uploaded_file($file["tmp_name"], $target_file)) { 
			$filenames[$i] = "/files/" . $filename;
			//echo "File uploaded.<br />"; 
		} else { }
		
		$i++;
	}
	
	if($id == "") {
		if(mysqli_query($c, "insert into accounts(business_name, first_name, last_name, email, password, phone, status, product_id, last_payment_date, sign_up_date, file_url) values('$business_name', '$first_name', '$last_name', '$email', '$password', '$phone', '$status', '$product_id', '$last_payment_date', now(), '$filenames[0]')")){
			header("Location: index.php");
		}else{ 
			//header("Location: error.php");
			echo '<img src="http://'.$_SERVER['SERVER_NAME'].'/images/error.png" style="height:20px;" />&nbsp;&nbsp;Database problem.<br>Contact wavelinkllc.com administrator.';
		}
	} else {
		if(mysqli_query($c, "update accounts set business_name = '$business_name', first_name = '$first_name', last_name = '$last_name', email = '$email', password = '$password', phone = '$phone', status = '$status', product_id = '$product_id', last_payment_date = '$last_payment_date', file_url = '$filenames[0]' where id = '$id'")){
			header("Location: index.php");
		}else{ 
			//header("Location: error.php");
			echo '<img src="http://'.$_SERVER['SERVER_NAME'].'/images/error.png" style="height:20px;" />&nbsp;&nbsp;Database problem.<br>Contact wavelinkllc.com administrator.';
		}
	}
?>