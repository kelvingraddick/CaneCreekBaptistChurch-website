<?php
	include 'configuration.php';
	include 'database.php';
	$c = connect_to_database();
	
	
	
	// APPOINTMENTS_DEFAULT table
	
	if(mysqli_query($c, "CREATE TABLE IF NOT EXISTS `appointments_default` (
								  `name` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
								  `number` int(1) NOT NULL,
								  `0000` tinyint(1) NOT NULL DEFAULT '0',
								  `0030` tinyint(1) NOT NULL DEFAULT '0',
								  `0100` tinyint(1) NOT NULL DEFAULT '0',
								  `0130` tinyint(1) NOT NULL DEFAULT '0',
								  `0200` tinyint(1) NOT NULL DEFAULT '0',
								  `0230` tinyint(1) NOT NULL DEFAULT '0',
								  `0300` tinyint(1) NOT NULL DEFAULT '0',
								  `0330` tinyint(1) NOT NULL DEFAULT '0',
								  `0400` tinyint(1) NOT NULL DEFAULT '0',
								  `0430` tinyint(1) NOT NULL DEFAULT '0',
								  `0500` tinyint(1) NOT NULL DEFAULT '0',
								  `0530` tinyint(1) NOT NULL DEFAULT '0',
								  `0600` tinyint(1) NOT NULL DEFAULT '0',
								  `0630` tinyint(1) NOT NULL DEFAULT '0',
								  `0700` tinyint(1) NOT NULL DEFAULT '0',
								  `0730` tinyint(1) NOT NULL DEFAULT '0',
								  `0800` tinyint(1) NOT NULL DEFAULT '1',
								  `0830` tinyint(1) NOT NULL DEFAULT '1',
								  `0900` tinyint(1) NOT NULL DEFAULT '1',
								  `0930` tinyint(1) NOT NULL DEFAULT '1',
								  `1000` tinyint(1) NOT NULL DEFAULT '1',
								  `1030` tinyint(1) NOT NULL DEFAULT '1',
								  `1100` tinyint(1) NOT NULL DEFAULT '1',
								  `1130` tinyint(1) NOT NULL DEFAULT '1',
								  `1200` tinyint(1) NOT NULL DEFAULT '1',
								  `1230` tinyint(1) NOT NULL DEFAULT '1',
								  `1300` tinyint(1) NOT NULL DEFAULT '1',
								  `1330` tinyint(1) NOT NULL DEFAULT '1',
								  `1400` tinyint(1) NOT NULL DEFAULT '1',
								  `1430` tinyint(1) NOT NULL DEFAULT '1',
								  `1500` tinyint(1) NOT NULL DEFAULT '1',
								  `1530` tinyint(1) NOT NULL DEFAULT '1',
								  `1600` tinyint(1) NOT NULL DEFAULT '1',
								  `1630` tinyint(1) NOT NULL DEFAULT '1',
								  `1700` tinyint(1) NOT NULL DEFAULT '1',
								  `1730` tinyint(1) NOT NULL DEFAULT '1',
								  `1800` tinyint(1) NOT NULL DEFAULT '1',
								  `1830` tinyint(1) NOT NULL DEFAULT '1',
								  `1900` tinyint(1) NOT NULL DEFAULT '1',
								  `1930` tinyint(1) NOT NULL DEFAULT '1',
								  `2000` tinyint(1) NOT NULL DEFAULT '1',
								  `2030` tinyint(1) NOT NULL DEFAULT '0',
								  `2100` tinyint(1) NOT NULL DEFAULT '0',
								  `2130` tinyint(1) NOT NULL DEFAULT '0',
								  `2200` tinyint(1) NOT NULL DEFAULT '0',
								  `2230` tinyint(1) NOT NULL DEFAULT '0',
								  `2300` tinyint(1) NOT NULL DEFAULT '0',
								  `2330` tinyint(1) NOT NULL DEFAULT '0',
								  PRIMARY KEY (`name`),
								  UNIQUE KEY `number` (`number`)
						) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci")) {
		echo "The appointments_default table is ready.<br />";
		
		if(mysqli_num_rows(mysqli_query($c, "SELECT name FROM appointments_default")) <> 7) {
			if(mysqli_query($c, "INSERT INTO `appointments_default` (`name`, `number`, `0000`, `0030`, `0100`, `0130`, `0200`, `0230`, `0300`, `0330`, `0400`, `0430`, `0500`, `0530`, `0600`, `0630`, `0700`, `0730`, `0800`, `0830`, `0900`, `0930`, `1000`, `1030`, `1100`, `1130`, `1200`, `1230`, `1300`, `1330`, `1400`, `1430`, `1500`, `1530`, `1600`, `1630`, `1700`, `1730`, `1800`, `1830`, `1900`, `1930`, `2000`, `2030`, `2100`, `2130`, `2200`, `2230`, `2300`, `2330`) VALUES
								('Sunday', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 0, 0, 0, 0, 0, 0, 0),
								('Monday', 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 0, 0, 0, 0, 0, 0, 0),
								('Tuesday', 2, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 0, 0, 0, 0, 0, 0, 0),
								('Wednesday', 3, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 0, 0, 0, 0, 0, 0, 0),
								('Thursday', 4, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 0, 0, 0, 0, 0, 0, 0),
								('Friday', 5, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 0, 0, 0, 0, 0, 0, 0),
								('Saturday', 6, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 0, 0, 0, 0, 0, 0, 0)")) {		
			} else { echo 'The was a problem inserting the records into the appointments_default table: '.mysqli_error($c).'<br />'; }
		}
						
	} else { echo 'The appointments_default table already exists in database<br />'; }
	
	
	
	// APPOINTMENTS table
	
	if(mysqli_query($c, "CREATE TABLE IF NOT EXISTS `appointments` (
						  `id` bigint(30) NOT NULL AUTO_INCREMENT,
						  `user_id` bigint(30) NOT NULL,
						  `start` varchar(4) COLLATE utf8mb4_unicode_ci NOT NULL,
						  `end` varchar(4) COLLATE utf8mb4_unicode_ci NOT NULL,
						  `times` varchar(1000) COLLATE utf8mb4_unicode_ci NOT NULL,
						  `day` int(2) NOT NULL,
						  `month` int(2) NOT NULL,
						  `year` int(4) NOT NULL,
						  `type` set('none','residential','commercial','repair') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'none',
						  `notes` varchar(1000) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'n/a',
						  PRIMARY KEY (`id`)
						) ENGINE=MyISAM  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=1")) {
		echo "The appointments table is ready.<br />";									
												
	} else { echo 'The appointments table already exists in database<br />'; }
	
	
	
	// USERS table
	
	if(mysqli_query($c, "CREATE TABLE IF NOT EXISTS `users` (
						  `id` bigint(30) NOT NULL AUTO_INCREMENT,
						  `first_name` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'none',
						  `last_name` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'none',
						  `business_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'none',
						  `email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'none',
						  `password` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'wavelink',
						  `phone` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'none',
						  `status` set('hot','cold','paid','unknown','signed') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'hot',
						  `description` varchar(10000) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'none',
						  `url` varchar(1000) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'none',
						  `survey_completed` set('yes','no') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'no',
						  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
						  `date_last_contacted` timestamp NULL DEFAULT NULL,
						  `session` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'none',
						  PRIMARY KEY (`id`),
						  UNIQUE KEY `email` (`email`)
						) ENGINE=MyISAM  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=1")) {
		echo "The users table is ready.<br />";									
												
	} else { echo 'The users table already exists in database<br />'; }

?>