
<html>
<link href="/css/bootstrap.min.css" rel="stylesheet">
<link href="/css/vormetric.min.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="/css/base.css" />
<link rel="stylesheet" type="text/css" href="/css/dashboard.css" />
<link href="/css/skin.css" rel="stylesheet">
<link rel="stylesheet" href="css/font-awesome/css/font-awesome.min.css">
<?php
include 'utils/DBHelper.php';
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
</html>