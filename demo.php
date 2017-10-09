<HTML>
<HEAD>
  <TITLE>Vormetric Toolbox</TITLE>
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
    <div class="col-md-6"> <a href="#" class="site-logo"><img src="vormetric-logo.png"></a>
      <h3><span class="verticalPipe"></span><i class="fa fa-check-circle"></i>Vormetric Toolbox</h3>
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
		include 'config.php';

		print "Welcome, $user. <a href=\"index.html\">Logout</a>"; 
	?>
		</h4>
    </div>
</header>
<div class="container-fluid">

<?php

include "utils/DBHelper.php";
print "
</table>
<HR>
<table width=100% border=1>
<div class=\"row\">
<TR><td bgcolor=#dddddd><b>Tokenization :</b></td><TR>

<TD>
<div class=\"col-md-6\">
<FORM ACTION=\"vts/tokenize.php\" METHOD=\"POST\" id=\"formTok\">

<BR>Input to tokenize:  <INPUT  id=\"tokInput\" NAME=\"data\"  size=\"30\" maxlength=\"25\">
<BR>
     Format:  
	<input type=\"radio\" name=\"template\" value=\"VTSDemoTok\" checked> FPE Template
	<input type=\"radio\" name=\"template\" value=\"Numbers-Group_Key1\"> Numbers 
	<input type=\"radio\" name=\"template\" value=\"Alpha-Group_Key1\"> Alpha
	<input type=\"radio\" name=\"template\" value=\"ASCII-Group_Key1\"> ASCII
<BR><BR>
<input type=\"hidden\" name=\"user\" value=\"$user\">
<input type=\"hidden\" name=\"passwd\" value=\"$passwd\">
<input type=\"hidden\" name=\"action\" value=\"tokenize\">

<INPUT TYPE=\"SUBMIT\" NAME=\"SUBMIT\" VALUE=\"SUBMIT\">

</FORM>
</div>
<div class=\"col-md-6\">
<FORM ACTION=\"vts/detokenize.php\" METHOD=\"POST\" id=\"formDetok\">

<BR>Input to detokenize:  <INPUT  id=\"detokInput\" NAME=\"data\"  size=\"30\" maxlength=\"25\">
<BR>
     Format:  
	<input type=\"radio\" name=\"template\" value=\"VTSDemoTok\" checked> FPE Template
	<input type=\"radio\" name=\"template\" value=\"Numbers-Group_Key1\"> Numbers 
	<input type=\"radio\" name=\"template\" value=\"Alpha-Group_Key1\"> Alpha
	<input type=\"radio\" name=\"template\" value=\"ASCII-Group_Key1\"> ASCII
<BR><BR>
<input type=\"hidden\" name=\"user\" value=\"$user\">
<input type=\"hidden\" name=\"passwd\" value=\"$passwd\">
<input type=\"hidden\" name=\"action\" value=\"tokenize\">

<INPUT TYPE=\"SUBMIT\" NAME=\"SUBMIT\" VALUE=\"SUBMIT\">

</FORM>
</div>
</td> 
</div>
<div class=\"row\">
<TR><td bgcolor=#dddddd><b>Encryption (AES 256):</b></td><TR>
<TD>
<div class=\"col-md-6\">
<FORM ACTION=\"vae/encrypt.php\" METHOD=\"POST\" id=\"formEncrypt\">

<BR>Input to Encrypt:  <INPUT id=\"encryptInput\" NAME=\"data\"  size=\"30\" maxlength=\"25\">
<BR>
<input type=\"hidden\" name=\"user\" value=\"$user\">
<input type=\"hidden\" name=\"passwd\" value=\"$passwd\">
<input type=\"hidden\" name=\"action\" value=\"tokenize\">
<input type=\"hidden\" name=\"key\" value=\"java_test_key_sym\">

<INPUT TYPE=\"SUBMIT\" NAME=\"SUBMIT\" VALUE=\"SUBMIT\">

</FORM>
</div>
<div class=\"col-md-6\">
<FORM ACTION=\"vae/decrypt.php\" METHOD=\"POST\" id=\"formDecrypt\">

<BR>Input to decrypt:  <INPUT  id=\"decryptInput\" NAME=\"data\"  size=\"30\" maxlength=\"25\">
<BR>
<input type=\"hidden\" name=\"user\" value=\"$user\">
<input type=\"hidden\" name=\"passwd\" value=\"$passwd\">
<input type=\"hidden\" name=\"action\" value=\"tokenize\">
<input type=\"hidden\" name=\"key\" value=\"java_test_key_sym\">

