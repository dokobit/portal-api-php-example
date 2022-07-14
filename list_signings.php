<?php
require_once __DIR__ . '/config/config.php';
require_once __DIR__ . '/config/lib.php';

//Method will return a list of signings with their statuses (completed|pending).
$action = 'signing/list';
$createResponse = request(getApiUrlByAction($action), [], REQUEST_GET);

print_r($createResponse);