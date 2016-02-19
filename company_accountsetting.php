<?php 
session_start();
error_reporting(E_PARSE);
$con=mysql_connect("localhost","root","");
    if(! $con)
    die("couldn't connect to database");
    else
    mysql_select_db("hr",$con) or die("cannot select db");	
if(isset($_POST['s1']))
{
	$cname=stripslashes(trim($_POST['cname']));
	$cmail=stripslashes(trim($_POST['cmail']));
	$cpassword=stripslashes(trim($_POST['cpassword']));
	$ccontact=stripslashes(trim($_POST['ccontact']));
	$caddress=stripslashes(trim($_POST['caddress']));
	$cdescription=addslashes($_POST['cdescription']);
	$category=addslashes($_POST['category']);
	$up1="update company set cname='".$cname."',cmail='".$cmail."',cpassword='".$cpassword."',caddress='".$caddress."',ccontact='".$ccontact."',cdescription='".$cdescription."',category='".$category."' where cid='".$_SESSION[cid]."'";
	mysql_query($up1)or die(mysql_error());
}
$sel="select cname,cmail,cpassword,caddress,ccontact,cdescription from company where cid='".$_SESSION[cid]."'";
$s=mysql_query($sel) or die(mysql_error());
$l=mysql_fetch_array($s);
echo("<html>
<head>
<title>Account Setting</title>
</head>
<body>
<script type=\"text/javascript\">
function notify()
{
alert(\"Your company account has been updated.\");
}
</script>
<h3>Account Settings</h3>
<form id=\"f1\" action=\"company_accountsetting.php\" method=\"POST\">
Company Name:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type=\"text\" name=\"cname\" value=\"$l[cname]\"><br><br>
Company Mail Id:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type=\"text\" name=\"cmail\" value=\"$l[cmail]\"><br><br>
Company Password:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type=\"password\" name=\"cpassword\" value=\"$l[cpassword]\"><br><br>
Company Address:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type=\"text\" name=\"caddress\" value=\"$l[caddress]\"><br><br>
Company Contact:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<input type=\"text\" name=\"ccontact\" value=\"$l[ccontact]\"><br><br>

Company Job Category:
<select name=\"category\">
<option value=\"general\">general</option>
<option value=\"it\">Computer/IT/Software</option>
<option value=\"elec\">Electronics/Electrical</option>
<option value=\"extc\">Electronics/Telecom</option>
<option value=\"mech\">Mechanical</option>
<option value=\"chem\">Chemical</option>
<option value=\"none\">None</option>
</select>
<br><br>
Company Description:&nbsp;&nbsp;&nbsp;
<textarea name=\"cdescription\" rows=\"5\" cols=\"30\">$l[cdescription]</textarea><br><br><br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<input type=\"submit\" name=\"s1\" value=\"Apply Changes\" onclick=\"notify()\"><br><br>
</form>
</body>
</html> ");
?>