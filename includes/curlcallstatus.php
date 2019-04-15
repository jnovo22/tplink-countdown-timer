<?php 

	$ch = curl_init($url);
	// Set the url, number of POST vars, POST data
	//Encode the array into JSON.
	$jsonDataEncoded = json_encode($fields);

	//Tell cURL that we want to send a POST request.
	curl_setopt($ch, CURLOPT_POST, 1);

	//Attach our encoded JSON string to the POST fields.
	curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonDataEncoded);

	//Set the content type to application/json
	curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json" | grep -q '..relay_state..:1' && echo "ON" || echo "OFF"));


	//hide the response
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);


	//Execute the request
	$result = curl_exec($ch);

	 curl_close($ch);

	//print_r($result);

	$resp = json_decode($result,true);

?>