<?php
    $tokentemplate="vts-key-token";
    $pincode = "Test123!";
    $tok_url="https://192.168.99.120/vts/rest/v2.0/tokenize";
    $detok_url="https://192.168.99.120/vts/rest/v2.0/detokenize";
    $encrypt_url = "http://localhost:4567/crypt/";
    $decrypt_url = "http://localhost:4567/decrypt/";
    $sign_url = "http://localhost:4567/signature/";
    $verify_url = "http://localhost:4567/verify/";
    $digest_url = "http://localhost:4567/digest/";
    
    $encryption_key = "vts-key-token";
    
    if(isset($_GET['id'])) {
    	$id = $_GET['id'];
    }
    
    if(isset($_GET['table'])) {
    	$table = $_GET['table'];
    }
    
    $user = $_POST['user'];
    $passwd = $_POST['passwd'];
    $tokengroup = '';
    if ($user != "") { 
    	file_put_contents(__DIR__.'/credentials/login.txt', '');
    	if ($user == 'finance') {
    		$tokengroup = "PaymentData";
    	} else if ($user == 'admin' || $user == 'commerce') {
    		$tokengroup = "CustomerData";
    	} else {
            $tokengroup = "Default";
        }
    	file_put_contents(__DIR__.'/credentials/login.txt', $user.'|'.$passwd.'|'.$tokengroup);
    
    } else {
    	$loginFile = fopen(__DIR__. '/credentials/login.txt', 'r+');
    	$line = fgets($loginFile);
    	$credentials = explode("|", $line);
    	$user = $credentials[0];
    	$passwd = $credentials[1];
    	$tokengroup = $credentials[2];
    	fclose($loginFile);
    }
?>