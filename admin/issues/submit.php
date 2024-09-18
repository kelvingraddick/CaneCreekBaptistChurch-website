<?php
	include $_SERVER['DOCUMENT_ROOT'].'/admin/authentication.php';
	include $_SERVER['DOCUMENT_ROOT'].'/admin/utility/configuration.php';
	include $_SERVER['DOCUMENT_ROOT'].'/admin/utility/functions.php';
	$c = connect_to_database();
	$id = $_POST['id'];
	$issue_number = addslashes($_POST['issue_number']);
	$month = $_POST['month'];
	$year = $_POST['year'];
	$pdf_link = $_POST['pdf_link']; if($pdf_link == "") { $pdf_link = "none"; }
	
	$filenames = array($pdf_link);
	$target_dir = "../../pdfs/";
	$i = 0;
	$file_array = reArrayFiles($_FILES['file']);
	foreach($file_array as $file) {
        $extension = getExtension(stripslashes($file['name']));
        $extension = strtolower($extension);
		$filename = $i . date("YmdHis") . "issue." . $extension;
		$target_file = $target_dir . $filename;

		if (move_uploaded_file($file["tmp_name"], $target_file)) { 
			$filenames[$i] = "/pdfs/" . $filename;
			//echo "File uploaded.<br />"; 
		} else { }
		
		$i++;
	}
	
	if($id == "") {
		if(mysqli_query($c, "insert into issues(issue_number, month, year, pdf_link) values('$issue_number', '$month', '$year', '$filenames[0]')")){
			header("Location: index.php");
		}else{ 
			//header("Location: error.php");
			echo '<img src="http://'.$_SERVER['SERVER_NAME'].'/images/error.png" style="height:20px;" />&nbsp;&nbsp;Database problem.<br>Contact wavelinkllc.com administrator.';
		}
	} else {
		if(mysqli_query($c, "update issues set issue_number = '$issue_number', month = '$month', year = '$year', pdf_link = '$filenames[0]' where id = '$id'")){
			header("Location: index.php");
		}else{ 
			//header("Location: error.php");
			echo '<img src="http://'.$_SERVER['SERVER_NAME'].'/images/error.png" style="height:20px;" />&nbsp;&nbsp;Database problem.<br>Contact wavelinkllc.com administrator.';
		}
	}
?>