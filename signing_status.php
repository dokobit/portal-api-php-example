<?php
require_once __DIR__ . '/config/config.php';
require_once __DIR__ . '/config/lib.php';

$signingToken = $argv[1];

//Method will return status of a single signing (completed,pending etc.) with signing information.
$action = 'signing/' . $signingToken . '/status';

$createResponse = request(getApiUrlByAction($action), [], REQUEST_GET);

print_r($createResponse);