<INPUT TYPE=\"SUBMIT\" NAME=\"SUBMIT\" VALUE=\"SUBMIT\">

</FORM>
</div>
</td> 
</div>
<div class=\"row\">
<TR><td bgcolor=#dddddd><b>Signing (RSA 2048):</b></td><TR>
<TD>
<div class=\"col-md-6\">
<FORM ACTION=\"vae/signing.php\" METHOD=\"POST\" id=\"formSign\">

<BR>Input to Sign:  <INPUT  id=\"signInput\" NAME=\"data\"  size=\"30\" maxlength=\"25\">
<BR>
<input type=\"hidden\" name=\"user\" value=\"$user\">
<input type=\"hidden\" name=\"passwd\" value=\"$passwd\">
<input type=\"hidden\" name=\"action\" value=\"tokenize\">
<input type=\"hidden\" name=\"key\" value=\"vae-keypair\">
<INPUT TYPE=\"SUBMIT\" NAME=\"SUBMIT\" VALUE=\"SUBMIT\">

</FORM>
</div>
<div class=\"col-md-6\">
<FORM ACTION=\"vae/verify.php\" METHOD=\"POST\" id=\"formVerify\">

<BR>Input to Verify:  <INPUT  id=\"signToVerifyInput\" NAME=\"data\"  size=\"30\" maxlength=\"25\">
<BR>
Signature: <INPUT  id=\"verifyInput\" NAME=\"sign\"  size=\"30\" maxlength=\"500\">
<p id=\"resultSig\"></p>
<input type=\"hidden\" name=\"user\" value=\"$user\">
<input type=\"hidden\" name=\"passwd\" value=\"$passwd\">
<input type=\"hidden\" name=\"action\" value=\"tokenize\">
<input type=\"hidden\" name=\"key\" value=\"vae-keypair\">

<INPUT TYPE=\"SUBMIT\" NAME=\"SUBMIT\" VALUE=\"SUBMIT\">

</FORM>
</div>
</td> 
</div>
<div class=\"row\">
<TR><td bgcolor=#dddddd><b>Digest (SHA 256):</b></td><TR>
<TD>
<div class=\"col-md-6\">
<FORM ACTION=\"vae/digest.php\" METHOD=\"POST\" id=\"formDigest\">

<BR>Input to Digest:  <INPUT id=\"digestInput\" NAME=\"data\"  size=\"30\" maxlength=\"25\">
<p id=\"resultDigest\"></p>
<input type=\"hidden\" name=\"user\" value=\"$user\">
<input type=\"hidden\" name=\"passwd\" value=\"$passwd\">
<input type=\"hidden\" name=\"action\" value=\"tokenize\">
<input type=\"hidden\" name=\"algo\" value=\"SHA256\">
<INPUT TYPE=\"SUBMIT\" NAME=\"SUBMIT\" VALUE=\"SUBMIT\">
</FORM>
</div>
</td> 
</div>
</table>
<script src=\"js/asynchronousCalls.js\"></script> 
";
print 	"
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
//$id = $_GET['id'];
$user = $_POST['user'];
$passwd = $_POST['passwd'];
if ($user == "") { $user = $_GET['user']; $passwd = $_GET['passwd']; } 

$dbh = new DBHelper();
//Get only last 5 results
$results = array_slice($dbh->getAllDatabase(), -5);
foreach ($results as $line) {
	$action = $line["action"];
	$id = $line["id"];
	$input = htmlspecialchars($line["input"]);
	$output = htmlspecialchars($line["output"]);
	$comments = $line["comments"];

	print "<TR>
	<TD>$id</td>
	<td>$action</td>
	<td>$input</td>
	<td>$output</td>
	<td>$comments</td>
	<td nowrap valign=middle><FONT SIZE=1>
	<a href=\"delete.php?id=$id&table=transformation\">Delete</a></td></tr>";
	}

print "</table>";
?>
</div>
</body>
<footer>
   <a href=javascript:window.open('https://support.vormetric.com/login');>Support </a><span>|</span>
   <a href=javascript:window.open('http://www.vormetric.com')>About </a><span>|</span>
   <!-- <a href="javascript:void(0);">Support</a><span>|</span>
<a href="javascript:void(0);">About</a><span>|</span>-->
   Copyright &copy; 2016 Vormetric. Inc. All rights reserved.

</footer>
