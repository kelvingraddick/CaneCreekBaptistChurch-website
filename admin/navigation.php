<?php
	$url = 'http://' . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
?>
<header>
  <h3><a href="http://www.wavelinkllc.com"><img style="height:75px; position:relative; bottom:10px;" src="http://www.wavelinkllc.com/images/WaveLink_Logo.png" alt="Wave Link, LLC - High-Quality Mobile Apps, Websites, & Graphics" /></a> Administration Panel&nbsp;&nbsp;&middot;&nbsp;&nbsp;<i><?php echo $site_name ?></i></h3>
  <nav class="navbar">
	<ul class="nav navbar-nav">
	  <li><a href="/admin/settings/" <?php if (false === strpos($url,'settings')) { echo 'class="active"'; } ?>>Settings</a></li>
	  <li><a href="/admin/homepage/" <?php if (false === strpos($url,'homepage')) { echo 'class="active"'; } ?>>Content</a></li>
	  <li><a href="/admin/clients/" <?php if (false === strpos($url,'clients')) { echo 'class="active"'; } ?>>Contacts</a></li>
	  <!--<li><a href="/admin/contracts/" <?php if (false === strpos($url,'contracts')) { echo 'class="active"'; } ?>>Contracts</a></li>-->
	  <!--<li><a href="/admin/accounts/" <?php if (false === strpos($url,'accounts')) { echo 'class="active"'; } ?>>Accounts</a></li>-->
	  <!--<li><a href="/admin/products/" <?php if (false === strpos($url,'products')) { echo 'class="active"'; } ?>>Products</a></li>-->
	  <li><a href="/admin/stores/" <?php if (false === strpos($url,'stores')) { echo 'class="active"'; } ?>>Locations</a></li>
	  <li><a href="/admin/categories/" <?php if (false === strpos($url,'categories')) { echo 'class="active"'; } ?>>Categories</a></li>
	  <li><a href="/admin/portfolio/" <?php if (false === strpos($url,'portfolio')) { echo 'class="active"'; } ?>>Gallery</a></li>
	  <li><a href="/admin/blog/" <?php if (false === strpos($url,'blog')) { echo 'class="active"'; } ?>>Events</a></li>
	  <!--<li><a href="/admin/issues/" <?php if (false === strpos($url,'issues')) { echo 'class="active"'; } ?>>Issues</a></li>-->
	  <!--<li><a href="/admin/appointments/" <?php if (false === strpos($url,'appointments')) { echo 'class="active"'; } ?>>Appointments</a></li>-->
	  <li><a href="/admin/seo/" <?php if (false === strpos($url,'seo')) { echo 'class="active"'; } ?>>SEO</a></li>
	  <li><a href="/admin/logout.php" style="color:#e74c3c;">Logout</a></li>
	  <!--<li><button class="btn btn-default btn-sm navbar-btn">Go to website</button></li>-->
	</ul>
  </nav>
</header>