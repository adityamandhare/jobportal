<?php 
session_start();
error_reporting(E_PARSE);
$con=mysql_connect("localhost","root","");
    if(! $con)
    die("couldn't connect to database");
    else
    mysql_select_db("hr",$con) or die("cannot select db");	
    
    if($_SESSION[first_time_allow]==0)
    {
    	$_SESSION['c']=$_GET['companyid'];
    	$_SESSION['first_time_allow']=1;
    }
    
if(isset($_POST['s1']))
{
	
	$sel="select testno,test_date from performance where cid='".$_SESSION[c]."' and uid='".$_SESSION[userlogin]."'";
	$s=mysql_query($sel) or die(mysql_error());
    $l=mysql_fetch_array($s);
    
    $testnum=$l['testno']+1;
    $sel123="select DATEDIFF(CURDATE(),'$l[test_date]') as nod";
    $s1=mysql_query($sel123) or die(mysql_error());
    $l1=mysql_fetch_array($s1);
    echo("number of days is ".$l[nod]);
    if($l1['nod']>30)
    {
    $up1="update performance set testno='".$testnum."',test_date=CURDATE() where '".$_SESSION[c]."' and uid='".$_SESSION[userlogin]."'";
    mysql_query($up1) or die (mysql_error());
	header('Location:testpaper.php');
    }
    else 
    if(mysql_num_rows($s)==0)
    {
    $ins1="insert into performance(uid,cid,test_date,marks,testno)values('$_SESSION[userlogin]','$_SESSION[c]',CURDATE(),'0','1')";
    mysql_query($ins1) or die(mysql_error());
    
    header('Location:testpaper.php');
    }
    else 
    echo("<b>Sorry!!You are not allowed to take the test.</b>");


}

if(isset($_POST['s2']))
header('Location:apply.php');

echo("<html>
<head><title>view company details</title></head>
<body>
<form id=\"f1\" method=\"POST\" action=\"seemore_company.php\">
");
$sel="select cname,cmail,caddress,ccontact,cdescription,category from company where cid='".$_GET[companyid]."'";
$s=mysql_query($sel) or die(mysql_error());
$l=mysql_fetch_array($s);
echo("
<font size=\"5\"><b>Company Details</b></font>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href=\"user.php\"><b>back</b></a>
<br><br>
<input type=\"submit\" name=\"s1\" value=\"Take company aptitude test\">&nbsp;&nbsp;&nbsp;
<input type=\"submit\" name=\"s2\" value=\"apply for job\">
<br><br><br>
<b>Company name:</b>$l[cname]<br><br>
<b>Company mail id:</b>$l[cmail]<br><br>
<b>Company address:</b>$l[caddress]<br><br>
<b>Company contact no:</b>$l[ccontact]<br><br>
<b>Field of job vacancy:</b>$l[category]<br><br>
<b>Company description:</b>$l[cdescription]<br><br>
</form>
</body>
</html>
");
?>