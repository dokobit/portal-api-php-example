<?php
require_once __DIR__ . '/config/config.php';
require_once __DIR__ . '/config/lib.php';

//Token of the signing.
$signingToken = $argv[1];

//Define which method will be used.
$type = ($argv[2] == "all") ? "-all" : "";

/**
* delete-all - Delete signing from your account and other signer's accounts that have not signed the document yet.
* delete - Delete signing from your account only.
*/
$action = 'signing/' . $signingToken . '/delete' . $type;
$createResponse = request(getApiUrlByAction($action), [], REQUEST_POST);

print_r($createResponse);