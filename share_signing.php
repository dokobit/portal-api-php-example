<?php
require_once __DIR__ . '/config/config.php';
require_once __DIR__ . '/config/lib.php';

//Token of the Signing that will be shared.
$signingToken = $argv[1];

// Add as many signers as you need.
$signers = [
    [  
        'name' => 'Test',
        'surname' => 'Signer',
        // Required if code is not set - If email is set, user would get email notification to sign.
        'email' => 'test+share@dokobit.com',
        // Role can be signer,viewer or approver
        'role' => 'signer',
        // Optional parameters
        'company' => 'Example Company',
        'position' => 'Employee'
    ]
];

$action = 'signing/' . $signingToken . '/share';
$createResponse = request(getApiUrlByAction($action), [
	'signers' => $signers,
	'comment' => "This is a message that signer will get"
], REQUEST_POST);

if ($createResponse['status'] != 'ok') {
	print_r($createResponse);
    echo "Signing could not be shared." . PHP_EOL;
    exit;
}
print_r($createResponse);

//Output URL to check signing status.
print("Signing status can be checked here \n");
print(getApiUrlByAction('signing/' . $signingToken . '/status')) . PHP_EOL;