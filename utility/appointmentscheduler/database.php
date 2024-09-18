<?php
	
	function connect_to_database() {
		$c = mysqli_connect(
			$GLOBALS['db_host'], 
			$GLOBALS['db_username'], 
			$GLOBALS['db_password'], 
			$GLOBALS['db_name']
		)or die("<br/>Appointment Scheduler: Cannot connect to the database. Please verify that the database credentials are correct in configuration.php<br/>");
		mysqli_set_charset($c, "utf8mb4");
		return $c;
	}
	
	function mysqli_result($res,$row=0,$col=0){ 
	    $numrows = mysqli_num_rows($res); 
	    if ($numrows && $row <= ($numrows-1) && $row >=0){
	        mysqli_data_seek($res,$row);
	        $resrow = (is_numeric($col)) ? mysqli_fetch_row($res) : mysqli_fetch_assoc($res);
	        if (isset($resrow[$col])){
	            return $resrow[$col];
	        }
	    }
	    return false;
	}
	
?>