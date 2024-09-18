<?php

function connect_to_database() {
	// Connect to server and select databse.
	$c = mysqli_connect($GLOBALS['database_host'], 
						$GLOBALS['database_username'], 
						$GLOBALS['database_password'], 
						$GLOBALS['database_name'])
						or die("Cannot connect to database."); 
	mysqli_set_charset($c, "utf8mb4");
	return $c;
}

function get_settings($c, $sql) {
	$settings = mysqli_query($c, "SELECT * FROM settings");
	if (!$settings) { echo 'Could not load settings data.'; exit; }
	$setting = array(); 
	while($row = mysqli_fetch_assoc($settings)) { 
		$setting[$row['code']] = $row['value']; 
	}
	return $setting;
}

function get_seo($c, $page) {
	$row = mysqli_fetch_assoc(mysqli_query($c, "SELECT * FROM seo WHERE page='$page'"));
	if (!$row) { return; }
	return $row;
}

function build_metatags($seo, $setting) {
	$metatags = <<< EOF
	    		<title>{title}</title>
				<meta name="description" content="{description}">
				<meta name="keywords" content="{keywords}">
				<meta name="author" content="{title}">
				<meta name="robots" content="index, follow">
				<meta property="og:description" content="{description}" />
				<meta property="og:image" content="{logo}" />
				<meta property="og:image:type" content="image/png" />
				<meta property="og:title" content="{title}" />
				<meta property="og:url" content="{url}" />
				<meta property="og:site_name" content="{title}" />
				<meta property="og:type" content="company" />
				<meta name="twitter:card" content="summary_large_image">
				<meta name="twitter:site" content="{twitter}">
				<meta name="twitter:creator" content="{twitter}">
				<meta name="twitter:title" content="{title}">
				<meta name="twitter:description" content="{description}">
				<meta name="twitter:image:src" content="{logo}">
EOF;
	$metatags = str_replace("{title}", $seo['title'], $metatags);
	$metatags = str_replace("{description}", $seo['description'], $metatags); 
	$metatags = str_replace("{keywords}", $seo['keywords'], $metatags);
	$metatags = str_replace("{logo}", "http://".$_SERVER['HTTP_HOST'].$setting['logo'], $metatags);
	$metatags = str_replace("{url}", "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'], $metatags);
	$metatags = str_replace("{twitter}", $setting['twitter_link'], $metatags);
	return $metatags;
}

function mysqli_result($mysqli, $sql) {
    $result = $mysqli->query($sql);
    $value = $result->fetch_array(MYSQLI_NUM);
    return is_array($value) ? $value[0] : "";
}

function getExtension($str) {
	$i = strrpos($str,".");
	if (!$i) { return ""; } 
	$l = strlen($str) - $i;
	$ext = substr($str,$i+1,$l);
	return $ext;
}

function reArrayFiles(&$file_post) {
    $file_ary = array();
    $file_count = count($file_post['name']);
    $file_keys = array_keys($file_post);
    for ($i=0; $i<$file_count; $i++) {
        foreach ($file_keys as $key) {
            $file_ary[$i][$key] = $file_post[$key][$i];
        }
    }
    return $file_ary;
}

function check_email($email) {
  // First, we check that there's one @ symbol, 
  // and that the lengths are right.
  if (!ereg("^[^@]{1,64}@[^@]{1,255}$", $email)) {
    // Email invalid because wrong number of characters 
    // in one section or wrong number of @ symbols.
    return false;
  }
  // Split it into sections to make life easier
  $email_array = explode("@", $email);
  $local_array = explode(".", $email_array[0]);
  for ($i = 0; $i < sizeof($local_array); $i++) {
    if
(!ereg("^(([A-Za-z0-9!#$%&'*+/=?^_`{|}~-][A-Za-z0-9!#$%&
↪'*+/=?^_`{|}~\.-]{0,63})|(\"[^(\\|\")]{0,62}\"))$",
$local_array[$i])) {
      return false;
    }
  }
  // Check if domain is IP. If not, 
  // it should be valid domain name
  if (!ereg("^\[?[0-9\.]+\]?$", $email_array[1])) {
    $domain_array = explode(".", $email_array[1]);
    if (sizeof($domain_array) < 2) {
        return false; // Not enough parts to domain
    }
    for ($i = 0; $i < sizeof($domain_array); $i++) {
      if
(!ereg("^(([A-Za-z0-9][A-Za-z0-9-]{0,61}[A-Za-z0-9])|
↪([A-Za-z0-9]+))$",
$domain_array[$i])) {
        return false;
      }
    }
  }
  return true;
}

?>