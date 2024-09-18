<?php
	include $_SERVER['DOCUMENT_ROOT'].'/admin/authentication.php';
	include $_SERVER['DOCUMENT_ROOT'].'/admin/utility/configuration.php';
	include $_SERVER['DOCUMENT_ROOT'].'/admin/utility/functions.php';
	$c = connect_to_database();
	$id = $_POST['id'];
	$first_name = addslashes($_POST['first_name']);
	$last_name = addslashes($_POST['last_name']);
	$email = addslashes($_POST['email']);
	$phone = addslashes($_POST['phone']);
	$url = addslashes($_POST['url']);
	$business_name = addslashes($_POST['business_name']);
	$description = addslashes($_POST['description']);
	$lead_status = $_POST['status'];
	$survey_completed = isset($_POST['survey_completed']) && $_POST['survey_completed'] ? "yes" : "no";
	
	if($id == "") {
		if(mysqli_query($c, "insert into users(first_name, last_name, email, phone, business_name, description, url, status, survey_completed) values('$first_name', '$last_name', '$email', '$phone', '$business_name', '$description', '$url', '$lead_status', '$survey_completed')")){
			
			$subject = "New client added in the admin panel - ".$first_name." ".$last_name;
			$body = "Name: ".$first_name." ".$last_name."<br />";
			$body .= "Business Name: ".$business_name."<br />";
			$body .= "Email: ".$email."<br />";
			$body .= "Phone: ".$phone."<br />";
			$body .= "URL: ".$url."<br />";
			$body .= "Description: ".$description;
			$time = date("YmdHis");
			$id = mysqli_insert_id;
			$admins = array(); 
			$admins[0] = "('email', '$subject', '$body', '$time', 'new_user', '$id')";
			if(mysqli_query("insert into emails (`to`, subject, text, time, type, reference_id) VALUES ".implode(',', $admins))) { } else { }
			
			header("Location: index.php");
		}else{ 
			//header("Location: error.php");
			echo '<img src="http://'.$_SERVER['SERVER_NAME'].'/images/error.png" style="height:20px;" />&nbsp;&nbsp;Database problem.<br>Contact wavelinkllc.com administrator.';
		}
	} else {
		if(mysqli_query($c, "update users set first_name = '$first_name', last_name = '$last_name', email = '$email', phone = '$phone', business_name = '$business_name', description = '$description', url = '$url', status = '$lead_status', survey_completed = '$survey_completed' where id = '$id'")){
			header("Location: index.php");
		}else{ 
			//header("Location: error.php");
			echo '<img src="http://'.$_SERVER['SERVER_NAME'].'/images/error.png" style="height:20px;" />&nbsp;&nbsp;Database problem.<br>Contact wavelinkllc.com administrator.';
		}
	}
?>