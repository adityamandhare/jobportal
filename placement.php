<?php 
session_start();
error_reporting(E_PARSE);
$con=mysql_connect("localhost","root","");
    if(! $con)
    die("couldn't connect to database");
    else
    mysql_select_db("hr",$con) or die("cannot select db");	
$_SESSION['flag1']=0;
echo("<html><head><title>placement cell</title>
<link rel=\"stylesheet\" href=\"pattern.css\">
</head><body>
<h3>List Of Applicants</h3>
<br>
<form id=\"f1\" method=\"POST\" action=\"placement.php\">
<b>SORT BY:&nbsp;</b><input type=\"submit\" name=\"s1\" value=\"application date\">
<input type=\"submit\" name=\"s2\" value=\"Company test performance\">
<input type=\"submit\" name=\"s3\" value=\"Career Launcher test performance\">
<input type=\"submit\" name=\"s4\" value=\"Job Experience\">
<input type=\"submit\" name=\"s5\" value=\"Graduation Marks\">
<input type=\"submit\" name=\"s6\" value=\"Grade 12 Marks\">
<input type=\"submit\" name=\"s7\" value=\"Grade 10 Marks\">
</form>
<table width=\"50%\" border=\"0\">");
if($_SESSION[first]==0)
{
$sel="select umail,uname from user inner join apply on user.umail=apply.uid  where apply.cid=$_SESSION[cid] order by apply.apply_date";
$s=mysql_query($sel) or die(mysql_error());

$i=1;
while($l=mysql_fetch_array($s))
{
	echo("<tr><td width=\"100%\"><table width=\"100%\"><tr><td width=\"5%\">".$i."]</td><td width=\"50%\"> ".$l['uname']."</td><td><a href=\"seemore_application.php?userid=".$l['umail']."\"><b>see more...</b></a></td></tr></table></td></tr>");
	echo("<tr><td width=\"100%\"><table width=\"100%\"><tr><td><hr></hr></td></tr></table></td></tr>");
    ++$i;
}
echo("</table>");
$_SESSION['first']=1;
}

