<?php
	include $_SERVER['DOCUMENT_ROOT'].'/admin/authentication.php';
	include $_SERVER['DOCUMENT_ROOT'].'/admin/utility/configuration.php';
	include $_SERVER['DOCUMENT_ROOT'].'/admin/utility/functions.php';
	$c = connect_to_database();
	$setting = get_settings($c, "SELECT * FROM settings");
	
	$appointments_enabled = isset($_POST['appointments_enabled']) && $_POST['appointments_enabled'] ? 1 : 0;
	$appointments_duration = $_POST['appointments_duration'];
	$appointments_start_time = $_POST['appointments_start_time'];
	$appointments_end_time = $_POST['appointments_end_time'];
	if(mysqli_query($c,
		"UPDATE settings
    	SET value = CASE code
    		WHEN 'appointments_enabled' THEN '$appointments_enabled'
    		WHEN 'appointments_duration' THEN '$appointments_duration'
			WHEN 'appointments_start_time' THEN '$appointments_start_time'
			WHEN 'appointments_end_time' THEN '$appointments_end_time'
		END
		WHERE code IN 
		(
			'appointments_enabled',
			'appointments_duration',
			'appointments_start_time',
			'appointments_end_time'
		)"
	)){ } else { 
		echo '<img src="http://'.$_SERVER['SERVER_NAME'].'/images/error.png" style="height:20px;" />&nbsp;&nbsp;Database problem.<br>Contact wavelinkllc.com administrator.'; exit;
	}
	
	$tStart = strtotime($setting['appointments_start_time']); 
	$tEnd = strtotime($setting['appointments_end_time']); 
	
	for ($day_of_the_week = 0; $day_of_the_week <= 6; $day_of_the_week++) {
		$query = "UPDATE appointments_default SET";
		$tNow = $tStart; 
		while($tNow <= $tEnd){
			$time = date("Hi",$tNow);
			$query .= " `".$time."` = ".(in_array($day_of_the_week, $_POST[$time]) ? 1 : 0).",";
		    $tNow = strtotime('+30 minutes',$tNow);
		}
		$query = (substr($query, -1) == "," ? substr($query, 0, -1) : $query);
		$query .= " WHERE number = $day_of_the_week";
		//echo $query."<br />";
		if(mysqli_query($c, $query)) { } else { 
			echo '<img src="http://'.$_SERVER['SERVER_NAME'].'/images/error.png" style="height:20px;" />&nbsp;&nbsp;Database problem.<br>Contact wavelinkllc.com administrator.'; exit;
		}
	}
	
	header("Location: settings.php");
?>