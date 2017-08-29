<?php

require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . 'ISToken.php';


	function getContact($phoneNum, $infusionsoft)
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
    
        $results = $infusionsoft->data('xml')->findByField($table, 1, 0 ,$fieldName, $phoneNum, $returnFields);
        return json_encode($results);
    }


?>