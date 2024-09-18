<?php
	include 'configuration.php';
	include 'database.php';
	$c = connect_to_database();

	$first_name=addslashes($_POST['first_name']); if($first_name==""){ $first_name = "none"; }
	$last_name=addslashes($_POST['last_name']); if($last_name==""){ $last_name = "none"; }
	$email=addslashes($_POST['email']); if($email==""){ $email = "none"; }
	$phone=addslashes($_POST['phone']); if($phone==""){ $phone = "none"; }
	$day=$_POST['day'];
	$month=$_POST['month'];
	$year=$_POST['year'];
	$times=$_POST['times'];
	$start=$_POST['start'];
	$end=$_POST['end'];
	$type=$_POST['type']; if($type==""){ $type = "none"; }
	$notes=addslashes($_POST['notes']); if($notes==""){ $notes = "none"; }
		
	$user_id = mysqli_result(mysqli_query($c, "SELECT id FROM `users` WHERE (email = '$email' AND email <> 'none') OR (phone = '$phone' AND phone <> 'none')"));
	if(!$user_id) {
		if(mysqli_query($c, "insert into users(first_name, last_name, email, phone) values('$first_name', '$last_name', '$email', '$phone')")){ } else { }
		$user_id = mysqli_insert_id($c);
	}
		
	if(mysqli_query($c, "insert into appointments(user_id, start, end, times, day, month, year, type, notes) values('$user_id', '$start', '$end', '$times', '$day', '$month', '$year', '$type', '$notes')")){
		$id = mysqli_insert_id($c);
		
		$subject = $business_name." - New appointment";
		$body = "<b>Appointment Details</b><br />
				Appointment Id: ".$id."<br />
				First Name: ".$first_name."<br />
				Last Name: ".$last_name."<br />
				Email: ".$email."<br />
				Phone: ".$phone."<br />
				Date: ".$month."-".$day."-".$year."<br />
				Time: ".$start."-".$end."<br />
				Type: ".$type."<br />
				Notes: ".$notes;
		$headers = "MIME-Version: 1.0" . "\r\n";
		$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
		$headers .= 'From: ' .$business_name. ' Appointments <' .$appointment_email. '>' . "\r\n";
		mail($appointment_email,$subject,$body,$headers);
		
		//Send email to user			
		$to = $email;
		$subject = $business_name." - Your appointment has been set!";
		$body = "Thank you for setting up an appointment with ".$business_name."!<br />
				Please keep your appointment id handy. We will be contacting you shortly.<br /><br />
				<b>Appointment Details</b><br />
				Appointment Id: ".$id."<br />
				First Name: ".$first_name."<br />
				Last Name: ".$last_name."<br />
				Email: ".$email."<br />
				Phone: ".$phone."<br />
				Date: ".$month."-".$day."-".$year."<br />
				Time: ".$start."-".$end."<br />
				Type: ".$type."<br />
				Notes: ".$notes;
		mail($to,$subject,$body,$headers);

		echo $body;			
	}else{
		echo "ERROR";
	}

?>