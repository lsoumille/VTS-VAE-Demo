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

$vtsh = new VTSHelper();
$vaeh = new VAEHelper();

//Retrive all form data
$firstname = $_POST['name'];
$firstname_encrypted = $vaeh->encrypt($firstname, $encryptionKey);
$lastname = $_POST['surname'];
$lastname_encrypted = $vaeh->encrypt($lastname, $encryptionKey);
$birthDate = date("Y/m/d", strtotime($_POST['datepicker']));
$birthDate_tokenized = $vtsh->tokenize('CustomerData', $birthDate, 'datetemplate', $user, $passwd);
$cardNumber = null;
$cardnumber_tokenized = null;
if (isset($_POST['card-number'])) {
  $cardNumber = $_POST['card-number'];
  $cardnumber_tokenized = $vtsh->tokenize('PaymentData', $cardNumber, 'creditcard', $user, $passwd);
}
$expireDate = null;
$expireDate_tokenized = null;
if (isset($_POST['expiry-month']) && isset($_POST['expiry-year']) && $_POST['expiry-month'] !== 'Month' && $_POST['expiry-year']) {
  $expireDate = $_POST['expiry-year'].$_POST['expiry-month'].'/01';
  $expireDate_tokenized = $vtsh->tokenize('PaymentData', $expiredate, 'shortdate', $user, $passwd);
}
//$expireYear = $_POST['expiry-year'];
$cvv = null;
$cvv_tokenized = null;
if (isset($_POST['cvv']) && $_POST['cvv'] !== '') {
  $cvv = $_POST['cvv'];
  $cvv_tokenized = $vtsh->tokenize('PaymentData', $cvv, 'cvv', $user, $passwd);
}
$phoneNumber = null;
$phonenumber_tokenized = null;
if (isset($_POST['phonenumber']) && $_POST['phonenumber'] !== '') {
  $phoneNumber = $_POST['phonenumber'];
  $phonenumber_tokenized = $vtsh->tokenize('CustomerData', $phoneNumber, 'phonenumber', $user, $passwd);  
}
$nationality = null;
if (isset($_POST['nationality']) && $_POST['nationality'] !== '') {
  $nationality = $_POST['nationality'];  
}
$address = null;
$address_encrypted = null;
if (isset($_POST['address']) && $_POST['address'] !== '') {
  $address = $_POST['address'];
  $address_encrypted = $vaeh->encrypt($address, $encryptionKey);
}
$city = null;
$city_encrypted = null;
if (isset($_POST['city']) && $_POST['city'] !== '') {
  $city = $_POST['city'];
  $city_encrypted = $vaeh->encrypt($city, $encryptionKey);  
}
$postcode = null;
$postcode_tokenized = null;
if (isset($_POST['postcode']) && $_POST['postcode'] !== '') {
  $postcode = $_POST['postcode'];
  $postcode_tokenized = $vtsh->tokenize('CustomerData', $postcode, 'phonenumber', $user, $passwd);  
}
$country = null;
if (isset($_POST['country']) && $_POST['country'] !== '') {
  $country = $_POST['country'];  
}
$ssn = null;
$ssn_tokenized = null;
if (isset($_POST['ssn']) && $_POST['ssn'] !== '') {
  $ssn = $_POST['ssn'];
  $ssn_tokenized = $vtsh->tokenize('CustomerData', $ssn, 'ssn', $user,$passwd);
}

$dbh = new DBHelper();
//Save the encrypted data
$id = $dbh->addCustomer('customer', $firstname_encrypted, $lastname_encrypted, $birthDate_tokenized, $phonenumber_tokenized, $nationality, $ssn_tokenized, $address_encrypted, $city_encrypted, $postcode_tokenized, $country, $cardnumber_tokenized, $expireDate_tokenized, $cvv_tokenized);

//Save the customer in clear
$dbh->addCustomer('customer_clear', $firstname, $lastname, $birthDate, $phoneNumber, $nationality, $ssn, $address, $city, $postcode, $country, $cardNumber, $expireDate, $cvv);


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
?>
</body>
</html>