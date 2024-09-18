<?php
	include $_SERVER['DOCUMENT_ROOT'].'/utility/configuration.php';
	include $_SERVER['DOCUMENT_ROOT'].'/utility/functions.php';
	include $_SERVER['DOCUMENT_ROOT'].'/utility/Mobile_Detect.php';
	$c = connect_to_database();
	$setting = get_settings($c, "SELECT * FROM settings");
	$seo = get_seo($c, "giving");
	$metatags = build_metatags($seo, $setting); 
	$detect = new Mobile_Detect; 
	$status = $_GET['status'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php 
		echo $metatags; 
		include '../css/main.php'; 
	?>
</head>
<body>
	<?php include $_SERVER['DOCUMENT_ROOT'].'/header.php'; ?>
	<div class="container">
		<div class="row">
			<div class="col-xs-12 col-md-12">
				<?php
					if($status == "paid") {
						echo 
						"<div class=\"title text-uppercase\">
							God bless you! Your donation, tithe, or offering has been received.
						</div>";
					}
				?>
				<div class="title text-uppercase"><i class="fa fa-user"></i>&nbsp;&nbsp;Online Giving</div>
			</div>
		</div>
		<div class="row">
			<div class="col-xs-12 col-md-6">
				<div class="blog_box">
					<div class="blog_header">
						PayPal
					</div>
					<div class="blog_content">
						Select the type of giving and amount below; you will be able to enter your name and other information once you are directed to <b>PayPal</b>.
						<br />
						<br />
						<form id="payment_form" action="https://www.paypal.com/cgi-bin/webscr" method="post">
							<input type="hidden" name="cmd" value="_cart">
					        Type of giving:&nbsp;&nbsp;
					        <select name="item_name_1">
					        	<option value="Donation">Donation</option>
								<option value="Tithe">Tithe</option>
								<option value="Offering">Offering</option>
							</select><br />
							<input type="hidden" name="item_number_1" value="1">
					        Amount:&nbsp;&nbsp; 
					        <input type="input" name="amount_1" value="" class="search_box" style="width:25%;" required><br />
							<input type="hidden" name="upload" value="1" />
							<input type="hidden" name="currency_code" value="USD">
							<input type="hidden" name="no_shipping" value="0">
							<input type="hidden" name="return" value="http://<?php echo $_SERVER['HTTP_HOST']; ?>/giving/?status=paid">
							<input type="hidden" name="cancel_return" value="http://<?php echo $_SERVER['HTTP_HOST']; ?>/giving/">
							<input type="hidden" name="business" value="<?php echo $setting['email']; ?>">
							<input type="hidden" name="cpp_cart_border_color" value="D64541">
							<input type="submit" value="CONTINUE" class="search_box_button">
						</form>
					</div>
				</div>
			</div>
			<div class="col-xs-12 col-md-6">
				<div class="blog_box">
					<div class="blog_header">
						Cash App
					</div>
					<div class="blog_content">
						To give using the <b>Cash App</b> mobile app, follow these instructions:<br />
						- Download and/or open the "Cash App" mobile app: <a href="https://cash.app/$ccmbc30293" target="_blank" style="color: #515151 !important; text-decoration: underline !important;">https://cash.app/$ccmbc30293</a><br />
						- Sign up and setup payment method using the instructions in the app<br />
						- Type in the amount to give; tap "Pay"<br />
						- Enter <b>$ccmbc30293</b> in the "To" field<br />
						- Enter the type of giving in the "For" field (Donation, Tithe, Offering)<br />
						- Tap "Pay"<br />
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-xs-12 col-md-12">
				<br />
			</div>
		</div>
	</div>
	<?php include $_SERVER['DOCUMENT_ROOT'].'/footer.php'; ?>
	<?php include '../js/main.php'; ?>
	<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.13.1/jquery.validate.min.js"></script>
	<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.13.1/additional-methods.min.js"></script>
	<script>
		$("#payment_form").validate({
			rules: {
				amount_1: {
					number: true
				}
			}
		});
	</script>
</body>
</html>