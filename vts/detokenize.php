<html>
<head>
<title>Vormetric Tokenization Server Demo</title>
<link rel="icon" href="favicon.ico" type="image/x-icon" />
<link href="/css/bootstrap.min.css" rel="stylesheet">
<link href="/css/vormetric.min.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="/css/base.css" />
<link rel="stylesheet" type="text/css" href="/css/login.css" />


<!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
<link href="/css/skin.css" rel="stylesheet">

<meta charset="UTF-8" />
</head>

<body class="slideToLeft" style="left: 0px;">

<header class="container-fluid">
  <div class="row">
    <div class="col-xs-8"> <a href="#" class="site-logo"><img src="img/v-logo.jpg"></a>
      <h3><span class="verticalPipe"></span><i class="fa fa-check-circle"></i>Vormetric Demo</h3>
    </div>
    <div class="col-xs-4">
      <ul class="list-inline pull-right rightsideIcons">

        </li>
      </ul>
    </div>
  </div>
</header>

<?php
include "../config.php";
include "../utils/DBHelper.php";
$todetoken = $_POST['data'];
//$name = $_POST['name'];
$template = $_POST['template'];

//The JSON data.
$jsonData = array( 'tokengroup' => 'VTSDemoGroup', 'token' => $todetoken, 'tokentemplate' => $template);

//Initiate cURL.
$tok = curl_init();

curl_setopt_array($tok, array(
    CURLOPT_RETURNTRANSFER => 1,
    CURLOPT_URL => $detokurl,
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
  print $obj->data;
  //Commit the token in the database
  $dbh = new DBHelper();
  $dbh->addData("Detokenization", $todetoken, $obj->data, $tokentemplate);

  print "
  <BR><center><font size=5>
  <B>Value Added.
  <BR><BR><BR><BR><BR><BR><BR>
  <a href=\"/demo.php?user=$user&passwd=$passwd\">Home</a>
  <meta http-equiv='refresh' content='1;url=/demo.php?user=$user&passwd=$passwd' />";
}
?>
</body>
</html>
