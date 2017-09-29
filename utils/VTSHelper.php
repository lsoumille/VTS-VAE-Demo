<?php 
class VTSHelper {

	const tokurl = "https://192.168.99.120/vts/rest/v2.0/tokenize";
	const detokurl = "https://192.168.99.120/vts/rest/v2.0/detokenize";

	public function tokenize($tokengroup, $data, $tokentemplate, $user, $password) {
		if ($data === '')
			return '';

		//The JSON data.
		$jsonData = array( 'tokengroup' => $tokengroup, 'data' => $data, 'tokentemplate' => $tokentemplate);

		//Initiate cURL.
		$tok = curl_init();
		curl_setopt_array($tok, array(
   			CURLOPT_RETURNTRANSFER => 1,
    		CURLOPT_URL => self::tokurl,
    		CURLOPT_POST => true,
    		CURLOPT_SSL_VERIFYPEER => false,
    		CURLOPT_HTTPAUTH => CURLAUTH_BASIC,
    		CURLOPT_USERPWD => $user.":".$password,
    		CURLOPT_POSTFIELDS => json_encode($jsonData),
    		CURLOPT_SSL_VERIFYHOST => false,
    		CURLOPT_FOLLOWLOCATION => true,
    		CURLOPT_HTTPHEADER => array('Content-Type: application/json')
		));

		//Execute the request
		$tok_values = curl_exec($tok);
		// Check for Errors
		if (!$tok_values) { die("\n\nConnection Failure.\n"); } 
		// return JSON into PHP array
		$obj = json_decode($tok_values);

		if (strcmp($obj->status, "Succeed") !== 0)
  			return $obj->reason;
		else
  			return $obj->token;
		
	}

	public function detokenize($tokengroup, $token, $tokentemplate, $user, $password) {
		if ($token === '')
			return '';
		//The JSON data.
		$jsonData = array( 'tokengroup' => $tokengroup, 'token' => $token, 'tokentemplate' => $tokentemplate);

		//Initiate cURL.
		$tok = curl_init();
		curl_setopt_array($tok, array(
    		CURLOPT_RETURNTRANSFER => 1,
    		CURLOPT_URL => self::detokurl,
    		CURLOPT_POST => true,
    		CURLOPT_SSL_VERIFYPEER => false,
    		CURLOPT_HTTPAUTH => CURLAUTH_BASIC,
    		CURLOPT_USERPWD => $user.":".$password,
    		CURLOPT_POSTFIELDS => json_encode($jsonData),
    		CURLOPT_SSL_VERIFYHOST => false,
    		CURLOPT_FOLLOWLOCATION => true,
    		CURLOPT_HTTPHEADER => array('Content-Type: application/json')
		));

		//Execute the request
		$tok_values = curl_exec($tok);
		// Check for Errors
		if (!$tok_values) { die("\n\nConnection Failure.\n"); } 
		// return JSON into PHP array
		$obj = json_decode($tok_values);

		if (strcmp($obj->status, "Succeed") !== 0)
  			return $obj->reason;
		else 
  			return $obj->data;
	}
}
?>