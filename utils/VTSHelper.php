<?php 
class VTSHelper {

	const tok_url = "https://192.168.99.120/vts/rest/v2.0/tokenize";
	const detok_url = "https://192.168.99.120/vts/rest/v2.0/detokenize";


	//Tokenize data with defined tokentemplate and tokengroup by sending them to the VTS REST API 
	public function tokenize($tokengroup, $data, $tokentemplate, $user, $password) {
		if ($data === '')
			return '';

		//The JSON data.
		$json_data = array( 'tokengroup' => $tokengroup, 'data' => $data, 'tokentemplate' => $tokentemplate);

		//Initiate cURL.
		$tok = curl_init();
		curl_setopt_array($tok, array(
   			CURLOPT_RETURNTRANSFER => 1,
    		CURLOPT_URL => self::tok_url,
    		CURLOPT_POST => true,
    		CURLOPT_SSL_VERIFYPEER => false,
    		CURLOPT_HTTPAUTH => CURLAUTH_BASIC,
    		CURLOPT_USERPWD => $user.":".$password,
    		CURLOPT_POSTFIELDS => json_encode($json_data),
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
  			return 'X';
		else
  			return $obj->token;
		
	}

	//Detokenize data with defined tokentemplate and tokengroup by sending them to the VTS REST API
	public function detokenize($tokengroup, $token, $tokentemplate, $user, $password) {
		if ($token === '')
			return '';
		//The JSON data.
		$json_data = array( 'tokengroup' => $tokengroup, 'token' => $token, 'tokentemplate' => $tokentemplate);

		//Initiate cURL.
		$tok = curl_init();
		curl_setopt_array($tok, array(
    		CURLOPT_RETURNTRANSFER => 1,
    		CURLOPT_URL => self::detok_url,
    		CURLOPT_POST => true,
    		CURLOPT_SSL_VERIFYPEER => false,
    		CURLOPT_HTTPAUTH => CURLAUTH_BASIC,
    		CURLOPT_USERPWD => $user.":".$password,
    		CURLOPT_POSTFIELDS => json_encode($json_data),
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
  			return 'X';
		else 
  			return $obj->data;
	}
}
?>