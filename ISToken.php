<?php

	require_once __DIR__ . '/vendor/autoload.php';

	
	function getISToken(){
		$infusionsoft = new \Infusionsoft\Infusionsoft(array(
	    	'clientId' => '3ubphwrn85np5xtyeb8mrhk3',
		    'clientSecret' => 'NfJ29xTy39',
		    'redirectUri' => 'www.vettecs.com:8023/oauth-callback.php'
		));

		$credentialsPath = __DIR__ . '/token.txt';
		$credentials = file_get_contents($credentialsPath);
		

		try{
			$infusionsoft->setToken(unserialize($credentials));
		}catch(\Infusionsoft\TokenExpiredException $e){
			$infusionsoft->refreshAccessToken();
			$infusionsoft->setToken(unserialize($credentials));
		}
		

		return $infusionsoft;
		
	}
	
	
	
?>