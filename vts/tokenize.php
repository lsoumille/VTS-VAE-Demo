<?php
    include "../config.php";
    include "../utils/DBHelper.php";
    $to_token = $_POST['data'];
    //$name = $_POST['name'];
    $template = $_POST['template'];
    
    //The JSON data.
    $jsonData = array( 'tokengroup' => 'VTSDemoGroup', 'data' => $to_token, 'tokentemplate' => $template);
    
    //Initiate cURL.
    $tok = curl_init();
    
    curl_setopt_array($tok, array(
        CURLOPT_RETURNTRANSFER => 1,
        CURLOPT_URL => $tok_url,
        CURLOPT_POST => true,
        CURLOPT_SSL_VERIFYPEER => false,
        CURLOPT_HTTPAUTH => CURLAUTH_BASIC,
        CURLOPT_USERPWD => $user.":".$passwd,
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
      echo $obj->reason;
    else {
      echo $obj->token;
      //Commit the token in the database
      $dbh = new DBHelper();
      $dbh->addData("Tokenization", $to_token, $obj->token, $tokentemplate);
    
      /*print "
      <BR><center><font size=5>
      <B>Value Added.
      <BR><BR><BR><BR><BR><BR><BR>
      <a href=\"/demo.php?user=$user&passwd=$passwd\">Home</a>
      <meta http-equiv='refresh' content='1;url=/demo.php?user=$user&passwd=$passwd' />";*/
    }
?>

