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
    <div class="col-md-6"> <a href="#" class="site-logo"><img src="../vormetric-logo.png"></a>
      <h3><span class="verticalPipe"></span><i class="fa fa-check-circle"></i>Vormetric Demo</h3>
    </div>
    <div class="col-md-2">
      <ul class="nav nav-tabs">
        <li><h4 class="list-inline pull-right rightsideIcons"><a href="/demo.php">Vormetric Applicative Features</a></h4></li>
      </ul>
    </div>
    <div class="col-md-2"> 
      <ul class="nav nav-tabs">
        <li><h4 class="list-inline pull-right rightsideIcons"><a href="/appli/databaseview.php">Application Integration</h4></li>
      </ul>
    </div>
    <div class="col-md-2">
      <h4 class="list-inline pull-right rightsideIcons">
  <?php
    include '../config.php';

    print "Welcome, $user. <a href=\"index.html\">Logout</a>"; 
  ?>
    </h4>
  </div>
</header>
<div class="container-fluid">
    <button type="button" class="btn btn-primary center-block margetop">Add Customer</button>
<?php
include '../config.php';
include '../utils/DBHelper.php';
include '../utils/VAEHelper.php';
include '../utils/VTSHelper.php';

print   "
  <div class=\"col-md-12\">
  <table width=100% border=1>
  <TR>
  <TD bgcolor=#dddddd>ID#</TD>
  <td bgcolor=#dddddd>
    <b>Firstname</b>
    </td>
    <td bgcolor=#dddddd><b>
      Lastname</b></td>
    <td bgcolor=#dddddd><b>
      Birth Date</b></td>
    <td bgcolor=#dddddd><b>
      Phone Number</b></td>
    <td bgcolor=#dddddd><b>
      Nationality</b></td>
    <td bgcolor=#dddddd><b>
      SSN</b></td>
    <td bgcolor=#dddddd><b>
      Address</b></td>
    <td bgcolor=#dddddd><b>
      City</b></td>
    <td bgcolor=#dddddd><b>
      Postcode</b></td>
    <td bgcolor=#dddddd><b>
      Country</b></td>
    <td bgcolor=#dddddd><b>
      Card Number</b></td>
    <td bgcolor=#dddddd><b>
      Expiration Date</b></td>
    <td bgcolor=#dddddd><b>
      CVV</b></td>
    <td bgcolor=#dddddd><b>
      Delete</b></td></tr>
  " ; 

$dbh = new DBHelper();
$vaeh = new VAEHelper();
$vtsh = new VTSHelper();

//Get only last 5 results
$results = $dbh->getAllCustomers();

foreach ($results as $line) {
  $id = $line['id'];
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

  print "<tr>
  <td class=\"idrow\">$id<div class=\"popup\"><img id=\"ID\" src=\"../img/$id.jpg\"></div></td>
  <td>$firstname</td>
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
  <td nowrap valign=middle><font size=1>
  <a href=\"delete.php?id=$id&user=$user&passwd=$passwd\">Delete</a></td></tr>";
  }

print "</table></div>";
?>
</div>
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