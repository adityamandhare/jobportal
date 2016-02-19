<?php 
session_start();
error_reporting(E_PARSE);
$con=mysql_connect("localhost","root","");
    if(! $con)
    die("couldn't connect to database");
    else
    mysql_select_db("hr",$con) or die("cannot select db");	


    
echo("
<html>
<head>
<title>Career Launcher-where job searches you!</title>
<link rel=\"stylesheet\" href=\"pattern1.css\"> 
</head>
<body>

<table align=\"center\"  width=\"80%\" border=\"0\">
<tr>
<td width=\"100%\" height=\"120\" bgcolor=\"#FFA500\">
<table width=\"100%\">
<tr>
<td width=\"100%\">
&nbsp;&nbsp;
<font color=\"#FFFFFF\" face=\"Elephant\" size=\"10\">Career Launcher</font>
<SUB><font color=\"#FFFFFF\" face=\"Elephant\" size=\"3\">...where job searches you!</font></SUB>
<br>
<div align=\"right\">
<font color=\"#FFFFFF\" face=\"Times New Roman\" size=\"3\">
<a href=\"\"><b>home</b></a>&nbsp;|&nbsp;
<a href=\"\"><b>register</b></a>&nbsp;|&nbsp;
<a href=\"\"><b>contact us</b></a>&nbsp;&nbsp;
</font>
</div>
</td>
</tr>
</table>
</td>
</tr>
");

echo("
<tr>
<td width=\"100%\">
<table width=\"100%\" border=\"0\">
<tr>

<td width=\"20%\">
<table width=\"100%\">
<tr><td width=\"100%\">
<img src=\"images/p1.gif\" width=\"330\" height=\"200\"></img>
<br>
</td></tr>

<tr><td width=\"100%\">
<br><br><br><br>
<img src=\"images/p3.jpeg\" width=\"330\" height=\"200\"></img>
</td></tr></table>
</td>

<td width=\"80%\">
<table width=\"100%\">
<tr><td width=\"100%\">
<br><br>
<b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

<font color=\"#008000\">User Login:</font></b>
<br><br>
<center>
<form id=\"f1\" action=\"home.php\" method=\"POST\">
<table border=\"0\" width=\"60%\">
<tr><td width=\"23%\">User mail id:</td><td width=\"77%\"><input type=\"text\" name=\"umail\"></td>
<tr><td width=\"23%\"><br>Password:</td><td width=\"77%\"><br><input type=\"password\" name=\"upass\"></td></tr>
<tr><td><br><input type=\"submit\" name=\"s1\" value=\"login\"></td></tr>
</table>
</form>
</center>");


if(isset($_POST['s1']))
{
	$m=stripslashes(trim($_POST['umail']));
    $p=stripslashes(trim($_POST['upass']));

$sel="select umail,upassword from user where user.umail='".$m."' and user.upassword='".$p."'";
$s=mysql_query($sel) or die(mysql_error());

if(mysql_num_rows($s)==0)
{
	echo("<center><font color=\"#800000\"><b>Incorrect email id or password!!</b></font></center>");
}
else 
{
	$_SESSION['userlogin']=$m;
	header('Location:user.php');
}
}
    




echo("
<br><br>
<hr width=\"80%\"></hr>
<br>");

echo("<br>
<b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<font color=\"#800000\">Company Login:</font></b>
<br><br>
<center>
<form id=\"f2\" action=\"home.php\" method=\"POST\">
<table border=\"0\" width=\"60%\">
<tr><td width=\"29%\">Company mail id:</td><td width=\"71%\"><input type=\"text\" name=\"cmail\"></td>
<tr><td width=\"29%\"><br>Password:</td><td width=\"71%\"><br><input type=\"password\" name=\"cpass\"></td></tr>
<tr><td><br><input type=\"submit\" name=\"s2\" value=\"login\"></td></tr>
</table>
</form>
</center>
");

if(isset($_POST['s2']))
{
	//echo("Hello");
	$m=stripslashes(trim($_POST['cmail']));
    $p=stripslashes(trim($_POST['cpass']));
    
$sel="select cid,cname from company where company.cmail='".$m."' and company.cpassword='".$p."' ";
$s=mysql_query($sel) or die(mysql_error());
$l=mysql_fetch_array($s);
$temp=$l['cid'];
if(mysql_num_rows($s)==0)
{
	echo("<center><font color=\"#800000\"><b>Incorrect email id or password!!</b></font></cemter><br><br>");
}
else 
{
	$_SESSION['cid']=$temp;
	header('Location:company.php');
}
}



ech("
</td></tr></table>
</td></tr>
</table>

</td></tr>
</table>
</body>
</html>
");
?>