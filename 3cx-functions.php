<?php

	require_once __DIR__ . '/vendor/autoload.php';
	require_once __DIR__ . '/ISToken.php';

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
    	
        $results = $infusionsoft->data('xml')->findByField($table, 1, 0 ,$fieldName, $phoneNum, $returnFields);

        $results = json_encode($results);
        
        return $results;	
        
    }
    
    function addTag($infusionsoft, $contactId, $tagId){

    	$results = $infusionsoft->contacts('xml')->addToGroup($contactId, $tagId);

	}
	
	function addNote($infusionsoft, $contactId, $ownerId){

		//Add Note in to Contact Record
		//Update CreationNotes and ActionDescription for final build
	
	
		$infusionsoft->data('xml')->add('ContactAction', array(    	
	        'ContactId' 	    => $contactId, 
	        'CreationNotes'     => $body,  		       // Note Description
	        'CreationDate'      => server_time,
	        'ActionDate'        => server_time,
	        'CompletionDate'    => server_time,
	        'OpportunityId'     => 0,
	        'ActionDescription' => 'New Call From: ',  // Note Title
	        'ActionType'        => 'UPDATE',		   // Match the Type in Infusionsoft
	        'UserID'            => $setOwnerId,	       // User ID
	        'IsAppointment'     => 1,
	        'Priority'          => 3,
	        'LastUpdatedBy'     => 1,			       // User ID
	        'LastUpdated'       => server_time,
    	    'CreatedBy'         => $setOwnerId,        // User ID
    	    'Accepted'          => 1
    	));

	}
	
	$infusionsoft = getISToken();

	$phoneNum = '(904) 796-0559';
	//$phoneNum = $_POST['phone'];
	
	$result = json_decode(getContact($phoneNum,$infusionsoft),true);

	echo $result[0]['Id'];
?>