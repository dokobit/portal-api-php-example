<?php
require_once __DIR__ . '/config/config.php';
require_once __DIR__ . '/config/lib.php';

//Token of the Signing.
$signingToken = $argv[1];

//Token of the Signer that needs a reminder to be sent.
$signer = $argv[2];

$action = 'signing/' . $signingToken . '/remind';

$createResponse = request(getApiUrlByAction($action), [
	'signer' => $signer,
    'message' => 'This is a message included in the reminder e-mail'
], REQUEST_POST);

if ($createResponse['status'] != 'ok') {
	print_r($createResponse);
    echo "Reminder could not be sent." . PHP_EOL;
    exit;
}
print_r($createResponse);