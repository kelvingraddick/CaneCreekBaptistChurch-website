<?php

	// General settings
	$business_name="Cane Creek Baptist Church";

	// Your database settings
	$db_host="localhost"; // Host name 
	$db_username="username"; // Mysql username 
	$db_password="password"; // Mysql password 
	$db_name="name"; // Database name 
	
	// Cart settings
	$admin_email="";
	$Cart = new Cart();
	$Cart -> paypal_email = "email";
	$Cart -> paypal_color = "000000";
	$Cart -> no_shipping = "0";
	$Cart -> return_url = "http://".$_SERVER['SERVER_NAME'];
	$Cart -> cancel_url = "http://".$_SERVER['SERVER_NAME'];
?>