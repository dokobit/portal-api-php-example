<?php
require_once __DIR__ . '/config/config.php';
require_once __DIR__ . '/config/lib.php';

//Token of the signing.
$signingToken = $argv[1];

$requestUrl = $apiUrl . '/api/signing/' . $signingToken . '/download?access_token=' . $accessToken;

//Make a request to get file data.
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $requestUrl);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_SSLVERSION, CURL_SSLVERSION_TLSv1_2);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
$response = curl_exec($ch);
$error = curl_error($ch);

//Check if error is returned.
if ($error) {
    writeLog("Error: " . print_r($error, true));
    exit;
}
curl_close($ch);

//Check if JSON with status error is returned.
if (json_decode($response, true)["status"] == "error") {
	echo $response . PHP_EOL;
	exit;
}

//Save file to your database.
$name = 'signed_' . mt_rand() . '.pdf';
$path = __DIR__ . '/Resources/output/' . $name;
file_put_contents($path, $response);
echo "File $name saved" . PHP_EOL;