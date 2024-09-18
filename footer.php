<div class="row footer">
	<div class="col-xs-12 col-md-12">
		<div class="container">
			<div class="row">
				<div class="col-xs-12 col-md-3 footer_div">
					<div class="footer_title text-uppercase">Info</div>
					<div class="footer_link text-uppercase">&copy <?php echo date("Y")." ".$site_name; ?></div>
					<i>Powered by</i><br /><a href="http://www.wavelinkllc.com/" target="_blank"><img class="wavelink_logo" src="http://www.wavelinkllc.com/images/WaveLink_Logo_white.png" alt="Wave Link, LLC"></a>
				</div>
				<div class="col-xs-12 col-md-3 footer_div">
					<div class="footer_title text-uppercase">Map</div>
					<div class="footer_link text-uppercase"><a href="http://<?php echo $_SERVER['SERVER_NAME']; ?>/" style="color:white;">Home</a></div>
					<div class="footer_link text-uppercase"><a href="http://<?php echo $_SERVER['SERVER_NAME']; ?>/mission/" style="color:white;">Mission</a></div>
					<div class="footer_link text-uppercase"><a href="http://<?php echo $_SERVER['SERVER_NAME']; ?>/events/" style="color:white;">Events</a></div>
					<div class="footer_link text-uppercase"><a href="http://<?php echo $_SERVER['SERVER_NAME']; ?>/gallery/" style="color:white;">Gallery</a></div>
					<div class="footer_link text-uppercase"><a href="http://<?php echo $_SERVER['SERVER_NAME']; ?>/contact/" style="color:white;">Contact</a></div>
				</div>
				<div class="col-xs-12 col-md-3 footer_div">
					<div class="footer_title text-uppercase">Social</div>
					<h4>
						<i class="fa fa-facebook" onclick="location.href='<?php echo $setting['facebook_link']; ?>';"></i><br />
						<i class="fa fa-twitter" onclick="location.href='<?php echo $setting['twitter_link']; ?>';"></i><br />
					</h4>
				</div>
				<div class="col-xs-12 col-md-3 footer_div">
					<div class="footer_title text-uppercase">Contact Us</div>
					<div class="footer_link text-uppercase"><?php echo $setting['email']; ?></div>
					<div class="footer_link text-uppercase"><?php echo $setting['phone']; ?></div>
					<iframe width="150" height="150" frameborder="0" style="border:0" src="https://www.google.com/maps/embed/v1/place?q=<?php echo str_replace(" ", "+", $setting['address1']." ".$setting['address2']." ".$setting['city'].",".$setting['state']." ".$setting['zip']); ?>&key=AIzaSyClRHLbLGnnFsMAj9MJWj_ouXxXI9w-kOQ"></iframe>
				</div>
			</div>
		</div>
	</div>
</div>