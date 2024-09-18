<?php
	include $_SERVER['DOCUMENT_ROOT'].'/admin/authentication.php';
	include $_SERVER['DOCUMENT_ROOT'].'/admin/utility/configuration.php';
	include $_SERVER['DOCUMENT_ROOT'].'/admin/utility/functions.php';
	$c = connect_to_database();
	
	$home_page_background1 = addslashes($_POST['home_page_background1']); if($home_page_background1 == "") { $home_page_background1 = "none"; }
	$home_page_background2 = addslashes($_POST['home_page_background2']); if($home_page_background2 == "") { $home_page_background2 = "none"; }
	$home_page_background3 = addslashes($_POST['home_page_background3']); if($home_page_background3 == "") { $home_page_background3 = "none"; }
	$home_page_background4 = addslashes($_POST['home_page_background4']); if($home_page_background4 == "") { $home_page_background4 = "none"; }
	$slogan = addslashes($_POST['slogan']);
	$pitch = addslashes($_POST['pitch']);
	$feature1_photo = addslashes($_POST['feature1_photo']); if($feature1_photo == "") { $feature1_photo = "none"; }
	$feature1_title = addslashes($_POST['feature1_title']);
	$feature1_description = addslashes($_POST['feature1_description']);
	$feature2_photo = addslashes($_POST['feature2_photo']); if($feature2_photo == "") { $feature2_photo = "none"; }
	$feature2_title = addslashes($_POST['feature2_title']);
	$feature2_description = addslashes($_POST['feature2_description']);
	$feature3_photo = addslashes($_POST['feature3_photo']); if($feature3_photo == "") { $feature3_photo = "none"; }
	$feature3_title = addslashes($_POST['feature3_title']);
	$feature3_description = addslashes($_POST['feature3_description']);
	$testimonial1_photo = addslashes($_POST['testimonial1_photo']); if($testimonial1_photo == "") { $testimonial1_photo = "none"; }
	$testimonial1_quote = addslashes($_POST['testimonial1_quote']);
	$testimonial1_name = addslashes($_POST['testimonial1_name']);
	$testimonial2_photo = addslashes($_POST['testimonial2_photo']); if($testimonial2_photo == "") { $testimonial2_photo = "none"; }
	$testimonial2_quote = addslashes($_POST['testimonial2_quote']);
	$testimonial2_name = addslashes($_POST['testimonial2_name']);
	$testimonial3_photo = addslashes($_POST['testimonial3_photo']); if($testimonial3_photo == "") { $testimonial3_photo = "none"; }
	$testimonial3_quote = addslashes($_POST['testimonial3_quote']);
	$testimonial3_name = addslashes($_POST['testimonial3_name']);
	
	$filenames = array($home_page_background1, $home_page_background2, $home_page_background3, $home_page_background4, $feature1_photo, $feature2_photo, $feature3_photo, $testimonial1_photo, $testimonial2_photo, $testimonial3_photo);
	$target_dir = "../../images/application/";
	$i = 0;
	$file_array = reArrayFiles($_FILES['file']);
	foreach($file_array as $file) {
        $extension = getExtension(stripslashes($file['name']));
        $extension = strtolower($extension);
		$target_file = $target_dir . $i . date("YmdHis") . "setting." . $extension;
		if (move_uploaded_file($file["tmp_name"], $target_file)) { 
			$filenames[$i] = "/images/application/" . $i . date("YmdHis") . "setting." . $extension;
			//echo "File uploaded.<br />"; 
		} else { }
		$i++;
	}
	
	if(mysqli_query($c,
		"UPDATE settings
    	SET value = CASE code
			WHEN 'home_page_background1' THEN '$filenames[0]'
			WHEN 'home_page_background2' THEN '$filenames[1]'
			WHEN 'home_page_background3' THEN '$filenames[2]'
			WHEN 'home_page_background4' THEN '$filenames[3]'
			WHEN 'slogan' THEN '$slogan'
			WHEN 'pitch' THEN '$pitch'
			WHEN 'feature1_photo' THEN '$filenames[4]'
			WHEN 'feature1_title' THEN '$feature1_title'
			WHEN 'feature1_description' THEN '$feature1_description'
			WHEN 'feature2_photo' THEN '$filenames[5]'
			WHEN 'feature2_title' THEN '$feature2_title'
			WHEN 'feature2_description' THEN '$feature2_description'
			WHEN 'feature3_photo' THEN '$filenames[6]'
			WHEN 'feature3_title' THEN '$feature3_title'
			WHEN 'feature3_description' THEN '$feature3_description'
			WHEN 'testimonial1_photo' THEN '$filenames[7]'
			WHEN 'testimonial1_quote' THEN '$testimonial1_quote'
			WHEN 'testimonial1_name' THEN '$testimonial1_name'
			WHEN 'testimonial2_photo' THEN '$filenames[8]'
			WHEN 'testimonial2_quote' THEN '$testimonial2_quote'
			WHEN 'testimonial2_name' THEN '$testimonial2_name'
			WHEN 'testimonial3_photo' THEN '$filenames[9]'
			WHEN 'testimonial3_quote' THEN '$testimonial3_quote'
			WHEN 'testimonial3_name' THEN '$testimonial3_name'
		END
		WHERE code IN 
		(
			'home_page_background1',
			'home_page_background2',
			'home_page_background3',
			'home_page_background4',
			'slogan',
			'pitch',
			'feature1_photo',
			'feature1_title',
			'feature1_description',
			'feature2_photo',
			'feature2_title',
			'feature2_description',
			'feature3_photo',
			'feature3_title',
			'feature3_description',
			'testimonial1_photo',
			'testimonial1_quote',
			'testimonial1_name',
			'testimonial2_photo',
			'testimonial2_quote',
			'testimonial2_name',
			'testimonial3_photo',
			'testimonial3_quote',
			'testimonial3_name'
		)"
	)){
		header("Location: index.php");
	}else{ 
		//header("Location: error.php");
		echo '<img src="http://'.$_SERVER['SERVER_NAME'].'/images/error.png" style="height:20px;" />&nbsp;&nbsp;Database problem.<br>Contact wavelinkllc.com administrator.';
	}
?>