if(isset($_POST['s1']))
{
$sel="select umail,uname from user inner join apply on user.umail=apply.uid  where apply.cid=$_SESSION[cid] order by apply.apply_date";
$s=mysql_query($sel) or die(mysql_error());
	
echo("<table width=\"50%\" border=\"0\">");
$i=1;
while($l=mysql_fetch_array($s))
{
	echo("<tr><td width=\"100%\"><table width=\"100%\"><tr><td width=\"5%\">".$i."]</td><td width=\"50%\"> ".$l['uname']."</td><td><a href=\"seemore_application.php?userid=".$l['umail']."\"><b>see more...</b></a></td></tr></table></td></tr>");
	echo("<tr><td width=\"100%\"><table width=\"100%\"><tr><td><hr></hr></td></tr></table></td></tr>");
    ++$i;
}
echo("</table>");
}
else 
if(isset($_POST['s2']))
{
$sel="select user.umail,user.uname,performance.uid,performance.cid,apply.uid from user,performance,apply where user.umail=performance.uid and performance.uid=apply.uid and
 performance.cid='".$_SESSION[cid]."' order by marks desc; ";
$s=mysql_query($sel) or die(mysql_error());
	
echo("	<table width=\"50%\" border=\"0\">");
$i=1;
while($l=mysql_fetch_array($s))
{
	echo("<tr><td width=\"100%\"><table width=\"100%\"><tr><td width=\"5%\">".$i."]</td><td width=\"50%\"> ".$l['uname']."</td><td><a href=\"seemore_application.php?userid=".$l['umail']."\"><b>see more...</b></a></td></tr></table></td></tr>");
	echo("<tr><td width=\"100%\"><table width=\"100%\"><tr><td><hr></hr></td></tr></table></td></tr>");
    ++$i;
}
echo("</table>");
}
else 
if(isset($_POST['s3']))
{
$sel="select user.umail,user.uname,performance.uid,performance.cid,apply.uid from user,performance,apply where user.umail=performance.uid and performance.uid=apply.uid and
 performance.cid=1 order by marks desc; ";
	
$s=mysql_query($sel) or die(mysql_error());
	
echo("	<table width=\"50%\" border=\"0\">");
$i=1;
while($l=mysql_fetch_array($s))
{
	echo("<tr><td width=\"100%\"><table width=\"100%\"><tr><td width=\"5%\">".$i."]</td><td width=\"50%\"> ".$l['uname']."</td><td><a href=\"seemore_application.php?userid=".$l['umail']."\"><b>see more...</b></a></td></tr></table></td></tr>");
	echo("<tr><td width=\"100%\"><table width=\"100%\"><tr><td><hr></hr></td></tr></table></td></tr>");
    ++$i;
}
echo("</table>");
}
else 
if(isset($_POST['s4']))
{
$sel="select umail,uname from user inner join apply on user.umail=apply.uid  where apply.cid=$_SESSION[cid] order by user.experience desc";
$s=mysql_query($sel) or die(mysql_error());
	
echo("	<table width=\"50%\" border=\"0\">");
$i=1;
while($l=mysql_fetch_array($s))
{
	echo("<tr><td width=\"100%\"><table width=\"100%\"><tr><td width=\"5%\">".$i."]</td><td width=\"50%\"> ".$l['uname']."</td><td><a href=\"seemore_application.php?userid=".$l['umail']."\"><b>see more...</b></a></td></tr></table></td></tr>");
	echo("<tr><td width=\"100%\"><table width=\"100%\"><tr><td><hr></hr></td></tr></table></td></tr>");
    ++$i;
}
echo("</table>");
}
else 
if(isset($_POST['s5']))
{
$sel="select umail,uname from user inner join apply on user.umail=apply.uid  where apply.cid=$_SESSION[cid] order by user.engg desc";
$s=mysql_query($sel) or die(mysql_error());
	
echo("	<table width=\"50%\" border=\"0\">");
$i=1;
while($l=mysql_fetch_array($s))
{
	echo("<tr><td width=\"100%\"><table width=\"100%\"><tr><td width=\"5%\">".$i."]</td><td width=\"50%\"> ".$l['uname']."</td><td><a href=\"seemore_application.php?userid=".$l['umail']."\"><b>see more...</b></a></td></tr></table></td></tr>");
	echo("<tr><td width=\"100%\"><table width=\"100%\"><tr><td><hr></hr></td></tr></table></td></tr>");
    ++$i;
}
echo("</table>");
}
else 
if(isset($_POST['s6']))
{
$sel="select umail,uname from user inner join apply on user.umail=apply.uid  where apply.cid=$_SESSION[cid] order by user.grade12 desc";
$s=mysql_query($sel) or die(mysql_error());
	
echo("	<table width=\"50%\" border=\"0\">");
$i=1;
while($l=mysql_fetch_array($s))
{
	echo("<tr><td width=\"100%\"><table width=\"100%\"><tr><td width=\"5%\">".$i."]</td><td width=\"50%\"> ".$l['uname']."</td><td><a href=\"seemore_application.php?userid=".$l['umail']."\"><b>see more...</b></a></td></tr></table></td></tr>");
	echo("<tr><td width=\"100%\"><table width=\"100%\"><tr><td><hr></hr></td></tr></table></td></tr>");
    ++$i;
}
echo("</table>");
}
else 
if(isset($_POST['s7']))
{
$sel="select umail,uname from user inner join apply on user.umail=apply.uid  where apply.cid=$_SESSION[cid] order by user.grade10 desc";
$s=mysql_query($sel) or die(mysql_error());
	
echo("	<table width=\"50%\" border=\"0\">");
$i=1;
while($l=mysql_fetch_array($s))
{
	echo("<tr><td width=\"100%\"><table width=\"100%\"><tr><td width=\"5%\">".$i."]</td><td width=\"50%\"> ".$l['uname']."</td><td><a href=\"seemore_application.php?userid=".$l['umail']."\"><b>see more...</b></a></td></tr></table></td></tr>");
	echo("<tr><td width=\"100%\"><table width=\"100%\"><tr><td><hr></hr></td></tr></table></td></tr>");
    ++$i;
}
echo("</table>");
}
echo("</body><html>");
?>