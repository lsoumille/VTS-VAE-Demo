

<?php
    include '../config.php';
    include '../utils/DBHelper.php';
    
    $to_decrypt = $_POST['data'];
    $key = $_POST['key'];
    
    //The POST data.
    $post_data = http_build_query(array( 'keyname' => $key, 'message' => $to_decrypt));
    
    //Initiate cURL.
    $tok = curl_init();
    
    curl_setopt_array($tok, array(
        CURLOPT_RETURNTRANSFER => 1,
        CURLOPT_URL => $decrypt_url.$pincode,
        CURLOPT_POST => true,
        //CURLOPT_SSL_VERIFYPEER => false,
        CURLOPT_POSTFIELDS => $post_data
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
      $dbh->addData("Decryption", $to_decrypt, $obj->text, $key);
    
      /*print "
      <BR><center><font size=5>
      <B>Value Added.
      <BR><BR><BR><BR><BR><BR><BR>
      <a href=\"/demo.php?user=$user&passwd=$passwd\">Home</a>
      <meta http-equiv='refresh' content='1;url=/demo.php?user=$user&passwd=$passwd' />";*/
    }
?>