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
    <div class="col-xs-8"> <a href="#" class="site-logo"><img src="img/vormetric-logo.png"></a>
      <h3><span class="verticalPipe"></span><i class="fa fa-check-circle"></i>Vormetric Demo</h3>
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

include "utils/DBHelper.php";
print "
</table>
<HR>
<table width=100% border=1>
<div class=\"row\">
<TR><td bgcolor=#dddddd><b>Tokenization :</b></td><TR>

<TD>
<div class=\"col-md-6\">
<FORM ACTION=\"tokenize.php\" METHOD=\"POST\">

<BR>Input to tokenize:  <INPUT  NAME=\"data\"  size=\"30\" maxlength=\"25\">
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

<INPUT TYPE=\"SUBMIT\" NAME=\"SUBMIT\" VALUE=\"SUBMIT\"></p>

</FORM>
</div>
<div class=\"col-md-6\">
<FORM ACTION=\"detokenize.php\" METHOD=\"POST\">

<BR>Input to detokenize:  <INPUT  NAME=\"data\"  size=\"30\" maxlength=\"25\">
<BR>
     Format:  
	<input type=\"radio\" name=\"template\" value=\"VTSDemoTok\" checked> FPE Templa
	<input type=\"radio\" name=\"template\" value=\"Numbers-Group_Key1\"> Numbers 
	<input type=\"radio\" name=\"template\" value=\"Alpha-Group_Key1\"> Alpha
	<input type=\"radio\" name=\"template\" value=\"ASCII-Group_Key1\"> ASCII
<BR><BR>
<input type=\"hidden\" name=\"user\" value=\"$user\">
<input type=\"hidden\" name=\"passwd\" value=\"$passwd\">
<input type=\"hidden\" name=\"action\" value=\"tokenize\">

<INPUT TYPE=\"SUBMIT\" NAME=\"SUBMIT\" VALUE=\"SUBMIT\"></p>

</FORM>
</div>
</td> 
</div>
<div class=\"row\">
<TR><td bgcolor=#dddddd><b>Encryption :</b></td><TR>
<TD>
<div class=\"col-md-6\">
<FORM ACTION=\"vae/encrypt.php\" METHOD=\"POST\">

<BR>Input to Encrypt:  <INPUT  NAME=\"data\"  size=\"30\" maxlength=\"25\">
<BR>
     Format:  
	<input type=\"radio\" name=\"key\" value=\"java_test_key_sym\" checked> Symetric Key
	<input type=\"radio\" name=\"key\" value=\"Numbers-Group_Key1\"> Numbers 
	<input type=\"radio\" name=\"key\" value=\"Alpha-Group_Key1\"> Alpha
	<input type=\"radio\" name=\"key\" value=\"ASCII-Group_Key1\"> ASCII
<BR><BR>
<input type=\"hidden\" name=\"user\" value=\"$user\">
<input type=\"hidden\" name=\"passwd\" value=\"$passwd\">
<input type=\"hidden\" name=\"action\" value=\"tokenize\">

<INPUT TYPE=\"SUBMIT\" NAME=\"SUBMIT\" VALUE=\"SUBMIT\"></p>

</FORM>
</div>
<div class=\"col-md-6\">
<FORM ACTION=\"vae/decrypt.php\" METHOD=\"POST\">

<BR>Input to decrypt:  <INPUT  NAME=\"data\"  size=\"30\" maxlength=\"25\">
<BR>
     Format:  
	<input type=\"radio\" name=\"key\" value=\"java_test_key_sym\" checked> Symetric Key
	<input type=\"radio\" name=\"key\" value=\"Numbers-Group_Key1\"> Numbers 
	<input type=\"radio\" name=\"key\" value=\"Alpha-Group_Key1\"> Alpha
	<input type=\"radio\" name=\"key\" value=\"ASCII-Group_Key1\"> ASCII
<BR><BR>
<input type=\"hidden\" name=\"user\" value=\"$user\">
<input type=\"hidden\" name=\"passwd\" value=\"$passwd\">
<input type=\"hidden\" name=\"action\" value=\"tokenize\">

