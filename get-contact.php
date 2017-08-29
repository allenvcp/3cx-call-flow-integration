<?php

require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/ISToken.php';


	function getContact($phoneNum)
    {
        $table = 'Contact';
        $fieldName = 'Phone1';
        $returnFields = array(
            
            'Email',
            'FirstName',
            'Id',
            'LastName',
            'Phone1'
        );
    	
    	$infusionsoft = getISToken();
        $results = $infusionsoft->data('xml')->findByField($table, 1, 0 ,$fieldName, $phoneNum, $returnFields);

        $results = json_encode($results);
        
        return $results;	
        
    }


?>