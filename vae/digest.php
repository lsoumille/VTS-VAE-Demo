<?php
include '../config.php';
include '../utils/DBHelper.php';

$todigest = $_POST['data'];
$algo = $_POST['algo'];

//The POST data.
//Keyname is not used yet
$postData = http_build_query(array( 'keyname' => 'vae-keypair', 'message' => $todigest));

//Initiate cURL.
$tok = curl_init();

curl_setopt_array($tok, array(
    CURLOPT_RETURNTRANSFER => 1,
    CURLOPT_URL => $digesturl."Test123!",
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
  print $obj->text;
  //Commit the token in the database
  $dbh = new DBHelper();
  $dbh->addData("Digest", $todigest, $obj->text, $algo);

  /*print "
  <BR><center><font size=5>
  <B>Value Added.
  <BR><BR><BR><BR><BR><BR><BR>
  <a href=\"/demo.php?user=$user&passwd=$passwd\">Home</a>
  <meta http-equiv='refresh' content='1;url=/demo.php?user=$user&passwd=$passwd' />";*/
}
?>