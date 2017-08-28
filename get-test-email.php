<?php

require_once __DIR__ . '/vendor/autoload.php';

	$infusionsoft = new \Infusionsoft\Infusionsoft(array(
	    'clientId' => '3ubphwrn85np5xtyeb8mrhk3',
	    'clientSecret' => 'NfJ29xTy39',
	    'redirectUri' => 'www.vettecs.com:8023/oauth-callback.php'
	));

	$credentialsPath = __DIR__ . '/token.txt';
	$credentials = file_get_contents($credentialsPath);
	
	
	$infusionsoft->setToken(unserialize($credentials));
	
	
	try{
		$results = getTestContact('(904) 796-0559', $infusionsoft);
		echo $results;
	} catch(\Infusionsoft\TokenExpiredException $e){
		$infusionsoft->refreshAccessToken();
		
		$results = getTestContact('(904) 796-0559', $infusionsoft);
		echo $results;
	}
	
	
	
	
	

	function getTestContact($phoneNum, $infusionsoft)
    {
        $table = 'Contact';
        $fieldName = 'Phone1';
        $returnFields = array(
            'LastName',
            'FirstName',
            'Email'
        );
    
        $results = $infusionsoft->data('xml')->findByField($table, 1, 0 ,$fieldName, $phoneNum, $returnFields);
        return $results[0]['Email'];
    }






	try {
		        $contacts = $this->infusionsoftClient->contacts()->where('email', $from)->get();
	        } catch (\Infusionsoft\TokenExpiredException $e) {
		        $this->infusionsoftClient->refreshAccessToken();
		        $contacts = $this->infusionsoftClient->contacts()->where('email', $from)->get();
	        }
?>