<?php

	require_once __DIR__ . '/vendor/autoload.php';
	require __DIR__ . '/ISToken.php';



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
    	
    			echo "End of script A";
		//var_dump($infusionsoft);
		
    	try{
			//Your search is fucked up
			// -Past Allen
			echo 'End of script C';
    		$results = $infusionsoft->data('xml')->findByField($table, 1, 0 ,$fieldName, $phoneNum, $returnFields);
        	$results = json_encode($results);

        	return $results;
    	}catch(\Infusionsoft\TokenExpiredException $e){
    		$infusionsoft->refreshAccessToken();
    		$results = $infusionsoft->data('xml')->findByField($table, 1, 0 ,$fieldName, $phoneNum, $returnFields);
        	$results = json_encode($results);
        			

        	return $results;
    	}
        
    }
    
    function addTag($infusionsoft, $contactId, $tagId){
		
		try{
    		$results = $infusionsoft->contacts('xml')->addToGroup($contactId, $tagId);
    	}catch(\Infusionsoft\TokenExpiredException $e){
    		$infusionsoft->refreshAccessToken();
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
    		$infusionsoft->refreshAccessToken();
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
	$phoneNum = $_POST['phone'];

	$result = json_decode(getContact($infusionsoft,$phoneNum),true);
		//echo "End of script 2<br>";

	echo $result[0]['Id'];
?>