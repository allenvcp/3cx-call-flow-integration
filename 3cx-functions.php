<?php

	require_once __DIR__ . '/vendor/autoload.php';
	include __DIR__ . '/get-contact.php';
	
	
	$phoneNum = '(904) 796-0559';
	//$phoneNum = $_POST['phone'];
	
	$result = json_decode(getContact($phoneNum),true);

	echo $result[0]['Id'];
?>