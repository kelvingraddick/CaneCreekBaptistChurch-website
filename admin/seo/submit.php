<?php
	include $_SERVER['DOCUMENT_ROOT'].'/admin/authentication.php';
	include $_SERVER['DOCUMENT_ROOT'].'/admin/utility/configuration.php';
	include $_SERVER['DOCUMENT_ROOT'].'/admin/utility/functions.php';
	$c = connect_to_database();
	$id = $_POST['id'];
	$title = addslashes($_POST['title']);
	$description = addslashes($_POST['description']);
	$keywords = addslashes($_POST['keywords']);
	$header = addslashes($_POST['header']);
	
	if(mysqli_query($c, "UPDATE seo SET title = '$title', description = '$description', keywords = '$keywords', header = '$header' WHERE id = '$id'")){
		header("Location: index.php");
	}else{ 
		//header("Location: error.php");
		echo '<img src="http://'.$_SERVER['SERVER_NAME'].'/images/error.png" style="height:20px;" />&nbsp;&nbsp;Database problem.<br>Contact administrator.';
	}
?>