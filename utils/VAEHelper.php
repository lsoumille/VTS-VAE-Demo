<?php 
class VAEHelper {

	//Pin code used to access VAE library
	const pincode = "Test123!";

	const encrypt_url = "http://localhost:4567/crypt/";
	const decrypt_url = "http://localhost:4567/decrypt/";

	//Encrypt to_encrypt data using the key using REST API
	public function encrypt($to_encrypt, $key) {
		if ($to_encrypt === '')
			return '';

		//The POST data.
		$post_data = http_build_query(array( 'keyname' => $key, 'message' => $to_encrypt));

		//Initiate cURL.
		$tok = curl_init();

		curl_setopt_array($tok, array(
		    CURLOPT_RETURNTRANSFER => 1,
		    CURLOPT_URL => (self::encrypt_url).(self::pincode),
		    CURLOPT_POST => true,
		    CURLOPT_POSTFIELDS => $post_data
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

	//Decrypt to_decrypt data using the key using REST API
	public function decrypt($to_decrypt, $key) {
		if ($to_decrypt === '')
			return '';
		//The POST data.
		$post_data = http_build_query(array( 'keyname' => $key, 'message' => $to_decrypt));

		//Initiate cURL.
		$tok = curl_init();

		curl_setopt_array($tok, array(
		    CURLOPT_RETURNTRANSFER => 1,
		    CURLOPT_URL => (self::decrypt_url).(self::pincode),
		    CURLOPT_POST => true,
		    CURLOPT_POSTFIELDS => $post_data
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