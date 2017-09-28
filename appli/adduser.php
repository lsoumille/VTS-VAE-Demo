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

//Retrive all form data
$firstname = $_POST['name'];
$lastname = $_POST['surname'];
$birthDate = $_POST['datepicker'];
$cardNumber = $_POST['card-number'];
$expireMonth = $_POST['expiry-month'];
$expireYear = $_POST['expiry-year'];
$cvv = $_POST['cvv'];
$phoneNumber = $_POST['phonenumber'];
$nationality = $_POST['nationality'];
$address = $_POST['address'];
$city = $_POST['city'];
$postcode = $_POST['postcode'];
$country = $_POST['country'];
$ssn = $_POST['ssn'];

//Converting dates
$expiredate = $expireMonth.'/'.$expireYear;
//First save the customer in clear
$dbh = new DBHelper();
$id = $dbh->addCustomer('customer_clear', $firstname, $lastname, $birthDate, $phoneNumber, $nationality, $ssn, $address, $city, $postcode, $country, $cardNumber, $expiredate, $cvv);

//Create Encrypted Row
$vaeh = new VAEHelper();
$firstname_encrypted = $vaeh->encrypt($firstname, $encryptionKey);
$lastname_encrypted = $vaeh->encrypt($lastname, $encryptionKey);
$address_encrypted = $vaeh->encrypt($address, $encryptionKey);
$city_encrypted = $vaeh->encrypt($city, $encryptionKey);

$vtsh = new VTSHelper();


//Saving the picture
$target_file = "../img/".$id.basename($_FILES["picture"]["name"]);
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
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
    if (move_uploaded_file($_FILES["picture"]["tmp_name"], $target_file)) {
        echo "The file ". basename( $_FILES["picture"]["name"]). " has been uploaded.";
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}

?>
</body>
</html>