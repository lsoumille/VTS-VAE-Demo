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

    print "Welcome, $user. <a href=\"/index.html\">Logout</a>"; 
  ?>
    </h4>
  </div>
</header>

<?php
include '../config.php';
include '../utils/DBHelper.php';
include '../utils/VAEHelper.php';
include '../utils/VTSHelper.php';

//Retrive all form data
$firstname = $_POST['name'];
$lastname = $_POST['surname'];
$birthDate = $_POST['datepicker'];
$cardNumber = '';
if (isset($_POST['card-number']))
  $cardNumber = $_POST['card-number'];
$expiredate = '';
if (isset($_POST['expiry-month']) && isset($_POST['expiry-year']) && $_POST['expiry-month'] !== 'Month' && $_POST['expiry-year']) {
  $expiredate = $_POST['expiry-month'].'/'.$_POST['expiry-year'];
}
//$expireYear = $_POST['expiry-year'];
$cvv = 0;
if (isset($_POST['cvv']) && $_POST['cvv'] !== '') {
  $cvv = $_POST['cvv'];
}
$phoneNumber = '';
if (isset($_POST['phonenumber'])) {
  $phoneNumber = $_POST['phonenumber'];  
}
$nationality = '';
if (isset($_POST['nationality'])) {
  $nationality = $_POST['nationality'];  
}
$address = '';
if (isset($_POST['address'])) {
  $address = $_POST['address'];
}
$city = '';
if (isset($_POST['city'])) {
  $city = $_POST['city'];  
}
$postcode = '';
if (isset($_POST['postcode'])) {
  $postcode = $_POST['postcode'];  
}
$country = '';
if (isset($_POST['country'])) {
  $country = $_POST['country'];  
}
if (isset($_POST['ssn'])) {
  $ssn = $_POST['ssn'];
}

$vtsh = new VTSHelper();
$birthDate_tokenized = $vtsh->tokenize($tokengroup, $birthDate, 'datetemplate', $user, $passwd);
if ($birthDate_tokenized == 'KO')
  die("Tokenization Forbidden");
$phonenumber_tokenized = $vtsh->tokenize($tokengroup, $phoneNumber, 'phonenumber', $user, $passwd);  
print "phonenumber  : ".$phonenumber_tokenized;

$ssn_tokenized = $vtsh->tokenize($tokengroup, $ssn, 'ssn', $user,$passwd);
print "SSN  : ".$ssn_tokenized;
$postcode_tokenized = $vtsh->tokenize($tokengroup, $postcode, 'phonenumber', $user, $passwd);  

print "Postcode : ".$postcode_tokenized;
$cardnumber_tokenized = $vtsh->tokenize($tokengroup, $cardNumber, 'creditcard', $user, $passwd);  
print "cardNumber : ".$cardnumber_tokenized;
$expiredate_tokenized = $vtsh->tokenize($tokengroup, $expiredate, 'shortdate', $user, $passwd);  
print "expiredate : ".$expiredate_tokenized;
$cvv_tokenized = 0;
if ($cvv !== 0) {
  $cvv_tokenized = $vtsh->tokenize($tokengroup, $cvv, 'cvv', $user, $passwd);

}
print "cvv : ".$cvv_tokenized;
//Save the encrypted data
$id = $dbh->addCustomer('customer', $firstname_encrypted, $lastname_encrypted, $birthDate_tokenized, $phonenumber_tokenized, $nationality, $ssn_tokenized, $address_encrypted, $city_encrypted, $postcode_tokenized, $country, $cardnumber_tokenized, $expiredate_tokenized, $cvv_tokenized);


//Save the customer in clear
$dbh = new DBHelper();
$id = $dbh->addCustomer('customer_clear', $firstname, $lastname, $birthDate, $phoneNumber, $nationality, $ssn, $address, $city, $postcode, $country, $cardNumber, $expiredate, $cvv);
print 'after first insert';
//Create Encrypted Row
$vaeh = new VAEHelper();
$firstname_encrypted = $vaeh->encrypt($firstname, $encryptionKey);
print "Firstname  : ".$firstname_encrypted;
$lastname_encrypted = $vaeh->encrypt($lastname, $encryptionKey);
print "Lastname : ".$lastname_encrypted;
$address_encrypted = '';
if ($address !== '') {
  $address_encrypted = $vaeh->encrypt($address, $encryptionKey);  
}
print "Address : ".$address_encrypted;
$city_encrypted = $vaeh->encrypt($city, $encryptionKey);
print "City : ".$city_encrypted;



//Saving the picture
$target_file = "../img/".$id;
$imageFileType = pathinfo($_FILES["picture"]["name"],PATHINFO_EXTENSION);

$uploadOk = 1;
$check = getimagesize($_FILES["picture"]["tmp_name"]);
if($check !== false) {
    echo "File is an image - " . $check["mime"] . ".";
    $uploadOk = 1;
} else {
    echo "File is not an image.";
    $uploadOk = 0;
}
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
}

if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["picture"]["tmp_name"], "../img/".$id.'.jpg')) {
        echo "The file ". basename( $_FILES["picture"]["name"]). " has been uploaded.";
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}

/*print "
  <BR><center><font size=5>
  <B>Customer Added.
  <BR><BR><BR><BR><BR><BR><BR>
  <a href=\"/appli/databaseview.php?user=$user&passwd=$passwd\">Home</a>
  <meta http-equiv='refresh' content='1;url=/appli/databaseview.php?user=$user&passwd=$passwd' />";*/
?>
</body>
</html>