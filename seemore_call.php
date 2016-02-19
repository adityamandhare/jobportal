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
<head><title>view call details</title></head>
<body>

");

$cid=$_GET['companyid'];
if($cid=="" or $cid==" ")
{
header('Location:user.php');
}
$sel="SELECT *
FROM hr.call,company
WHERE hr.call.cid=company.cid and call.cid =$cid and call.uid='".$_SESSION[userlogin]."'";
$s=mysql_query($sel) or die(mysql_error());
$l=mysql_fetch_array($s);
if(mysql_num_rows($s)==0)
echo("Sorry!!A wrong request has been blocked.");
else 
echo("
<font size=\"3\"><i>Congrtulations!! You have received call from</i>&nbsp;$l[cname]</font>
<br><br>
<b>Call date:</b>&nbsp;$l[calldate]&nbsp;&nbsp;(yyyy-mm-dd)<br><br>
<b>Job profile:</b>&nbsp;$l[position]<br><br>
<b>Message from company:</b>&nbsp;$l[callmessage]
");
echo("
<br><br>
<a href=\"user.php\">back</a>
</body>
</html>
");
?>