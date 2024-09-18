<?php
	include $_SERVER['DOCUMENT_ROOT'].'/admin/authentication.php';
	include $_SERVER['DOCUMENT_ROOT'].'/admin/utility/configuration.php';
	include $_SERVER['DOCUMENT_ROOT'].'/admin/utility/functions.php';
	$c = connect_to_database();
	$id = $_POST['id'];
	$title = addslashes($_POST['title']);
	$author = addslashes($_POST['author']);
	$url = addslashes($_POST['url']);
	$content = addslashes($_POST['content']);
	$published = isset($_POST['published']) && $_POST['published'] ? "yes" : "no";
	$image1 = $_POST['image1']; if($image1 == "") { $image1 = "none"; }
	$image2 = $_POST['image2']; if($image2 == "") { $image2 = "none"; }
	$image3 = $_POST['image3']; if($image3 == "") { $image3 = "none"; }
	$image4 = $_POST['image4']; if($image4 == "") { $image4 = "none"; }
	$image5 = $_POST['image5']; if($image5 == "") { $image5 = "none"; }
	$image6 = $_POST['image6']; if($image6 == "") { $image6 = "none"; }
	$image7 = $_POST['image7']; if($image7 == "") { $image7 = "none"; }
	$image8 = $_POST['image8']; if($image8 == "") { $image8 = "none"; }
	
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
		if(mysqli_query($c, "insert into posts(title, author, url, content, published, image1, image2, image3, image4, image5, image6, image7, image8) 
						values('$title', '$author', '$url', '$content', '$published', '$filenames[0]', '$filenames[1]', '$filenames[2]', '$filenames[3]', '$filenames[4]', '$filenames[5]', '$filenames[6]', '$filenames[7]')")){
			header("Location: index.php");
		}else{ 
			//header("Location: error.php");
			echo '<img src="http://'.$_SERVER['SERVER_NAME'].'/images/error.png" style="height:20px;" />&nbsp;&nbsp;Database problem.<br>Contact wavelinkllc.com administrator.';
		}
	} else {
		if(mysqli_query($c, "update posts set title = '$title', author = '$author', url = '$url', content = '$content', published = '$published', image1 = '$filenames[0]', image2 = '$filenames[1]', image3 = '$filenames[2]', image4 = '$filenames[3]', image5 = '$filenames[4]', image6 = '$filenames[5]', image7 = '$filenames[6]', image8 = '$filenames[7]' where id = '$id'")){
			header("Location: index.php");
		}else{ 
			//header("Location: error.php");
			echo '<img src="http://'.$_SERVER['SERVER_NAME'].'/images/error.png" style="height:20px;" />&nbsp;&nbsp;Database problem.<br>Contact wavelinkllc.com administrator.';
		}
	}
?>