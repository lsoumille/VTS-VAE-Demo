 <?php
include '../config.php';
include '../utils/DBHelper.php';
include '../utils/VAEHelper.php';
include '../utils/VTSHelper.php';

$vtsh = new VTSHelper();
$vaeh = new VAEHelper();

//Retrive all form data
$firstname            = $_POST['name'];
$firstname_encrypted  = $vaeh->encrypt($firstname, $encryption_key);
$lastname             = $_POST['surname'];
$lastname_encrypted   = $vaeh->encrypt($lastname, $encryption_key);
$birth_date            = date("Y/m/d", strtotime($_POST['datepicker']));
$birth_date_tokenized  = $vtsh->tokenize('CustomerData', $birth_date, 'datetemplate', $user, $passwd);
$card_number           = null;
$card_number_tokenized = null;
if (isset($_POST['card-number'])) {
    $card_number           = $_POST['card-number'];
    $card_number_tokenized = $vtsh->tokenize('PaymentData', $card_number, 'creditcard', $user, $passwd);
}
$expire_date           = null;
$expire_date_tokenized = null;
if (isset($_POST['expiry-month']) && isset($_POST['expiry-year']) && $_POST['expiry-month'] !== 'Month' && $_POST['expiry-year']) {
    $expire_date = '20' . $_POST['expiry-year'] . '/' . $_POST['expiry-month'] . '/01';
    $expire_date_tokenized = $vtsh->tokenize('PaymentData', $expire_date, 'datetemplate_forcb', $user, $passwd);
}
//$expireYear = $_POST['expiry-year'];
$cvv           = null;
$cvv_tokenized = null;
if (isset($_POST['cvv']) && $_POST['cvv'] !== '') {
    $cvv           = $_POST['cvv'];
    $cvv_tokenized = $vtsh->tokenize('PaymentData', $cvv, 'cvv', $user, $passwd);
}
$phone_number           = null;
$phone_number_tokenized = null;
if (isset($_POST['phonenumber']) && $_POST['phonenumber'] !== '') {
    $phone_number           = $_POST['phonenumber'];
    $phone_number_tokenized = $vtsh->tokenize('CustomerData', $phone_number, 'phonenumber', $user, $passwd);
}
$nationality = null;
if (isset($_POST['nationality']) && $_POST['nationality'] !== '') {
    $nationality = $_POST['nationality'];
}
$address           = null;
$address_encrypted = null;
if (isset($_POST['address']) && $_POST['address'] !== '') {
    $address           = $_POST['address'];
    $address_encrypted = $vaeh->encrypt($address, $encryption_key);
}
$city           = null;
$city_encrypted = null;
if (isset($_POST['city']) && $_POST['city'] !== '') {
    $city           = $_POST['city'];
    $city_encrypted = $vaeh->encrypt($city, $encryption_key);
}
$postcode           = null;
$postcode_tokenized = null;
if (isset($_POST['postcode']) && $_POST['postcode'] !== '') {
    $postcode           = $_POST['postcode'];
    $postcode_tokenized = $vtsh->tokenize('CustomerData', $postcode, 'phonenumber', $user, $passwd);
}
$country = null;
if (isset($_POST['country']) && $_POST['country'] !== '') {
    $country = $_POST['country'];
}
$ssn           = null;
$ssn_tokenized = null;
if (isset($_POST['ssn']) && $_POST['ssn'] !== '') {
    $ssn           = $_POST['ssn'];
    $ssn_tokenized = $vtsh->tokenize('CustomerData', $ssn, 'ssn', $user, $passwd);
}

$dbh = new DBHelper();
//Save the encrypted data
$id  = $dbh->addCustomer('customer', $firstname_encrypted, $lastname_encrypted, $birth_date_tokenized, $phone_number_tokenized, $nationality, $ssn_tokenized, $address_encrypted, $city_encrypted, $postcode_tokenized, $country, $card_number_tokenized, $expire_date_tokenized, $cvv_tokenized);

//Save the customer in clear
$dbh->addCustomer('customer_clear', $firstname, $lastname, $birth_date, $phone_number, $nationality, $ssn, $address, $city, $postcode, $country, $card_number, $expire_date, $cvv);


//Saving the picture
$target_file   = "../img/" . $id;
$image_file_type = pathinfo($_FILES["picture"]["name"], PATHINFO_EXTENSION);

var_dump($_FILES["picture"]);

$upload_ok = 1;
$check     = false;
if ($_FILES["picture"]["tmp_name"] !== null && $_FILES["picture"]["tmp_name"] !== '') {
    $check = getimagesize($_FILES["picture"]["tmp_name"]);
}
if ($check !== false) {
    echo "File is an image - " . $check["mime"] . ".";
    $upload_ok = 1;
} else {
    echo "File is not an image.";
    $upload_ok = 0;
}
if ($image_file_type != "jpg" && $image_file_type != "png" && $image_file_type != "jpeg" && $image_file_type != "gif") {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $upload_ok = 0;
}

if ($upload_ok != 0 && move_uploaded_file($_FILES["picture"]["tmp_name"], "../img/" . $id . '.jpg')) {
    echo "The file ". basename( $_FILES["picture"]["name"]). " has been uploaded.";
} else {
    echo "Sorry, there was an error uploading your file.";
}

?> 