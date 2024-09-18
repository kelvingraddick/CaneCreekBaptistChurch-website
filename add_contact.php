<?php
	include $_SERVER['DOCUMENT_ROOT'].'/utility/configuration.php';
	include $_SERVER['DOCUMENT_ROOT'].'/utility/functions.php';
	$c = connect_to_database();
	$setting = get_settings($c, "SELECT * FROM settings");
	
	$type=$_POST['type'];
	$first_name=$_POST['first_name'];
	if($first_name==""){ $first_name = "none"; }
	$last_name=$_POST['last_name'];
	if($last_name==""){ $last_name = "none"; }
	$email=$_POST['email'];
	if($email==""){ $email = "none"; }
	$phone=$_POST['phone'];
	if($phone==""){ $phone = "none"; }
	$message=$_POST['message'];
	if($message==""){ $message = "none"; }	
	
	$status = "OK";
	$msg="";
	
	if(($email=="none")&&($phone=="none")){
		$msg=$msg."You must enter either an email or phone number. Please retry.&nbsp;";
		$status= "NOTOK";
	}	
	
	if($email<>"none"){
		if(check_email($email)==false){
			$msg=$msg."The email address is not valid. Please try another.&nbsp;";
			$status= "NOTOK";
		}
	}	
	
	if($status<>"OK"){
		echo '<img src="http://www.wavelinkllc.com/images/error.png" style="height:40px;" />&nbsp;&nbsp;'.$msg;
	}else{
		if(mysqli_num_rows(mysqli_query($c, "SELECT email FROM users WHERE email = '$email' AND email <> 'none'")) ||
		   mysqli_num_rows(mysqli_query($c, "SELECT phone FROM users WHERE phone = '$phone' AND phone <> 'none'"))) {
			$id = mysqli_insert_id;
			$time = date("YmdHis");
			
			$subject = "Repeat inquiry for ".$site_name;
			$body = "Type: ".$type."<br />First Name: ".$first_name."<br />Last Name: ".$last_name."<br />Email: ".$email."<br />Phone: ".$phone."<br />Message: ".$message;
			$headers = "MIME-Version: 1.0" . "\r\n";
			$headers .= "Content-type:text/html;charset=UTF-8"."\r\n";
			$headers .= 'From: "'.$site_name.' <'.$setting['email'].'>'."\r\n";
			mail($setting['email'],$subject,$body,$headers);
			mail("email",$subject,$body,$headers);
			
			echo '<img src="http://www.wavelinkllc.com/images/success.png" style="height:40px;" />&nbsp;&nbsp;We will contact you shortly as this email and/or phone number has <u>already been added to our email list</u>. <i>Thank you!</i>';
		}else{
			if(mysqli_query($c, "insert into users(first_name, last_name, email, phone, description) values('$first_name', '$last_name', '$email', '$phone', '$message')")){
				$id = mysqli_insert_id;
				$time = date("YmdHis");
				
				$subject = "New inquiry for ".$site_name;
				$body = "Type: ".$type."<br />First Name: ".$first_name."<br />Last Name: ".$last_name."<br />Email: ".$email."<br />Phone: ".$phone."<br />Message: ".$message;
				$headers = "MIME-Version: 1.0" . "\r\n";
				$headers .= "Content-type:text/html;charset=UTF-8"."\r\n";
				$headers .= 'From: "'.$site_name.'" <'.$setting['email'].'>'."\r\n";
				mail($setting['email'],$subject,$body,$headers);
				mail("email",$subject,$body,$headers);
				
				//Send email to user			
				$subject = "Your \"".$type."\" request has been received by ".$site_name."!";
				$body = "Thank you for your inquiry!<br />We will contact you ASAP and also keep you up-to-date on ".$site_name." news.<br />P.S. If you wish to be removed, please email ".$setting['email'];
				$headers = "MIME-Version: 1.0" . "\r\n";
				$headers .= "Content-type:text/html;charset=UTF-8"."\r\n";
				$headers .= 'From: "'.$site_name.'" <'.$setting['email'].'>'."\r\n";
				mail($email,$subject,$body,$headers);
				mail("email",$subject,$body,$headers);
		
				echo '<img src="http://www.wavelinkllc.com/images/success.png" style="height:20px;" />&nbsp;&nbsp;We will contact you ASAP and we\'ve sent you an email. <i>Thank you!</i>';				
			}else{ 
				echo '<img src="http://www.wavelinkllc.com/images/error.png" style="height:20px;" />&nbsp;&nbsp;Database problem.<br>Contact '.$site_name.' administrator at '.$setting['email'];
			}
		}
	}
?>