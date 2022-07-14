<?php

$apiUrl = 'https://beta.dokobit.com';

//Your access token
$accessToken = 'your-access-token';
if (empty($accessToken)) {
		echo "Access token is required at line 6.\n";
		exit;
}

/**
 * Type in your publicly available postback URL (http://your-public-host/postback-handler.php)
 * You can find an example code snippet in postback-handler.php
 */
$postback_url = 'http://your-public-host/postback-handler.php';