<?php 
session_start();
error_reporting(E_PARSE);
$con=mysql_connect("localhost","root","");
    if(! $con)
    die("couldn't connect to database");
    else
    mysql_select_db("hr",$con) or die("cannot select db");	   
    
echo("<html><head><title>Result</title></head><body>
<center><h1>Result</h1>
<br><br>
<font color=\"#008000\"><b>Number of correct answers:&nbsp;</b></font><i>");
echo($_SESSION[correct]);
echo("</i>
<br>
<font color=\"#FF0000\"><b>Number of incorrect answers:&nbsp;</b></font><i>");
echo($_SESSION[wrong]);
echo("</i>
<br>
<font color=\"#800080\"><b>Number of questions left unattempted:&nbsp;</b></font><i>");
echo($_SESSION['uat']);
echo("</i><br><br>
<center><font color=\"#E9AB17\"><b>Your score is :&nbsp;</b></font><i>");
echo($_SESSION[score]);
echo("<br><br><center><font color=\"#E9AB17\"><b>Your percentage is:&nbsp;<b></font><i>");
echo("$_SESSION[percentage]</i>
<br><br><br>
");
if($_SESSION[updatescore]==0)
{
	echo("<b>Your score was not updated as you couldn't better your performance.<br>Hope you do better the next time</b>");
}
else 
{
	echo("<b>Your score was updated as you have improved your score.</b>");
}
echo("</center></body><html>");
?>