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
      <h3><span class="verticalPipe"></span><i class="fa fa-check-circle"></i>Vormetric Tokenisation Demo Server </h3>
    </div>
    <div class="col-xs-4">
      <ul class="list-inline pull-right rightsideIcons">

        </li>
      </ul>
    </div>
  </div>
</header>

<?php

include "config.php";
$totoken = $_POST['data'];
$name = $_POST['name'];
$template = $_POST['template'];

//$id = $_GET['id'];
//$user = $_POST['user'];
//$passwd = $_POST['passwd'];
//if ($user == "") {
//        $user = $_GET['user'];
//        $passwd = $_GET['passwd'];
//}

/*
$data = array(
    'tokengroup' => '$tokengroup',
    'data' => '$totoken',
    'template' => '$template'
);
*/
//API Url
$url_vts_tok = 'https://vts2.1.0v2/vts/rest/v2.0/tokenize';
//$url_vts_detok = 'https://vts2.1.0v2/vts/rest/v2.0/detokenize';
//Initiate cURL.
$tok = curl_init($url_vts_tok);
//$detok = curl_init($url_vts_detok);

//Tell cURL that we want to send a POST request.
curl_setopt($tok, CURLOPT_POST, true);
curl_setopt($tok, CURLOPT_SSL_VERIFYPEER, false);

//Set the content type of AUTH
curl_setopt($tok, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
curl_setopt($tok, CURLOPT_USERPWD, "$user:$passwd");

        //The JSON data.
        $jsonData = array
                ( 'tokengroup' => 'Group_Key1', 'data' => "$totoken", 'tokentemplate' => "$template",
                );
        //Attach our encoded JSON string to the POST fields.
        curl_setopt($tok, CURLOPT_POSTFIELDS, json_encode($jsonData));
        //Set the content type to application/json
        curl_setopt($tok, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        curl_setopt($tok, CURLOPT_RETURNTRANSFER, true);
        //Execute the request
        $tok_values = curl_exec($tok);
        // Check for Errors
        //if (!$detok_values) { die("\n\nConnection Failure.\n"); } 
        // return JSON into PHP array
        $obj = json_decode($tok_values);
        // Check for Errors
        if ( isset($obj->error) ) { die($obj->error_message."\n"); }
        //print "$obj->data\n";
        $token = $obj->token;
//        if ($token_value == "") $token_value="<font color=red>Failed to detokenize";


//$command="curl -tlsv1.2 -k -X POST -H 'Content-Type: application/json' -u $user:$passwd -d '{\"tokengroup\" : \"Group_Key1\" , \"data\" : \"$totoken\", \"tokentemplate\" : \"$template\" }' $tokurl";
//print "<BR><BR>Executing $command";

//$output = shell_exec($command);
//$obj = json_decode($output);
//$token = $obj->{'token'};

$link = mysql_connect("localhost", "apache", "apachsrv")
  or die ("Could not connect to database.");
 mysql_select_db("vtsdemo")
  or die ("Could not select database.");

  $query = "insert into customer (name,tokenvalue,template) values('$name', '$token', '$template')";
  $result = mysql_query ($query)
  or die ("Query failed.  Result: $result");


print "
<BR><center><font size=5>
	<B>Value Added.
	<BR><BR><BR><BR><BR><BR><BR>
	<a href=\"/demo.php?user=$user&passwd=$passwd\">Home</a>
	<meta http-equiv='refresh' content='1;url=demo.php?user=$user&passwd=$passwd' />";

?>
</body>
</html>

