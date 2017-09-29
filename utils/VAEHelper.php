<?php 
class VAEHelper {

	//Pin code used to access VAE library
	const pinCode = "Test123!";

	const encrypturl = "http://localhost:4567/crypt/";
	const decrypturl = "http://localhost:4567/decrypt/";

	public function encrypt($toencrypt, $key) {
		if ($toencrypt === '')
			return '';

		//The POST data.
		$postData = http_build_query(array( 'keyname' => $key, 'message' => $toencrypt));

		//Initiate cURL.
		$tok = curl_init();

		curl_setopt_array($tok, array(
		    CURLOPT_RETURNTRANSFER => 1,
		    CURLOPT_URL => (self::encrypturl).(self::pinCode),
		    CURLOPT_POST => true,
		    CURLOPT_POSTFIELDS => $postData
		));

		//Execute the request
		$tok_values = curl_exec($tok);
		// Check for Errors
		if (!$tok_values) { die("\n\nConnection Failure.\n"); } 
		// return JSON into PHP array
		$obj = json_decode($tok_values);

		if (isset($obj->message))
		  return $obj->message;
		else
		  return $obj->text;
	}

	public function decrypt($todecrypt, $key) {
		if ($todecrypt === '')
			return '';
		//The POST data.
		$postData = http_build_query(array( 'keyname' => $key, 'message' => $todecrypt));

		//Initiate cURL.
		$tok = curl_init();

		curl_setopt_array($tok, array(
		    CURLOPT_RETURNTRANSFER => 1,
		    CURLOPT_URL => (self::decrypturl).(self::pinCode),
		    CURLOPT_POST => true,
		    CURLOPT_POSTFIELDS => $postData
		));

		//Execute the request
		$tok_values = curl_exec($tok);
		// Check for Errors
		if (!$tok_values) { die("\n\nConnection Failure.\n"); } 
		// return JSON into PHP array
		$obj = json_decode($tok_values);

		if (isset($obj->message))
		  return $obj->message;
		else
		  return $obj->text;
	}
}
?>