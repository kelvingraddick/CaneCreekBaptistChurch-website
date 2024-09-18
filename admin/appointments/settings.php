<?php
	include $_SERVER['DOCUMENT_ROOT'].'/admin/authentication.php';
	include $_SERVER['DOCUMENT_ROOT'].'/admin/utility/configuration.php';
	include $_SERVER['DOCUMENT_ROOT'].'/admin/utility/functions.php';
	$c = connect_to_database();
	$setting = get_settings($c, "SELECT * FROM settings");
	$tStart = strtotime($setting['appointments_start_time']); 
	$tEnd = strtotime($setting['appointments_end_time']); 
?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title><?php echo $site_name ?> - Appointment Settings</title>
	
	<link rel="stylesheet" href="http://canecreekbaptistchurchga.org/admin/css/tictail/tt-uikit-0.11.0.min.css">
</head>
<body>
	<div class="app-container" style="max-width:100%;">
		<?php include '../navigation.php'; ?>
	
		<header>
		  <a href="../appointments/" class="btn btn-link">&larr; Go back to appointments</a>
		  <h3>Appointment Settings</h3>
		</header>	
	
		<form class="form-grouped" action="save_availability.php" method="post" enctype="multipart/form-data" data-validate>		
		  <fieldset>
			<legend>General Settings</legend>
			<div class="row form-group">
			  <div class="col-md-3 col-xs-3">
				<label>Enabled?</label><br />
			    <div class="switch">
				 <input name="appointments_enabled" type="checkbox" <?php if($setting["appointments_enabled"] == 1) { echo 'checked'; } ?>>
			    </div>
			  </div>
			  <div class="col-md-3 col-xs-3">
				<label>Appointment Length</label>
				<select name="appointments_duration">
				    <option value="0030" <?php echo ($setting['appointments_duration'] == "0030" ? "selected" : ""); ?>>30 minutes</option>
				    <option value="0100" <?php echo ($setting['appointments_duration'] == "0100" ? "selected" : ""); ?>>1 hour</option>
				    <option value="0130" <?php echo ($setting['appointments_duration'] == "0130" ? "selected" : ""); ?>>1.5 hours</option>
				    <option value="0200" <?php echo ($setting['appointments_duration'] == "0200" ? "selected" : ""); ?>>2 hours</option>
				    <option value="0230" <?php echo ($setting['appointments_duration'] == "0230" ? "selected" : ""); ?>>2.5 hours</option>
				    <option value="0300" <?php echo ($setting['appointments_duration'] == "0300" ? "selected" : ""); ?>>3 hours</option>
				    <option value="0330" <?php echo ($setting['appointments_duration'] == "0330" ? "selected" : ""); ?>>3.5 hours</option>
				    <option value="0400" <?php echo ($setting['appointments_duration'] == "0400" ? "selected" : ""); ?>>4 hours</option>
				    <option value="0430" <?php echo ($setting['appointments_duration'] == "0430" ? "selected" : ""); ?>>4.5 hours</option>
				    <option value="0500" <?php echo ($setting['appointments_duration'] == "0500" ? "selected" : ""); ?>>5 hours</option>
				    <option value="0530" <?php echo ($setting['appointments_duration'] == "0530" ? "selected" : ""); ?>>5.5 hours</option>
				    <option value="0600" <?php echo ($setting['appointments_duration'] == "0600" ? "selected" : ""); ?>>6 hours</option>
				    <option value="0630" <?php echo ($setting['appointments_duration'] == "0630" ? "selected" : ""); ?>>6.5 hours</option>
				    <option value="0700" <?php echo ($setting['appointments_duration'] == "0700" ? "selected" : ""); ?>>7 hours</option>
				    <option value="0730" <?php echo ($setting['appointments_duration'] == "0730" ? "selected" : ""); ?>>7.5 hours</option>
				    <option value="0800" <?php echo ($setting['appointments_duration'] == "0800" ? "selected" : ""); ?>>8 hours</option>
				</select>
			  </div>
			  <div class="col-md-3 col-xs-3">
				<label>Earliest Time</label>
				<select name="appointments_start_time">
				    <?php
				    	$dayStart = strtotime("00:00"); 
						$dayEnd = strtotime("23:30"); 
				    	$dayNow = $dayStart;
					    while($dayNow <= $dayEnd){
					        echo '<option value="'.date("H:i",$dayNow).'" '.($setting['appointments_start_time'] == date("H:i",$dayNow) ? "selected" : "").'>'.date("g:i A",$dayNow).'</option>';
					        $dayNow = strtotime('+30 minutes',$dayNow);
					    }
				    ?>
				</select>
			  </div>
			  <div class="col-md-3 col-xs-3">
				<label>Latest Time</label>
				<select name="appointments_end_time">
				    <?php
				    	$dayStart = strtotime("00:00"); 
						$dayEnd = strtotime("23:30"); 
				    	$dayNow = $dayStart;
					    while($dayNow <= $dayEnd){
					        echo '<option value="'.date("H:i",$dayNow).'" '.($setting['appointments_end_time'] == date("H:i",$dayNow) ? "selected" : "").'>'.date("g:i A",$dayNow).'</option>';
					        $dayNow = strtotime('+30 minutes',$dayNow);
					    }
				    ?>
				</select>
			  </div>
			</div>
		  </fieldset>
		  <fieldset>
			<legend>Default Availability</legend>
			<div class="row form-group">
			  <div class="col-md-12 col-xs-12">
			  	<label>Sunday</label>
			  </div>
			  <div class="col-md-2 col-xs-2">
			  	<?php
				    $day = "0";
				    $result = mysqli_query($c, "SELECT * FROM appointments_default WHERE number = '$day'");
					if (!$result) { echo 'Could not load default availability data.'; exit; }
					$default_availability = mysqli_fetch_assoc($result);
				    $tNow = $tStart;
				    $count = 1; 
				    while($tNow <= $tEnd){
				    	$time = date("Hi",$tNow);
				    	$id = $day."-".$time;
				    	$name = $time."[]";
				        echo 
				        '<div class="checkbox">
							<input type="checkbox" id="'.$id.'" name="'.$name.'" value="'.$day.'" '.($default_availability[$time] == 1 ? "checked" : "").'>
							<label for="'.$id.'">'.date("g:i A",$tNow).'</label>
						</div>';
				        $tNow = strtotime('+30 minutes',$tNow);
				        if($count == 8) {
					        echo '</div><div class="col-md-2 col-xs-2">';
					    	$count = 1;
				        } else {
					        $count++;
				        }
				    }
			  	?>
			  </div>
			</div>
			<div class="row form-group">
			  <div class="col-md-12 col-xs-12">
			  	<label>Monday</label>
			  </div>
			  <div class="col-md-2 col-xs-2">
			  	<?php
				    $day = "1";
				    $result = mysqli_query($c, "SELECT * FROM appointments_default WHERE number = '$day'");
					if (!$result) { echo 'Could not load default availability data.'; exit; }
					$default_availability = mysqli_fetch_assoc($result);
				    $tNow = $tStart;
				    $count = 1; 
				    while($tNow <= $tEnd){
				    	$time = date("Hi",$tNow);
				    	$id = $day."-".$time;
				    	$name = $time."[]";
				        echo 
				        '<div class="checkbox">
							<input type="checkbox" id="'.$id.'" name="'.$name.'" value="'.$day.'" '.($default_availability[$time] == 1 ? "checked" : "").'>
							<label for="'.$id.'">'.date("g:i A",$tNow).'</label>
						</div>';
				        $tNow = strtotime('+30 minutes',$tNow);
				        if($count == 8) {
					        echo '</div><div class="col-md-2 col-xs-2">';
					    	$count = 1;
				        } else {
					        $count++;
				        }
				    }
			  	?>
			  </div>
			</div>
			<div class="row form-group">
			  <div class="col-md-12 col-xs-12">
			  	<label>Tuesday</label>
			  </div>
			  <div class="col-md-2 col-xs-2">
			  	<?php
				    $day = "2";
				    $result = mysqli_query($c, "SELECT * FROM appointments_default WHERE number = '$day'");
					if (!$result) { echo 'Could not load default availability data.'; exit; }
					$default_availability = mysqli_fetch_assoc($result);
				    $tNow = $tStart;
				    $count = 1; 
				    while($tNow <= $tEnd){
				    	$time = date("Hi",$tNow);
				    	$id = $day."-".$time;
				    	$name = $time."[]";
				        echo 
				        '<div class="checkbox">
							<input type="checkbox" id="'.$id.'" name="'.$name.'" value="'.$day.'" '.($default_availability[$time] == 1 ? "checked" : "").'>
							<label for="'.$id.'">'.date("g:i A",$tNow).'</label>
						</div>';
				        $tNow = strtotime('+30 minutes',$tNow);
				        if($count == 8) {
					        echo '</div><div class="col-md-2 col-xs-2">';
					    	$count = 1;
				        } else {
					        $count++;
				        }
				    }
			  	?>
			  </div>
			</div>
			<div class="row form-group">
			  <div class="col-md-12 col-xs-12">
			  	<label>Wednesday</label>
			  </div>
			  <div class="col-md-2 col-xs-2">
			  	<?php
				    $day = "3";
				    $result = mysqli_query($c, "SELECT * FROM appointments_default WHERE number = '$day'");
					if (!$result) { echo 'Could not load default availability data.'; exit; }
					$default_availability = mysqli_fetch_assoc($result);
				    $tNow = $tStart;
				    $count = 1; 
				    while($tNow <= $tEnd){
				    	$time = date("Hi",$tNow);
				    	$id = $day."-".$time;
				    	$name = $time."[]";
				        echo 
				        '<div class="checkbox">
							<input type="checkbox" id="'.$id.'" name="'.$name.'" value="'.$day.'" '.($default_availability[$time] == 1 ? "checked" : "").'>
							<label for="'.$id.'">'.date("g:i A",$tNow).'</label>
						</div>';
				        $tNow = strtotime('+30 minutes',$tNow);
				        if($count == 8) {
					        echo '</div><div class="col-md-2 col-xs-2">';
					    	$count = 1;
				        } else {
					        $count++;
				        }
				    }
			  	?>
			  </div>
			</div>
			<div class="row form-group">
			  <div class="col-md-12 col-xs-12">
			  	<label>Thursday</label>
			  </div>
			  <div class="col-md-2 col-xs-2">
			  	<?php
				    $day = "4";
				    $result = mysqli_query($c, "SELECT * FROM appointments_default WHERE number = '$day'");
					if (!$result) { echo 'Could not load default availability data.'; exit; }
					$default_availability = mysqli_fetch_assoc($result);
				    $tNow = $tStart;
				    $count = 1; 
				    while($tNow <= $tEnd){
				    	$time = date("Hi",$tNow);
				    	$id = $day."-".$time;
				    	$name = $time."[]";
				        echo 
				        '<div class="checkbox">
							<input type="checkbox" id="'.$id.'" name="'.$name.'" value="'.$day.'" '.($default_availability[$time] == 1 ? "checked" : "").'>
							<label for="'.$id.'">'.date("g:i A",$tNow).'</label>
						</div>';
				        $tNow = strtotime('+30 minutes',$tNow);
				        if($count == 8) {
					        echo '</div><div class="col-md-2 col-xs-2">';
					    	$count = 1;
				        } else {
					        $count++;
				        }
				    }
			  	?>
			  </div>
			</div>
			<div class="row form-group">
			  <div class="col-md-12 col-xs-12">
			  	<label>Friday</label>
			  </div>
			  <div class="col-md-2 col-xs-2">
			  	<?php
				    $day = "5";
				    $result = mysqli_query($c, "SELECT * FROM appointments_default WHERE number = '$day'");
					if (!$result) { echo 'Could not load default availability data.'; exit; }
					$default_availability = mysqli_fetch_assoc($result);
				    $tNow = $tStart;
				    $count = 1; 
				    while($tNow <= $tEnd){
				    	$time = date("Hi",$tNow);
				    	$id = $day."-".$time;
				    	$name = $time."[]";
				        echo 
				        '<div class="checkbox">
							<input type="checkbox" id="'.$id.'" name="'.$name.'" value="'.$day.'" '.($default_availability[$time] == 1 ? "checked" : "").'>
							<label for="'.$id.'">'.date("g:i A",$tNow).'</label>
						</div>';
				        $tNow = strtotime('+30 minutes',$tNow);
				        if($count == 8) {
					        echo '</div><div class="col-md-2 col-xs-2">';
					    	$count = 1;
				        } else {
					        $count++;
				        }
				    }
			  	?>
			  </div>
			</div>
			<div class="row form-group">
			  <div class="col-md-12 col-xs-12">
			  	<label>Saturday</label>
			  </div>
			  <div class="col-md-2 col-xs-2">
			  	<?php
				    $day = "6";
				    $result = mysqli_query($c, "SELECT * FROM appointments_default WHERE number = '$day'");
					if (!$result) { echo 'Could not load default availability data.'; exit; }
					$default_availability = mysqli_fetch_assoc($result);
				    $tNow = $tStart;
				    $count = 1; 
				    while($tNow <= $tEnd){
				    	$time = date("Hi",$tNow);
				    	$id = $day."-".$time;
				    	$name = $time."[]";
				        echo 
				        '<div class="checkbox">
							<input type="checkbox" id="'.$id.'" name="'.$name.'" value="'.$day.'" '.($default_availability[$time] == 1 ? "checked" : "").'>
							<label for="'.$id.'">'.date("g:i A",$tNow).'</label>
						</div>';
				        $tNow = strtotime('+30 minutes',$tNow);
				        if($count == 8) {
					        echo '</div><div class="col-md-2 col-xs-2">';
					    	$count = 1;
				        } else {
					        $count++;
				        }
				    }
			  	?>
			  </div>
			</div>
		  </fieldset>
		  <div class="form-actions">
			<a href="../appointments/" class="btn btn-danger">Cancel</a>
			<button type="submit" class="btn btn-primary">Save</button>
		  </div>
		</form>
		
		<br /><br />
		
	<script src="http://code.jquery.com/jquery-1.10.1.min.js"></script>
	<script src="http://canecreekbaptistchurchga.org/admin/js/tictail/tt-uikit-0.11.0.min.js"></script>  
	<script src="http://canecreekbaptistchurchga.org/admin/js/tictail/tt.js"></script>  
</body>
</html>