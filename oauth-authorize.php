<?php

require_once __DIR__ . '/vendor/autoload.php';

$infusionsoft = new \Infusionsoft\Infusionsoft(array(
    'clientId' => '3ubphwrn85np5xtyeb8mrhk3',
    'clientSecret' => 'NfJ29xTy39',
    'redirectUri' => 'www.vettecs.com:8023/oauth-callback.php'
));

    echo '<a href="' . $infusionsoft->getAuthorizationUrl() . '">Click here to authorize</a>';

?>