<?php

	require_once __DIR__ . '/vendor/autoload.php';
	require __DIR__ . '/ISToken.php';


	$phoneNum = $_POST['phone'];
	$infusionsoft = getISToken();

	
	function getContact($infusionsoft, $phoneNum)
    {
    	
    	//Note to future Allen or Stephen
		//Custom fields are prepended with an underscore
		//E.g. '_CustomField'
    	
        $table = 'Contact';
        $fieldName = 'Phone1';
        $returnFields = array(
            
            'Email',
            'FirstName',
            'Id',
            'LastName',
            'OwnerID',
            'Phone1'
        );
    	
		//var_dump($infusionsoft);
		
    	try{
			//echo 'End of script C';
			//echo $infusionsoft->isExpired();
			
    		$results = $infusionsoft->data('xml')->findByField($table, 1, 0 ,$fieldName, $phoneNum, $returnFields);
        	$results = json_encode($results);
			
        	return $results;
    	}catch(\Infusionsoft\TokenExpiredException $e){
    		setISToken($infusionsoft);
    		
    		$results = $infusionsoft->data('xml')->findByField($table, 1, 0 ,$fieldName, $phoneNum, $returnFields);
        	$results = json_encode($results);
        			

        	return $results;
    	}
        
    }
    
    function addTag($infusionsoft, $contactId, $tagId){
		
		try{
    		$results = $infusionsoft->contacts('xml')->addToGroup($contactId, $tagId);
    	}catch(\Infusionsoft\TokenExpiredException $e){
    		setISToken($infusionsoft);
    		//var_dump($infusionsoft);
    		$results = $infusionsoft->contacts('xml')->addToGroup($contactId, $tagId);
    	}

	}
	
	function addNote($infusionsoft, $contactId, $ownerId){

		//Add Note in to Contact Record
		//Update CreationNotes and ActionDescription for final build
	
		try{
    		$infusionsoft->data('xml')->add('ContactAction', array(    	
	        'ContactId' 	    => $contactId, 
	        'CreationNotes'     => $body,  		       // Note Description
	        'CreationDate'      => server_time,
	        'ActionDate'        => server_time,
	        'CompletionDate'    => server_time,
	        'OpportunityId'     => 0,
	        'ActionDescription' => 'New Call From: ',  // Note Title
	        'ActionType'        => 'UPDATE',		   // Match the Type in Infusionsoft
	        'UserID'            => $ownerId,	       // User ID
	        'IsAppointment'     => 1,
	        'Priority'          => 3,
	        'LastUpdatedBy'     => 1,			       // User ID
	        'LastUpdated'       => server_time,
    	    'CreatedBy'         => $ownerId,        // User ID
    	    'Accepted'          => 1
    	));
    	}catch(\Infusionsoft\TokenExpiredException $e){
    		setISToken($infusionsoft);
    		$infusionsoft->data('xml')->add('ContactAction', array(    	
	        'ContactId' 	    => $contactId, 
	        'CreationNotes'     => $body,  		       // Note Description
	        'CreationDate'      => server_time,
	        'ActionDate'        => server_time,
	        'CompletionDate'    => server_time,
	        'OpportunityId'     => 0,
	        'ActionDescription' => 'New Call From: ',  // Note Title
	        'ActionType'        => 'UPDATE',		   // Match the Type in Infusionsoft
	        'UserID'            => $ownerId,	       // User ID
	        'IsAppointment'     => 1,
	        'Priority'          => 3,
	        'LastUpdatedBy'     => 1,			       // User ID
	        'LastUpdated'       => server_time,
    	    'CreatedBy'         => $ownerId,        // User ID
    	    'Accepted'          => 1
    	));
    	}

	}
	
	//$phoneNum = '(904) 796-0559';

	$result = json_decode(getContact($infusionsoft,$phoneNum),true);
		//echo "End of script 2<br>";

	echo $result[0]['Id'];
?>