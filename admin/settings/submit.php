<?php
	include $_SERVER['DOCUMENT_ROOT'].'/admin/authentication.php';
	include $_SERVER['DOCUMENT_ROOT'].'/admin/utility/configuration.php';
	include $_SERVER['DOCUMENT_ROOT'].'/admin/utility/functions.php';
	$c = connect_to_database();
	
	$logo = addslashes($_POST['logo']); if($logo == "") { $logo = "none"; }
	$phone = addslashes($_POST['phone']);
	$email = addslashes($_POST['email']);
	$aboutus = addslashes($_POST['aboutus']);
	$address1 = addslashes($_POST['address1']);
	$address2 = addslashes($_POST['address2']);
	$city = addslashes($_POST['city']);
	$state = addslashes($_POST['state']);
	$zip = addslashes($_POST['zip']);
	$hours_weekday = addslashes($_POST['hours_weekday']);
	$hours_saturday = addslashes($_POST['hours_saturday']);
	$hours_sunday = addslashes($_POST['hours_sunday']);
	$headline = addslashes($_POST['headline']);
	$invoice_logo = addslashes($_POST['invoice_logo']); if($invoice_logo == "") { $invoice_logo = "none"; }
	$invoice_contact_name = addslashes($_POST['invoice_contact_name']);
	$invoice_contact_title = addslashes($_POST['invoice_contact_title']);
	$invoice_contact_phone = addslashes($_POST['invoice_contact_phone']);
	$invoice_contact_email = addslashes($_POST['invoice_contact_email']);
	$receipt_logo = addslashes($_POST['receipt_logo']); if($receipt_logo == "") { $receipt_logo = "none"; }
	$receipt_contact_name = addslashes($_POST['receipt_contact_name']);
	$receipt_contact_title = addslashes($_POST['receipt_contact_title']);
	$receipt_contact_phone = addslashes($_POST['receipt_contact_phone']);
	$receipt_contact_email = addslashes($_POST['receipt_contact_email']);
	$facebook_link = addslashes($_POST['facebook_link']);
	$twitter_link = addslashes($_POST['twitter_link']);
	$linkedin_link = addslashes($_POST['linkedin_link']);
	$googleplus_link = addslashes($_POST['googleplus_link']);
	$instagram_link = addslashes($_POST['instagram_link']);
	
	$filenames = array($logo, $invoice_logo, $receipt_logo);
	$target_dir = "../../images/application/";
	$i = 0;
	$file_array = reArrayFiles($_FILES['file']);
	foreach($file_array as $file) {
        $extension = getExtension(stripslashes($file['name']));
        $extension = strtolower($extension);
		$filename = $i . date("YmdHis") . "setting." . $extension;
		$target_file = $target_dir . $filename;
		if (move_uploaded_file($file["tmp_name"], $target_file)) { 
			$filenames[$i] = "/images/application/" . $filename;
			//echo "File uploaded.<br />"; 
		} else { }
		$i++;
	}
	
	if(mysqli_query($c,
		"UPDATE settings
    	SET value = CASE code
			WHEN 'logo' THEN '$filenames[0]'
			WHEN 'phone' THEN '$phone'
			WHEN 'email' THEN '$email'
			WHEN 'aboutus' THEN '$aboutus'
			WHEN 'address1' THEN '$address1'
			WHEN 'address2' THEN '$address2'
			WHEN 'city' THEN '$city'
			WHEN 'state' THEN '$state'
			WHEN 'zip' THEN '$zip'
			WHEN 'hours_weekday' THEN '$hours_weekday'
			WHEN 'hours_saturday' THEN '$hours_saturday'
			WHEN 'hours_sunday' THEN '$hours_sunday'
			WHEN 'headline' THEN '$headline'
			WHEN 'invoice_logo' THEN '$filenames[1]'
			WHEN 'invoice_contact_name' THEN '$invoice_contact_name'
			WHEN 'invoice_contact_title' THEN '$invoice_contact_title'
			WHEN 'invoice_contact_phone' THEN '$invoice_contact_phone'
			WHEN 'invoice_contact_email' THEN '$invoice_contact_email'
			WHEN 'receipt_logo' THEN '$filenames[2]'
			WHEN 'receipt_contact_name' THEN '$receipt_contact_name'
			WHEN 'receipt_contact_title' THEN '$receipt_contact_title'
			WHEN 'receipt_contact_phone' THEN '$receipt_contact_phone'
			WHEN 'receipt_contact_email' THEN '$receipt_contact_email'
			WHEN 'facebook_link' THEN '$facebook_link'
			WHEN 'twitter_link' THEN '$twitter_link'
			WHEN 'linkedin_link' THEN '$linkedin_link'
			WHEN 'googleplus_link' THEN '$googleplus_link'
			WHEN 'instagram_link' THEN '$instagram_link'
		END
		WHERE code IN 
		(
			'logo',
			'phone',
			'email',
			'aboutus',
			'address1',
			'address2',
			'city',
			'state',
			'zip',
			'hours_weekday',
			'hours_saturday',
			'hours_sunday',
			'headline',
			'invoice_logo',
			'invoice_contact_name',
			'invoice_contact_title',
			'invoice_contact_phone',
			'invoice_contact_email',
			'receipt_logo',
			'receipt_contact_name',
			'receipt_contact_title',
			'receipt_contact_phone',
			'receipt_contact_email',
			'facebook_link',
			'twitter_link',
			'linkedin_link',
			'googleplus_link',
			'instagram_link'
		)"
	)){
		header("Location: index.php");
	}else{ 
		//header("Location: error.php");
		echo '<img src="http://'.$_SERVER['SERVER_NAME'].'/images/error.png" style="height:20px;" />&nbsp;&nbsp;Database problem.<br>Contact wavelinkllc.com administrator.';
	}
?>