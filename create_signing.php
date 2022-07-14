<?php
require_once __DIR__ . '/config/config.php';
require_once __DIR__ . '/config/lib.php';

$fileLocation = __DIR__ . '/Resources/test.pdf';

/**
 * File details
 */

//For 'pdf' type - only one file is supported.
$files = [
    [
        'name' => basename($fileLocation),
        'digest' => hash_file('sha256', $fileLocation),
        'content'=> base64_encode(file_get_contents($fileLocation))
    ]
];

/**
* Signer details
*/

//Add as many signers as you need.
$signers = [
    [  
        'name' => 'First',
        'surname' => 'Signer',
        // Required if code is not set - If email is set, user would get email notification to sign.
        'email' => 'test1@dokobit.com',
        // Role can be signer,viewer, receiver or approver.
        'role' => 'signer',
        // Other optional parameters
        'position' => 'Administrator'
    ],
    [  
        'name' => 'Second',
        'surname' => 'Signer',
        // Required if code is not set - If email is set, user would get email notification to sign.
        'email' => 'test2@dokobit.com',
        // Personal code. Required if email is not set.
        'code' => '30303039903',
        'country_code' => 'lt',
        // Role can be signer,viewer, receiver or approver.
        'role' => 'signer',
        // Other optional parameters.
        'position' => 'Director'
    ]
];

/**
 * Create signing
 */

$action = 'signing/create';
$createResponse = request(getApiUrlByAction($action), [
    //Signed document format. Check documentation for all available options.
    'type' => "pdf",
    'name' => "Agreement",
    'signers' => $signers,
    'files' => $files,
    'postback_url' => $postback_url,
    'deadline' => date("Y-m-d\TH:i:s\Z", strtotime('+7 days')),
    'comment' => 'Please sign at your earliest convenience',
    'require_qualified_signatures' => true,
    //If set to false, Dokobit portal account will not be required.
    'require_account' => false
], REQUEST_POST);

if ($createResponse['status'] != 'ok') {
	print_r($createResponse);
    echo "Signing could not be created." . PHP_EOL;
    exit;
}
print_r($createResponse);

//Output URL to check signing status.
print("Signing status can be checked here \n");
print(getApiUrlByAction('signing/' . $createResponse['token'] . '/status')) . PHP_EOL;