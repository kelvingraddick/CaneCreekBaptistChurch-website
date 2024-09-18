<?php
	include $_SERVER['DOCUMENT_ROOT'].'/admin/utility/configuration.php';
	include $_SERVER['DOCUMENT_ROOT'].'/admin/utility/functions.php';
	$c = connect_to_database();

	// username and password sent from form 
	$email=$_POST['email'];
	$password=$_POST['password'];
	$session_email=$email; 
	$session_password=$password; 
	  
	// To protect MySQL injection (more detail about MySQL injection)
	$email = stripslashes($email);
	$password = stripslashes($password);
	$email = mysqli_real_escape_string($c, $email);
	$password = mysqli_real_escape_string($c, $password);
	  
	$session = $_COOKIE['email'].$_SERVER["REMOTE_ADDR"];
	if((mysqli_num_rows(mysqli_query($c, "SELECT * FROM `users` WHERE session='$session'")))&&($email=="")){
		$email = mysqli_result($c, "SELECT email FROM `users` WHERE session='$session'");
		$password = mysqli_result($c, "SELECT password FROM `users` WHERE session='$session'");
		session_start();
		$_SESSION["email"] = $email;
		$_SESSION["password"] = $password; 
		header("Location: http://".$_SERVER['SERVER_NAME']."/admin/settings/");
	}else{
		$sql="SELECT * FROM users WHERE email='$email' and password='$password'";
		$result=mysqli_query($c, $sql);
		$count=mysqli_num_rows($result);
		if($count==1){
			session_start();
			$_SESSION["email"] = $session_email;
			$_SESSION["password"] = $session_password; 
			setcookie("email", $session_email, time()+3600*24*1, "/"); //expire in 24 hours or 1 day
			if(mysqli_query($c, "UPDATE `users` SET session='$session' WHERE email='$email' and password='$password'")){ }else{ }
			header("Location: http://".$_SERVER['SERVER_NAME']."/admin/settings/");
		}else{
			header("Location: http://".$_SERVER['SERVER_NAME']."/admin/?error=yes&email=".$session_email."&password=".$session_password."");
		}
	}
?>