<INPUT TYPE=\"SUBMIT\" NAME=\"SUBMIT\" VALUE=\"SUBMIT\"></p>

</FORM>
</div>
</td> 
</div>
<div class=\"row\">
<TR><td bgcolor=#dddddd><b>Signing :</b></td><TR>
<TD>
<div class=\"col-md-6\">
<FORM ACTION=\"vae/signing.php\" METHOD=\"POST\">

<BR>Input to Sign:  <INPUT  NAME=\"data\"  size=\"30\" maxlength=\"25\">
<BR>
     Format:  
	<input type=\"radio\" name=\"key\" value=\"vae-keypair\" checked> Asymetric Key
	<input type=\"radio\" name=\"key\" value=\"Numbers-Group_Key1\"> Numbers 
	<input type=\"radio\" name=\"key\" value=\"Alpha-Group_Key1\"> Alpha
	<input type=\"radio\" name=\"key\" value=\"ASCII-Group_Key1\"> ASCII
<BR><BR>
<input type=\"hidden\" name=\"user\" value=\"$user\">
<input type=\"hidden\" name=\"passwd\" value=\"$passwd\">
<input type=\"hidden\" name=\"action\" value=\"tokenize\">

<INPUT TYPE=\"SUBMIT\" NAME=\"SUBMIT\" VALUE=\"SUBMIT\"></p>

</FORM>
</div>
<div class=\"col-md-6\">
<FORM ACTION=\"vae/verify.php\" METHOD=\"POST\">

<BR>Input to Verify:  <INPUT  NAME=\"data\"  size=\"30\" maxlength=\"25\">
<BR>
Signature: <INPUT  NAME=\"sign\"  size=\"30\" maxlength=\"500\">
<BR>
     Format:  
	<input type=\"radio\" name=\"key\" value=\"vae-keypair\" checked> Asymetric Key
	<input type=\"radio\" name=\"key\" value=\"Numbers-Group_Key1\"> Numbers 
	<input type=\"radio\" name=\"key\" value=\"Alpha-Group_Key1\"> Alpha
	<input type=\"radio\" name=\"key\" value=\"ASCII-Group_Key1\"> ASCII
<BR><BR>
<input type=\"hidden\" name=\"user\" value=\"$user\">
<input type=\"hidden\" name=\"passwd\" value=\"$passwd\">
<input type=\"hidden\" name=\"action\" value=\"tokenize\">

<INPUT TYPE=\"SUBMIT\" NAME=\"SUBMIT\" VALUE=\"SUBMIT\"></p>

</FORM>
</div>
</td> 
</div>
<div class=\"row\">
<TR><td bgcolor=#dddddd><b>Digest :</b></td><TR>
<TD>
<div class=\"col-md-6\">
<FORM ACTION=\"vae/digest.php\" METHOD=\"POST\">

<BR>Input to Digest:  <INPUT  NAME=\"data\"  size=\"30\" maxlength=\"25\">
<BR>
     Format:  
	<input type=\"radio\" name=\"algo\" value=\"SHA256\" checked> SHA256
	<input type=\"radio\" name=\"algo\" value=\"Numbers-Group_Key1\"> Numbers 
	<input type=\"radio\" name=\"algo\" value=\"Alpha-Group_Key1\"> Alpha
	<input type=\"radio\" name=\"algo\" value=\"ASCII-Group_Key1\"> ASCII
<BR><BR>
<input type=\"hidden\" name=\"user\" value=\"$user\">
<input type=\"hidden\" name=\"passwd\" value=\"$passwd\">
<input type=\"hidden\" name=\"action\" value=\"tokenize\">

<INPUT TYPE=\"SUBMIT\" NAME=\"SUBMIT\" VALUE=\"SUBMIT\"></p>

</FORM>
</div>
</td> 
</div>
</table> ";
print 	"
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
//$id = $_GET['id'];
$user = $_POST['user'];
$passwd = $_POST['passwd'];
if ($user == "") { $user = $_GET['user']; $passwd = $_GET['passwd']; } 

$dbh = new DBHelper();
$results = $dbh->getAllDatabase();
//DEBUG
$nb = 0;
foreach ($results as $line) {
	if($nb++ === 5)
		break;
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