<?php 
session_start();
error_reporting(E_PARSE);
$con=mysql_connect("localhost","root","");
    if(! $con)
    die("couldn't connect to database");
    else
    mysql_select_db("hr",$con) or die("cannot select db");	


//$_SESSION['cid']=5;
echo("
<html>
<head><title>Company Logged In</title></head>
<body>
<form id=\"f1\" action=\"company.php\" method=\"POST\">
<input type=\"submit\" name=\"s1\" value=\"View Applications\">
&nbsp;&nbsp;&nbsp;
<input type=\"submit\" name=\"s2\" value=\"Modify Existing Test\">
&nbsp;&nbsp;&nbsp;
<input type=\"submit\" name=\"s3\" value=\"Create New Test\">
&nbsp;&nbsp;&nbsp;
<input type=\"submit\" name=\"s4\" value=\"Update Company Account\">
</form>
</body></html>
");
if(isset($_POST['s1']))
{
	$_SESSION['first']=0;
header('Location:placement.php');
}
else 
if(isset($_POST['s2']))
{
header('Location:altertest.php');	
}
else
if(isset($_POST['s3']))
{
	
$_SESSION['del_question']=0;
$_SESSION['check1']=0;
	
$sel="select testcreated from company where cid='".$_SESSION[cid]."'";
$val=mysql_query($sel) or die(mysql_error());        
$valu=mysql_fetch_array($val);
$value=$valu['testcreated'];

if($value=='y')
{
$del="delete from test where company='".$_SESSION[cid]."'";
mysql_query($del) or die(mysql_error());
}
header('Location:createtest.php');
}
if(isset($_POST['s4']))
{
header('Location:company_accountsetting.php');
}
?>