<?php 
session_start();
error_reporting(E_PARSE);
$con=mysql_connect("localhost","root","");
    if(! $con)
    die("couldn't connect to database");
    else
    mysql_select_db("hr",$con) or die("cannot select db");	
    
    //$_SESSION['userlogin']='def@yahoo.in';
   
   // $_SESSION['c']=0;
 if(isset($_POST['changes']))
{
	$umail=stripslashes(trim($_POST['umail']));
	$upassword=stripslashes(trim($_POST['upassword']));
	$uname=stripslashes(trim($_POST['uname']));
	$gender=stripslashes(trim($_POST['gender']));
	$ucontact=stripslashes(trim($_POST['ucontact']));
	$uaddress=stripslashes(trim($_POST['uaddress']));
	$school=stripslashes(trim($_POST['school']));
	$jr_college=stripslashes(trim($_POST['jr_college']));
	$post_grad_college=stripslashes(trim($_POST['post_grad_college']));
	$grad_college=stripslashes(trim($_POST['grad_college']));
	$grade10=stripslashes(trim($_POST['grade10']));
	$grade12=stripslashes(trim($_POST['grade12']));
	$engg=stripslashes(trim($_POST['engg']));
	$p_grad=stripslashes(trim($_POST['p_grad']));
	$year_grade10=stripslashes(trim($_POST['year_grade10']));
	$year_grade12=stripslashes(trim($_POST['year_grade12']));
	$year_engg=stripslashes(trim($_POST['year_engg']));
	$year_pgrad=stripslashes(trim($_POST['year_pgrad']));
	$intern_info=stripslashes(trim($_POST['intern_info']));
	$experience=stripslashes(trim($_POST['experience']));
	$exp_company=stripslashes(trim($_POST['exp_company']));
	$exp_info=stripslashes(trim($_POST['exp_info']));
	$lang=stripslashes(trim($_POST['lang']));
	$extra=stripslashes(trim($_POST['extra']));
	$certification=stripslashes(trim($_POST['certification']));
	
	$up1="update user set umail='".$umail."',upassword='".$upassword."',uname='".$uname."',gender='".$gender."',
	ucontact='".$ucontact."', 
	uaddress='".$uaddress."',school='".$school."',jr_college='".$jr_college."',grad_college='".$grad_college."',
	post_grad_college='".$post_grad_college."',grade10='".$grade10."',grade12='".$grade12."',engg='".$engg."',
	p_grad='".$p_grad."',year_grade10='".$year_grade10."',year_grade12='".$year_grade12."',
	year_engg='".$year_engg."',year_pgrad='".$year_pgrad."',
	intern_info='".$intern_info."',experience='".$experience."',exp_company='".$exp_company."',exp_info='".$exp_info."',lang='".$lang."',extra='".$extra."',certification='".$certification."'
	where umail='".$_SESSION[userlogin]."'";
	mysql_query($up1) or die(mysql_error());
}
echo("<html><head><title>User Logged In</title>
<link rel=\"stylesheet\" href=\"pattern.css\">
</head><body>
<script type=\"text/javascript\">
function notify()
{
alert(\"Your account has been updated\");
}

function inform()
{
alert(\"Get ready for you aptitude test.\");
}
</script>
<form id=\"f1\" method=\"POST\" action=\"user.php\">
<input type=\"submit\" name=\"s1\" value=\"Career Launcher Test\" onclick=\"inform()\">
<input type=\"submit\" name=\"s5\" value=\"Performance Report\">
<input type=\"submit\" name=\"s6\" value=\"Check Dates For Retests\">
<input type=\"submit\" name=\"s2\" value=\"List Companies\">
<input type=\"submit\" name=\"s3\" value=\"Check Calls\">
<input type=\"submit\" name=\"s4\" value=\"Account Settings\">
</form>");
if(isset($_POST['s1']))
{
    $sel="select testno,test_date from performance where cid=1 and uid='".$_SESSION[userlogin]."'";
	$s=mysql_query($sel) or die(mysql_error());
    $l=mysql_fetch_array($s);
    
    $testnum=$l['testno']+1;
    $sel123="select DATEDIFF(CURDATE(),'$l[test_date]') as nod from performance where cid=1 and uid='".$_SESSION[userlogin]."'";
    $s1=mysql_query($sel123) or die(mysql_error());
    $l1=mysql_fetch_array($s1);
    if($l1['nod']>30)
    {
    $up1="update performance set testno='".$testnum."',test_date=CURDATE() where cid=1 and uid='".$_SESSION[userlogin]."'";
    mysql_query($up1) or die (mysql_error());
    
	$_SESSION['c']=1;
	header('Location:testpaper.php');
    }
 else 
    if(mysql_num_rows($s)==0)
    {
    $temp=$_SESSION[c];	
    $ins1="insert into performance(uid,cid,test_date,marks,testno)values('$_SESSION[userlogin]','1',CURDATE(),'0','1')";
    mysql_query($ins1) or die(mysql_error());
    echo("company id is ".$_SESSION[c]);
    $_SESSION['c']=1;
    header('Location:testpaper.php');
    }
    else 
    echo("<b>Sorry!!You are not allowed to take the test.</b>");

}
else 
if(isset($_POST['s2']))
{
	$_SESSION['first_time_allow']=0;
echo("
<form id=\"f3\" method=\"POST\" action=\"user.php\">
<br><br>
<b>Select Job Category:</b>&nbsp;&nbsp;&nbsp;
<select name=\"category\">
<option value=\"all\">All Category</option>
<option value=\"it\">Computer/IT/Software</option>
<option value=\"elec\">Electronics/Electrical</option>
<option value=\"extc\">Electronics/Telecom</option>
<option value=\"mech\">Mechanical</option>
<option value=\"chem\">Chemical</option>
</select>&nbsp;&nbsp;&nbsp;<input type=\"submit\" name=\"cat\" value=\"list\">
</form>
");
}
else 
if(isset($_POST['s3']))
{
	echo("<br><h4>You have received calls from following companies:</h4>");
	$sel="select cid,cname from company where company.cid in(select cid from hr.call where uid='".$_SESSION[userlogin]."'order by calldate)";
	$s=mysql_query($sel) or die(mysql_error());
		
echo("	<table width=\"50%\" border=\"0\">");
$i=1;
while($l=mysql_fetch_array($s))
{
echo("<tr><td width=\"100%\"><table width=\"100%\"><tr><td width=\"5%\">".$i."]</td><td width=\"50%\"> ".$l['cname']."</td><td><a href=\"seemore_call.php?companyid=".$l[cid]."\"><b>see more...</b></a></td></tr></table></td></tr>");
echo("<tr><td width=\"100%\"><table width=\"100%\"><tr><td><hr></hr></td></tr></table></td></tr>");
++$i;
}
echo("</table>");
}
else 
if(isset($_POST['s4']))
{
	echo("<h2>Make changes to your account</h2>");
	$sel="select * from user where umail='".$_SESSION[userlogin]."'";
    $s=mysql_query($sel) or die(mysql_error());
    $l=mysql_fetch_array($s);
    echo("
    <form id=\"acc_changes\" method=\"POST\" action=\"user.php\" cellpadding=\"50\" cellspacing=\"50\">
    <table width=\"50%\" border=\"0\">
    <tr><td width=\"20%\">Mail id:</td><td><input type=\"text\" name=\"umail\" value=\"$l[umail]\"></td></tr>
    <tr><td>Password:</td><td><input type=\"password\" name=\"upassword\" value=\"$l[upassword]\"></td></tr>
    <tr><td>Name:</td><td><input type=\"text\" name=\"uname\" value=\"$l[uname]\"></td></tr>
    <tr><td>Gender:</td><td><input type=\"text\" name=\"gender\" value=\"$l[gender]\"></td></tr>
    <tr><td>Contact no:</td><td><input type=\"text\" name=\"ucontact\" value=\"$l[ucontact]\"></td></tr>
    <tr><td>Address:</td><td><input type=\"text\" name=\"uaddress\" value=\"$l[uaddress]\"></td></tr>
    <tr><td>School:</td><td><input type=\"text\" name=\"school\" value=\"$l[school]\"></td></tr>
    <tr><td>Junior College:</td><td><input type=\"text\" name=\"jr_college\" value=\"$l[jr_college]\"></td></tr>
    <tr><td>Grad College:</td><td><input type=\"text\" name=\"grad_college\" value=\"$l[grad_college]\"></td></tr>
    <tr><td>Post Grad College:</td><td><input type=\"text\" name=\"post_grad_college\" value=\"$l[post_grad_college]\"></td></tr>
    <tr><td>Class 10 marks:</td><td><input type=\"text\" name=\"grade10\" value=\"$l[grade10]\"></td></tr>
    <tr><td>Class 12 marks:</td><td><input type=\"text\" name=\"grade12\" value=\"$l[grade12]\"></td></tr>
    <tr><td>Grad marks:</td><td><input type=\"text\" name=\"engg\" value=\"$l[engg]\"></td></tr>
    <tr><td>Post Grad marks:</td><td><input type=\"text\" name=\"p_grad\" value=\"$l[p_grad]\"></td></tr>
    <tr><td>Class 10 year:</td><td><input type=\"text\" name=\"year_grade10\" value=\"$l[year_grade10]\"></td></tr>
    <tr><td>Class 12 year:</td><td><input type=\"text\" name=\"year_grade12\" value=\"$l[year_grade12]\"></td></tr>
    <tr><td>Grad year:</td><td><input type=\"text\" name=\"year_engg\" value=\"$l[year_engg]\"></td></tr>
    <tr><td>Post 10 year:</td><td><input type=\"text\" name=\"year_pgrad\" value=\"$l[year_pgrad]\"></td></tr>
    <tr><td>Internship info:</td><td><textarea name=\"intern_info\" rows=\"5\" cols=\"15\">$l[intern_info]</textarea></td></tr>
    <tr><td>Years of Experience:</td><td><input type=\"text\" name=\"experience\" value=\"$l[experience]\"></td></tr>
    <tr><td>Previous Company:</td><td><input type=\"text\" name=\"exp_company\" value=\"$l[exp_company]\"></td></tr>
    <tr><td>Experience info:</td><td><textarea name=\"exp_info\" rows=\"5\" cols=\"15\">$l[exp_info]</textarea></td></tr>
    <tr><td>Prog. Languages Known:</td><td><textarea name=\"lang\" rows=\"5\" cols=\"15\">$l[lang]</textarea></td></tr>
    <tr><td>Extra Curricular Activities:</td><td><textarea name=\"extra\" rows=\"5\" cols=\"15\">$l[extra]</textarea></td></tr>
    <tr><td>Certification:</td><td><textarea name=\"certification\"  rows=\"5\" cols=\"15\">$l[certification]</textarea></td></tr>
    </table>
    <br><br>
    <input type=\"submit\" name=\"changes\" value=\"Apply Changes\" onclick=\"notify()\">
    </form>
    ");
}
else 
if(isset($_POST['s5']))
{
	echo("<h2>View your performance</h2>
	<table width=\"80%\" border=\"1\" cellspacing=\"5\">
	<th bgcolor=\"#C0C0C0\">company name</th><th bgcolor=\"#C0C0C0\">percentage scored in company's test</th>
	<th bgcolor=\"#C0C0C0\">number of tests</th>
	");
	$sel="select cname,marks,testno from company,performance where performance.uid='".$_SESSION[userlogin]."' and performance.cid=company.cid";
	$s=mysql_query($sel) or die(mysql_error());
	while($l=mysql_fetch_array($s))
	echo("
	<tr bgcolor=\"#FDEEF4\"><td width=\"33%\"><center>$l[cname]</center></td><td width=\"33%\"><center>$l[marks]</center></td><td width=\"33%\"><center>$l[testno]</center></td></tr>
	");
	echo("
	</table>
	");
}
else 
if(isset($_POST['s6']))
{
$sel="select performance.cid,company.cname,DATE_ADD(test_date,INTERVAL 31 DAY) as rdate from performance,company where performance.cid=company.cid and performance.uid='".$_SESSION[userlogin]."'";	
$s=mysql_query($sel) or die(mysql_error());
echo("
<br><br>
<table width=\"80%\" border=\"1\">
<th bgcolor=\"#C0C0C0\">Company</th><th bgcolor=\"#C0C0C0\">Retest Date on/after</th>");
while($l=mysql_fetch_array($s))
{
$cdate=$l['test_date'];
$rdate=$l['rdate'];
echo("
<tr bgcolor=\"#FDEEF4\">
<td width=\"50%\"><center>$l[cname]</center></td>
<td width=\"50%\"><center>$rdate</center></td>");
}

}

if(isset($_POST['cat']))
 {
 	echo("<br><br><font size=\"3\"><b>List Of Companies</b></font>");	
 	$category=stripslashes($_POST[category]);
 
 if($category=='all')
 {
 $sel="select cid,cname from company where cid not in(1)";
 $s=mysql_query($sel) or die(mysql_error()) ;

echo("<br><br><table width=\"50%\" border=\"0\" >");
$i=1;
while($l=mysql_fetch_array($s))
{
echo("<tr><td width=\"100%\"><table width=\"100%\"><tr><td width=\"5%\">".$i."]</td><td width=\"50%\"> ".$l['cname']."</td><td><a href=\"seemore_company.php?companyid=".$l[cid]."\"><b>see more...</b></a></td></tr></table></td></tr>");
echo("<tr><td width=\"100%\"><table width=\"100%\"><tr><td><hr></hr></td></tr></table></td></tr>");
++$i;
}
echo("</table>");
 		
}
 	else 
 	{
 	$sel="select cid,cname from company where category='".$category."' or category='general' and cid not in(1) ";
 	$s=mysql_query($sel) or die(mysql_error());
echo("<br><br>	<table width=\"50%\" border=\"0\">");
$i=1;
while($l=mysql_fetch_array($s))
{
echo("<tr><td width=\"100%\"><table width=\"100%\"><tr><td width=\"5%\">".$i."]</td><td width=\"50%\"> ".$l['cname']."</td><td><a href=\"seemore_company.php?companyid=".$l[cid]."\"><b>see more...</b></a></td></tr></table></td></tr>");
echo("<tr><td width=\"100%\"><table width=\"100%\"><tr><td><hr></hr></td></tr></table></td></tr>");
++$i;
}
echo("</table>");
 	}
 	
}


echo("</body></html>");
?>