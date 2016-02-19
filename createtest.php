<?php
session_start();
error_reporting(E_PARSE);
$con=mysql_connect("localhost","root","");
    if(! $con)
    die("couldn't connect to database");
    else
    mysql_select_db("hr",$con) or die("cannot select db");	

$sel="select testcreated from company where cid='".$_SESSION[cid]."'";
$val=mysql_query($sel) or die(mysql_error());        
$valu=mysql_fetch_array($val);
$value=$valu['testcreated'];

/*if(isset($_POST['s4']) || $value=='n')
$_SESSION['check1']=1;
else 
if(isset($_POST['s5']))
header('Location:company.php');
  */  
if(isset($_POST['s1']))
{
	
	$q=stripslashes(trim($_POST['question']));
	$opt1=stripslashes(trim($_POST['opt1']));
	$opt2=stripslashes(trim($_POST['opt2']));
	$opt3=stripslashes(trim($_POST['opt3']));
	$opt4=stripslashes(trim($_POST['opt4']));
	$ans=stripslashes(trim($_POST['ans']));
	$plus=stripslashes(trim($_POST['plus']));
	$minus=stripslashes(trim($_POST['minus']));
	$section=stripslashes(trim($_POST['section']));
	
	$ins="insert into test(question,opt1,opt2,opt3,opt4,ans,plus,minus,section,company)values('$q','$opt1','$opt2','$opt3','$opt4','$ans','$plus','$minus','$section','$_SESSION[cid]')";
	mysql_query($ins) or die(mysql_error());

	if($value=='n')
	{
	$u="update company set testcreated='y' where cid='".$_SESSION[cid]."'";
	mysql_query($u) or die(mysql_error());
	}
}
echo("<html><head><title>create new test</title></head><body>
<script type=\"text/javascript\">
function notify()
{
alert(\"Your question has been added\");
}
</script>");
/*if($_SESSION[check1]==0 && $value=='y')
{
echo("
<form id=\"confirmation_form\" method=\"POST\" action=\"createtest.php\">
Do you realy wan't to delete the previous test paper? All your previous questions will be lost.
<br><br>
<input type=\"submit\" name=\"s4\" value=\"yes\">
&nbsp;&nbsp;&nbsp;
<input type=\"submit\" name=\"s5\" value=\"no\">
</form>
");
}*/
//echo("Hello");
/*if($_SESSION[check1]==1)
{
if($_SESSION[del_question]==0 && $value=='y')
{
$del="delete from test where company='".$_SESSION[cid]."'";
mysql_query($del) or die(mysql_error());	
$_SESSION['del_question']=1;	
}*/
echo("
<h3>Add Questions To Your New Test Paper</h3><form id=\"f1\" method=\"POST\" action=\"createtest.php\"> "); 
echo("Enter the question:&nbsp;&nbsp;&nbsp;<textarea rows=\"5\" cols=\"20\" name=\"question\" value=\"\"></textarea><br><br>
Enter option 1:<input type=\"text\" name=\"opt1\"><br><br>
Enter option 2:<input type=\"text\" name=\"opt2\"><br><br>
Enter option 3:<input type=\"text\" name=\"opt3\"><br><br>
Enter option 4:<input type=\"text\" name=\"opt4\"><br><br>
<br>
Enter the correct option number(1,2,3,4) :<input type=\"text\" name=\"ans\"><br><br>
Enter +ve marks:<input type=\"text\" name=\"plus\"><br><br>
Enter -ve marks:<input type=\"text\" name=\"minus\"><br><br>
Enter the section:<input type=\"text\" name=\"section\"><br><br>
<center><input type=\"submit\" name=\"s1\" value=\"ADD QUESTION\" onclick=\"notify()\"></center>
</form></body></html>
");
//}
?>