<HTML>
<HEAD>
  <TITLE>Vormetric Tokenization Demo</TITLE>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>

</HEAD>
<link rel="icon" href="favicon.ico" type="image/x-icon" />
<link href="/css/bootstrap.min.css" rel="stylesheet">
<link href="/css/vormetric.min.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="/css/base.css" />
<link rel="stylesheet" type="text/css" href="/css/dashboard.css" />
<link href="/css/skin.css" rel="stylesheet">

<BODY  bgcolor="#FFFFFF">
<header class="container-fluid">
  <div class="row">
    <div class="col-xs-8"> <a href="#" class="site-logo"><img src="img/v-logo.jpg"></a>
      <h3><span class="verticalPipe"></span><i class="fa fa-check-circle"></i>Vormetric Tokenisation Demo Server </h3>
    </div>
    <div class="col-xs-4">
      <ul class="list-inline pull-right rightsideIcons">
	<?php

		$user = $_POST['user'];
		$passwd = $_POST['passwd'];
		if ($user == "") { $user = $_GET['user']; $passwd = $_GET['passwd']; }

		print " Welcome, <strong>$user</strong>. <a href=\"index.html\">Logout</a> "; 
	?>
        </li>
      </ul>
    </div>
  </div>
</header>

<?php

print 	"
	<table width=100% border=1>
	<TR>
	<TD bgcolor=#dddddd>ID#</TD>
	<td bgcolor=#dddddd>
		<b>Record</b>
		</td>
		<td bgcolor=#dddddd><b>
			Real/Masked Value</b></td>
		<td bgcolor=#dddddd><b>
			Tokenized Value in DB</b></td>
		<td bgcolor=#dddddd><b>
			Format/TemplateName</b></td>
		<td bgcolor=#dddddd><b>
			Delete</b></td></tr>
	" ;
//$id = $_GET['id'];
$user = $_POST['user'];
$passwd = $_POST['passwd'];
if ($user == "") { $user = $_GET['user']; $passwd = $_GET['passwd']; } 

//API Url
//$url_vts_tok = 'https://vts2.1.0v2/vts/rest/v2.0/tokenize';
//$url_vts_detok = 'https://vts2.1.0v2/vts/rest/v2.0/detokenize';
$url_vts_detok = 'https://google.com/';
//Initiate cURL.
//$tok = curl_init($url_vts_tok);
$detok = curl_init($url_vts_detok);

//Tell cURL that we want to send a POST request.
//curl_setopt($detok, CURLOPT_GET, true);
//curl_setopt($detok, CURLOPT_SSL_VERIFYPEER, false);

// Get cURL resource
$curl = curl_init();
// Set some options - we are passing in a useragent too here
curl_setopt_array($curl, array(
    CURLOPT_RETURNTRANSFER => 1,
    CURLOPT_URL => 'https://google.com/',
    CURLOPT_USERAGENT => 'Codular Sample cURL Request'
));
// Send the request & save response to $resp
$resp = curl_exec($curl);
var_dump($resp);
// Close request to clear up some resources
curl_close($curl);

//Set the content type of AUTH
//curl_setopt($detok, CURLOPT_HTTPAUTH, CURLAUTH_BASIC); 
//curl_setopt($detok, CURLOPT_USERPWD, "$user:$passwd"); 

//$link = mysql_connect("localhost", "apache", "apachsrv")
//		or die ("Could not connect to database.");

//mysql_select_db("vtsdemo")
//		or die ("Could not select database.");

$mysqli = new mysqli("192.168.99.122", "admin", "admin", "vtsdemo");

if ($mysqli->connect_errno) {
    echo "Echec lors de la connexion à MySQL : (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}

echo $mysqli->host_info . "\n";

$query = "SELECT * FROM customer order by id";
$result = $mysqli->query($query) or die ("Query failed. Result: $result");
var_dump(mysqli_fetch_array($result,MYSQLI_NUM));
/*while ($line = mysqli_fetch_array($result, MYSQLI_NUM)) 
	{
	extract($line);

	//The JSON data.
	$jsonData = array
		( 'tokengroup' => 'Group_Key1', 'token' => "$tokenvalue", 'tokentemplate' => "$template");
	//Attach our encoded JSON string to the POST fields.
	curl_setopt($detok, CURLOPT_POSTFIELDS, json_encode($jsonData));
	//Set the content type to application/json
	curl_setopt($detok, CURLOPT_HTTPHEADER, array('Content-Type: application/json')); 
	curl_setopt($detok, CURLOPT_RETURNTRANSFER, true); 
	//Execute the request
	$detok_values = curl_exec($detok);
	// Check for Errors
	//if (!$detok_values) {	die("\n\nConnection Failure.\n"); } 
	// return JSON into PHP array
	$obj = json_decode($detok_values);
	// Check for Errors
	if ( isset($obj->error) ) { die($obj->error_message."\n"); }
	//print "$obj->data\n";
	$masked = $obj->data;
	if ($masked == "") $masked="<font color=red>Failed to detokenize";

// Cleanup token value to make it printable through HTML //

	$htmltoken=htmlspecialchars($tokenvalue);
//
	
	print "<TR>
	<TD>$id</td>
	<td>$name</td>
	<td>$masked</td>
	<td>$htmltoken</td>
	<td>$template</td>
	<td nowrap valign=middle><FONT SIZE=1>
	<a href=\"delete.php?id=$id&user=$user&passwd=$passwd\">Delete</a></td></tr>";
	}*/
			
print "
</table>

<BR><BR><HR><BR><BR>

<table width=100% border=1>

<TR><td bgcolor=#dddddd><b>Add record:</b></td><TR>

<TD>
<FORM ACTION=\"addcustomer.php\" METHOD=\"POST\">

<BR>Record Name:  <INPUT  NAME=\"name\"  size=\"30\" maxlength=\"25\">
Value:  <INPUT  NAME=\"data\"  size=\"62\" maxlength=\"60\">
<BR>
     Format:  
	<input type=\"radio\" name=\"template\" value=\"Luhn-Group_Key1\"> Luhn 
	<input type=\"radio\" name=\"template\" value=\"Numbers-Group_Key1\" checked> Numbers 
	<input type=\"radio\" name=\"template\" value=\"Alpha-Group_Key1\"> Alpha
	<input type=\"radio\" name=\"template\" value=\"ASCII-Group_Key1\"> ASCII
<BR><BR>
<input type=\"hidden\" name=\"user\" value=\"$user\">
<input type=\"hidden\" name=\"passwd\" value=\"$passwd\">
<input type=\"hidden\" name=\"action\" value=\"tokenize\">

<INPUT TYPE=\"SUBMIT\" NAME=\"SUBMIT\" VALUE=\"SUBMIT\"></p>

</FORM> </td> </table> ";
?>
<footer>
   <a href=javascript:window.open('https://support.vormetric.com/login');>Support </a><span>|</span>
   <a href=javascript:window.open('http://www.vormetric.com')>About </a><span>|</span>
   <!-- <a href="javascript:void(0);">Support</a><span>|</span>
<a href="javascript:void(0);">About</a><span>|</span>-->
   Copyright &copy; 2016 Vormetric. Inc. All rights reserved.

</footer>
</body>
