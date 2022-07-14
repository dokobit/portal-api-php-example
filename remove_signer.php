<?php
require_once __DIR__ . '/config/config.php';
require_once __DIR__ . '/config/lib.php';

$signers = [];

//Token of the Signing that we will be removing signer from.
$signingToken = $argv[1];

//Signer's, that we will be removing from the Signing, tokens.
$signers = [
	[
		'token' => $argv[2]
	]
];

$action = 'signing/' . $signingToken . '/signers/delete';

$createResponse = request(getApiUrlByAction($action), [
	'signers' => $signers,
], REQUEST_POST);

if ($createResponse['status'] != 'ok') {
	print_r($createResponse);
    echo "Signer could not be removed from the signing." . PHP_EOL;
    exit;
}
print_r($createResponse);

//Output URL to check signing status.
print("Signing status can be checked here \n");
print(getApiUrlByAction('signing/' . $signingToken . '/status')) . PHP_EOL;