<?php

	require_once __DIR__ . '/vendor/autoload.php';

	$infusionsoft = new \Infusionsoft\Infusionsoft(array(
	    'clientId' => '3ubphwrn85np5xtyeb8mrhk3',
	    'clientSecret' => 'NfJ29xTy39',
	    'redirectUri' => 'www.vettecs.com:8023/oauth-callback.php'
	));

	$credentialsPath = __DIR__ . '/token.txt';

	//echo 'Get access token with code';
	$credentials = serialize($infusionsoft->requestAccessToken($_GET['code']));
	
    // Store the credentials to disk.
    mkdir(dirname($credentialsPath), 0700, true);
    file_put_contents($credentialsPath, $credentials);
    printf("Credentials saved to %s\n", $credentialsPath);
	//echo 'Have token';

?>