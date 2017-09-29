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
include '../config.php';
include '../utils/DBHelper.php';
include '../utils/VAEHelper.php';
include '../utils/VTSHelper.php';

print   "
  <div class=\"row\">
  <div class=\"col-md-12\">
  <table width=100% border=1>
  <TR>
  <TD bgcolor=#dddddd>ID#</TD>
  <td bgcolor=#dddddd>
    <b>Action</b>
    </td>
    <td bgcolor=#dddddd><b>
      Input Data</b></td>
    <td bgcolor=#dddddd><b>
      Output Data</b></td>
    <td bgcolor=#dddddd><b>
      Comments</b></td>
    <td bgcolor=#dddddd><b>
      Delete</b></td></tr>
  " ; 

$dbh = new DBHelper();
$vaeh = new VAEHelper();
$vtsh = new VTSHelper();

//Get only last 5 results
$results = $dbh->getAllCustomers();

foreach ($results as $line) {
  $firstname = $vaeh->decrypt($line['firstname'], $encryptionKey);
  $lastname = $vaeh->decrypt($line['lastname'], $encryptionKey);
  $birthDate = $vtsh->detokenize($tokengroup, $line['birthDate'], 'datetemplate', $user, $passwd);
  $phoneNumber = $vtsh->detokenize($tokengroup, $line['phoneNumber'], 'phonenumber', $user, $passwd);
  $nationality = $line['nationality'];
  $ssn = $vtsh->detokenize($tokengroup, $line['ssn'], 'ssn', $user, $passwd);
  $address = $vaeh->decrypt($line['address'], $encryptionKey);
  $city = $vaeh->decrypt($line['city'], $encryptionKey);
  $postcode = $vtsh->detokenize($tokengroup, $line['postcode'], 'phonenumber', $user, $passwd);
  $country = $line['country'];
  $cardnumber = $vtsh->detokenize($tokengroup, $line['cardNumber'], 'creditcard', $user, $passwd);
  $expirationDate = $vtsh->detokenize($tokengroup, $line['expirationDate'], 'shortdate', $user, $passwd);
  $cvv = 0;
  if (isset($line['cvv']) && $line['cvv'] != 0)
    $cvv = $vtsh->detokenize($tokengroup, $line['cvv'], 'phonenumber', $user, $passwd);

  print "<TR>
  <TD>$firstname</td>
  <td>$lastname</td>
  <td>$birthDate</td>
  <td>$phoneNumber</td>
  <td>$nationality</td>
  <td>$ssn</td>
  <td>$address</td>
  <td>$city</td>
  <td>$postcode</td>
  <td>$country</td>
  <td>$cardnumber</td>
  <td>$expirationDate</td>
  <td>$cvv</td>
  <td nowrap valign=middle><FONT SIZE=1>
  <a href=\"delete.php?id=$id&user=$user&passwd=$passwd\">Delete</a></td></tr>";
  }

print "</table></div></div>";
?>
<footer>
   <a href=javascript:window.open('https://support.vormetric.com/login');>Support </a><span>|</span>
   <a href=javascript:window.open('http://www.vormetric.com')>About </a><span>|</span>
   <!-- <a href="javascript:void(0);">Support</a><span>|</span>
<a href="javascript:void(0);">About</a><span>|</span>-->
   Copyright &copy; 2016 Vormetric. Inc. All rights reserved.

</footer>
</body>
</body>
</html>