<div class="row banner">
	<div class="col-xs-hide col-md-12">
		<div class="container">
			<div class="row">
				<div class="col-xs-hide col-md-5">
					<form action="http://<?php echo $_SERVER['SERVER_NAME']; ?>/products/" method="post">
						<table>
							<tr>
								<td>
									<input name="search" type="text" id="search_box" class="search_box" <?php echo ($search <> "" ? "value=\"".$search."\"" : ""); ?> /> 
								</td>
								<td>
									<button id="search_box_button" class="search_box_button"><i class="fa fa-search"></i>&nbsp;SEARCH</button>
								</td>
							</tr>
						</table>
					</form>
				</div>
				<div class="col-xs-hide col-md-6 banner_link_div text-uppercase">
					<a href="http://<?php echo $_SERVER['SERVER_NAME']; ?>/giving/"><i class="fa fa-money"></i>&nbsp;&nbsp;Online Giving</a>
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<a href="http://<?php echo $_SERVER['SERVER_NAME']; ?>/contact/"><i class="fa fa-map-marker"></i>&nbsp;&nbsp;Times & Locations</a>
				</div>
				<div class="col-xs-hide col-md-1 banner_social_div">
					<i class="fa fa-facebook" onclick="location.href='<?php echo $setting['facebook_link']; ?>';"></i>&nbsp;&nbsp;
					<i class="fa fa-twitter" onclick="location.href='<?php echo $setting['twitter_link']; ?>';"></i>&nbsp;&nbsp;
				</div>
			</div>
		</div>
	</div>
</div>
<div class="container">
	<div id="navigation_panel" class="navigation_panel">
		<div class="row">
			<div class="col-xs-12 col-md-hide mobile_navigation_button text-uppercase"><a href="http://<?php echo $_SERVER['SERVER_NAME']; ?>/">Home</a></div>
			<div class="col-xs-12 col-md-hide mobile_navigation_button text-uppercase"><a href="http://<?php echo $_SERVER['SERVER_NAME']; ?>/mission/">Mission</a></div>
			<div class="col-xs-12 col-md-hide mobile_navigation_button text-uppercase"><a href="http://<?php echo $_SERVER['SERVER_NAME']; ?>/events/">Events</a></div>
			<div class="col-xs-12 col-md-hide mobile_navigation_button text-uppercase"><a href="http://<?php echo $_SERVER['SERVER_NAME']; ?>/gallery/">Gallery</a></div>
			<div class="col-xs-12 col-md-hide mobile_navigation_button text-uppercase"><a href="http://<?php echo $_SERVER['SERVER_NAME']; ?>/contact/">Contact</a></div>
		</div>
	</div>
	<div class="row">
		<div class="col-xs-12 col-md-4">
			<div class="row">
				<div class="col-xs-4 col-md-4 logo_div">
					<a href="http://<?php echo $_SERVER['SERVER_NAME']; ?>/"><img class="logo_img" src="<?php echo $setting['logo']; ?>" /></a>
				</div>
				<div class="col-xs-8 col-md-8 logo_text_div text-uppercase">
					Cane Creek <p>Baptist Church</p>
				</div>
			</div>
		</div>
		<div class="col-xs-hide col-md-8 navigation_button text-uppercase">
			<a href="http://<?php echo $_SERVER['SERVER_NAME']; ?>/">Home</a>&nbsp;&nbsp;&nbsp;&nbsp;
			<a href="http://<?php echo $_SERVER['SERVER_NAME']; ?>/mission/">Mission</a>&nbsp;&nbsp;&nbsp;&nbsp;
			<a href="http://<?php echo $_SERVER['SERVER_NAME']; ?>/events/">Events</a>&nbsp;&nbsp;&nbsp;&nbsp;
			<a href="http://<?php echo $_SERVER['SERVER_NAME']; ?>/gallery/">Gallery</a>&nbsp;&nbsp;&nbsp;&nbsp;
			<a href="http://<?php echo $_SERVER['SERVER_NAME']; ?>/contact/">Contact</a>
		</div>
	</div>
	<div class="mobile_link_div">
		<a href="http://<?php echo $_SERVER['SERVER_NAME']; ?>/giving/"><i class="fa fa-money"></i></a>
		<a href="http://<?php echo $_SERVER['SERVER_NAME']; ?>/contact/"><i class="fa fa-map-marker"></i></a>
	</div>
	<div class="navicon_button" onclick="toggle_navigation_panel();">
		<i class="fa fa-navicon"></i>
	</div>
</div>
<script>
	function toggle_navigation_panel() {
	    $("#navigation_panel").slideToggle();
	}
</script>