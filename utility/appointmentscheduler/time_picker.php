<?php
	include 'configuration.php';
	include 'database.php';
	$c = connect_to_database();
	
	$date = strtotime($_POST["date"]);
	$number = date( "w", $date);
	$day = date( "j", $date);
	$month = date( "n", $date);
	$year = date( "Y", $date);
	$earliest_time = $_POST["earliest_time"];
	$latest_time = $_POST["latest_time"];
	
	$result = mysqli_query($c, "SELECT * FROM appointments_default WHERE number = '$number'");
	if (!$result) { echo 'Could not load default availability  data.'; exit; }
	$default_availability = mysqli_fetch_assoc($result);
	
	$appointments_result = mysqli_query($c, "SELECT * FROM appointments WHERE day = '$day' AND month = '$month' AND year = '$year'");
	if (!$appointments_result) { echo 'Could not load appointment data.'; exit; }
	$appointments;
	while($appointment = mysqli_fetch_assoc($appointments_result)) {
    	$appointments .= ','.$appointment['times'];
	}
	
    $tStart = strtotime($earliest_time); 
    $tEnd = strtotime($latest_time); 
    $tNow = $tStart; 
    while($tNow <= $tEnd){
    	$time = date("Hi",$tNow);
    	$id = "appointment-time-".$time;
    	$availability_class = "available";
    	
    	if($default_availability[date("Hi",$tNow)] == 0) {
	    	$availability_class = "unavailable";
    	}
    	
    	if (strpos($appointments, date("Hi",$tNow)) !== false) {
	    	$availability_class = "unavailable";
    	}
    	
        echo 
        '<div id="'.$id.'" class="appointment-time '.$availability_class.'" '.($availability_class == "available" ? 'onclick="select_time(\''.$time.'\');"' : '').'>
            <b>'.date("g:i A",$tNow).'</b>
        </div>';
        $tNow = strtotime('+30 minutes',$tNow);
    }

?>