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

echo("<html><head><title>modify test</title></head>
<body>
<script type=\"text/javascript\">
function notify1()
{
alert(\"You question has been modified\");
}
function notify2()
{
alert(\"You question has been added\");
}
function notify4()
{
alert(\"You question has been deleted\");
}
</script>
");
if($value=='n')
{
	echo("You first need to create a test!&nbsp;<a href=\"createtest.php\">create test</a>");
}
else {
echo("<h1>Modify Your Test</h1>");
echo(" 
<form id=\"choice\" method=\"POST\" action=\"altertest.php\">
<input type=\"submit\" name=\"add\" value=\"Add Question\">
<input type=\"submit\" name=\"alter\" value=\"Alter Question\">
<input type=\"submit\" name=\"del\" value=\"Delete Question\">
<input type=\"submit\" name=\"view\" value=\"View Question\">
</form>");

if(isset($_POST['s1']))
{
    $qno=stripslashes(trim($_POST['num']));
	$q=stripslashes(trim($_POST['question']));
	$opt1=stripslashes(trim($_POST['opt1']));
	$opt2=stripslashes(trim($_POST['opt2']));
	$opt3=stripslashes(trim($_POST['opt3']));
	$opt4=stripslashes(trim($_POST['opt4']));
	$ans=stripslashes(trim($_POST['ans']));
	$plus=stripslashes(trim($_POST['plus']));
	$minus=stripslashes(trim($_POST['minus']));
	$section=stripslashes(trim($_POST['section']));
	
$up="update test set question='".$q."',opt1='".$opt1."',opt2='".$opt2."',opt3='".$opt3."',opt4='".$opt4."',ans='".$ans."',plus='".$plus."',minus='".$minus."',section='".$section."'where qno=$qno and company='".$_SESSION[cid]."'";		
mysql_query($up) or die(mysql_error());
}

if(isset($_POST['s3']))
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
	
}

if(isset($_POST['s4']))
{
$qno=stripslashes(trim($_POST['qno']));
$del="delete from test where qno=$qno and company='".$_SESSION[cid]."'";
mysql_query($del) or die(mysql_error());;
}

if(isset($_POST['alter']))
{
echo("
<h4>Alter Your Question</h4>
<form id=\"f1\" method=\"POST\" action=\"altertest.php\">
Enter Question code:<input type=\"text\" name=\"num\"><br><br>
Enter the question:&nbsp;&nbsp;&nbsp;<textarea rows=\"5\" cols=\"20\" name=\"question\" value=\"\"></textarea><br><br>
Enter option 1:<input type=\"text\" name=\"opt1\"><br><br>
Enter option 2:<input type=\"text\" name=\"opt2\"><br><br>
Enter option 3:<input type=\"text\" name=\"opt3\"><br><br>
Enter option 4:<input type=\"text\" name=\"opt4\"><br><br>
Enter the correct option number(1,2,3,4) :<input type=\"text\" name=\"ans\"><br><br>
Enter +ve marks:<input type=\"text\" name=\"plus\"><br><br>
Enter -ve marks:<input type=\"text\" name=\"minus\"><br><br>
Enter the section:<input type=\"text\" name=\"section\"><br><br>
<center><input type=\"submit\" name=\"s1\" value=\"Apply Changes\" onclick=\"notify1()\"></center>
</form>
<br><br><br>");
}
if(isset($_POST['view']))
{
$s="select qno,question,opt1,opt2,opt3,opt4,ans,plus,minus,section from test where company=$_SESSION[cid]";
$r=mysql_query($s) or die(mysql_error());
echo("<table width=\"40%\" border=\"1\">
<th>Question Code</th><th>Question</th><th>Option1</th><th>Option2</th><th>Option3</th><th>Option4</th><th>Answer</th><th>Plus</th>
<th>Minus</th><th>Section</th>");
while($l=mysql_fetch_array($r))
{	
$qno=$l['qno'];	
$q=$l['question'];
$opt1=$l['opt1'];
$opt2=$l['opt2'];
$opt3=$l['opt3'];
$opt4=$l['opt4'];
$ans=$l['ans'];
$plus=$l['plus'];
$minus=$l['minus'];
$section=$l['section'];
echo("<tr>
<td>$qno</td>
<td>$q</td>
<td>$opt1</td>
<td>$opt2</td>
<td>$opt3</td>
<td>$opt4</td>
<td>$ans</td>
<td>$plus</td>
<td>$minus</td>
<td>$section</td>
</tr>
");
}
echo("</table>");
}

if(isset($_POST['add']))
{
echo("
<h4>Add Question</h4>
<form id=\"f1\" method=\"POST\" action=\"altertest.php\"> "); 
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
<center><input type=\"submit\" name=\"s3\" value=\"ADD QUESTION\" onclick=\"notify2()\"></center>
</form>");

}

if(isset($_POST['del']))
{
echo("
<h4>Delete Question</h4>
<form id=\"f4\" method=\"POST\" action=\"altertest.php\">
Enter the 'Question Code' of question to be deleted:&nbsp;&nbsp;
<input type=\"text\" name=\"qno\"><br><br>
<input type=\"submit\" name=\"s4\" value=\"delete question\" onclick=\"notify4()\">
</form>");	
}

echo("</body></html>");
}
?>