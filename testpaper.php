<?php 
session_start();
error_reporting(E_PARSE);
    $con=mysql_connect("localhost","root","");
    if(! $con)
    die("couldn't connect to database");
    mysql_select_db("hr",$con) or die("cannot select db");	
    $ans=array();
    
echo("The company id is ".$_SESSION[c]);

if(isset($_POST['s1']))
{	
$s1="select ans,plus,minus from test where company='".$_SESSION[c]."'";
$q1=mysql_query($s1) or die(mysql_error());
$score=0;	
$n=$_SESSION[num];
$a=array();
for($i=1;$i<=$n;++$i)
{
	$a[$i]=stripslashes(trim($_POST[$i]));
}
/*
for($i=1;$i<=$n;++$i)
{
	echo("  ".$a[$i]);
}
*/
$i=1;
$c=0;
$ic=0;
$uat=0;
$per=0;
while($l1=mysql_fetch_array($q1))
{
	if($a[$i]!="" && $a[$i]!=" ")
	{
	$temp=$l1['ans'];
	if($a[$i]==$temp)
	{
	$score+=$l1['plus'];
	$c++;
	}
	else 
	{
	$score-=$l1['minus'];
	$ic++;
	}
	}
	else 
	++$uat;
	++$i;
}
$per=(($score/$_SESSION[obtainable])*100);
$_SESSION['correct']=$c;
$_SESSION['wrong']=$ic;
$_SESSION['score']=$score;
$_SESSION['uat']=$uat;
$_SESSION['percentage']=$per;
$sele="select marks,testno from performance where uid='".$_SESSION[userlogin]."' and cid='".$_SESSION[c]."'";
$s=mysql_query($sele) or die(mysql_error());

$l=mysql_fetch_array($s);

echo("previous performance:".$l[marks]." current performance:".$score);
if($_SESSION[percentage]>$l['marks'])
{
	$up1="update performance set marks='".$_SESSION[percentage]."' where uid='".$_SESSION[userlogin]."' and cid='".$_SESSION[c]."'";
	mysql_query($up1) or die(mysql_error());
	$_SESSION['updatescore']=1;
}
else 
	$_SESSION['updatescore']=0;

header('Location:result.php');
}
echo("<html>");
echo("<head><title>Test Paper</title></head>");
echo("<body>
<script type=\"text/javascript\">
function con()
{
confirm(\"Submit test paper?\");
}
</script>
<center>
<h1>MCQ Test Paper</h1>
</center>
<br><br>
<b><i>Instructions:
<br>
<ol>
<li>The test awards +1 marks for a correct answer and -1 for a wrong answer.</li>
<li>Attempt a question only if you are sure about it.</li>
<li>Once marked,a question cannot be unmarked.</li>
<li>You can only change your answer.</li>
<li>Try to score Maximum Marks.</li>
</ol>
</b></i>
<br><center><b>Best of Luck!!</b></center><br><br>
<form id=\"f1\" action=\"testpaper.php\" method=\"POST\">");
$s="select * from test where company='".$_SESSION[c]."'";
$r=mysql_query($s) or die(mysql_error());
$i=1;
$total=0;
while($l=mysql_fetch_array($r))
{	
$qno=$l['qno'];	
$q=$l['question'];
$opt1=$l['opt1'];
$opt2=$l['opt2'];
$opt3=$l['opt3'];
$opt4=$l['opt4'];
echo($i."] ".$q."<br>");
echo("<table width=\"40%\" border=\"0\"><tr><td width=\"50%\"><input type=\"radio\" name=\"$i\" value=\"1\">".$opt1."</td>");
echo("<td><input type=\"radio\" name=\"$i\" value=\"2\"> ".$opt2."</td></tr>");
echo("<tr><td width=\"50%\"><input type=\"radio\" name=\"$i\" value=\"3\"> ".$opt3."</td>");
echo("<td><input type=\"radio\" name=\"$i\" value=\"4\"> ".$opt4."</td></tr></table>");
echo("<br><br>");
++$i;
$total+=$l['plus'];
}
$n=$i-1;
$_SESSION['num']=$n;
$_SESSION['obtainable']=$total;	
echo("<center><input type=\"submit\" name=\"s1\" value=\"submit\"></center>
</form>
</body>");
echo("</html>");
?>