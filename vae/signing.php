<?php
include '../config.php';
include '../utils/DBHelper.php';

$tosign = $_POST['data'];
$key = $_POST['key'];

//The POST data.
$postData = http_build_query(array( 'keyname' => $key, 'message' => $tosign));

//Initiate cURL.
$tok = curl_init();

curl_setopt_array($tok, array(
    CURLOPT_RETURNTRANSFER => 1,
    CURLOPT_URL => $signurl."Test123!",
    CURLOPT_POST => true,
    //CURLOPT_SSL_VERIFYPEER => false,
    CURLOPT_POSTFIELDS => $postData
    /*CURLOPT_SSL_VERIFYHOST => false,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTPHEADER => array('Content-Type: application/json')*/
));

//Execute the request
$tok_values = curl_exec($tok);
// Check for Errors
if (!$tok_values) { die("\n\nConnection Failure.\n"); } 
// return JSON into PHP array
$obj = json_decode($tok_values);

if (isset($obj->message))
  echo $obj->message;
else {
  echo $obj->text;
  //Commit the token in the database
  $dbh = new DBHelper();
  $dbh->addData("Signing", $tosign, $obj->text, $key);

  /*print "
  <BR><center><font size=5>
  <B>Value Added.
  <BR><BR><BR><BR><BR><BR><BR>
  <a href=\"/demo.php?user=$user&passwd=$passwd\">Home</a>
  <meta http-equiv='refresh' content='1;url=/demo.php?user=$user&passwd=$passwd' />";*/
}
?>