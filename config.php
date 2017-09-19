<?php

//Edit this if needed
$tokengroup="VTSDemoGroup";
$tokentemplate="vts-key-token";
$tokurl="https://192.168.99.120/vts/rest/v2.0/tokenize";
$detokurl="https://192.168.99.120/vts/rest/v2.0/detokenize";
$encrypturl = "http://localhost:4567/crypt/";
$decrypturl = "http://localhost:4567/decrypt/";
$signurl = "http://localhost:4567/signature/";
$verifyurl = "http://localhost:4567/verify/";

if(isset($_GET['id'])) {
	$id = $_GET['id'];
}
$user = $_POST['user'];
$passwd = $_POST['passwd'];
if ($user == "") {
	$user = $_GET['user'];
	$passwd = $_GET['passwd'];
}
?>

