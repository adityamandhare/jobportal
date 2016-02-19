<?php 
session_start();
error_reporting(E_PARSE);
$con=mysql_connect("localhost","root","");
    if(! $con)
    die("couldn't connect to database");
    else
    mysql_select_db("hr",$con) or die("cannot select db");	
    
    if($_SESSION[flag1]==0)
    {
    	$_SESSION['u']=$_GET['userid'];
    	$_SESSION['flag1']=1;
    }
echo("<html><head><title>Applicant Details</title><link rel=\"stylesheet\" href=\"pattern.css\"></head><body>
<form id=\"f1\" method=\"POST\" action=\"seemore_application.php\">
<b>View:</b>&nbsp;&nbsp;&nbsp;
<input type=\"submit\" name=\"s4\" value=\"application details\">&nbsp;&nbsp;&nbsp;
<input type=\"submit\" name=\"s1\" value=\"curriculum vitae\">&nbsp;&nbsp;&nbsp;
<input type=\"submit\" name=\"s2\" value=\"academic performance\">&nbsp;&nbsp;&nbsp;
<input type=\"submit\" name=\"s3\" value=\"test performance\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<a href=\"call_letter.php?userid=".$_SESSION[u]."\"><font size=\"5\"><b>call for interview...</b></font></a>
</form>");

if(isset($_POST['s1']))
{
	$id=$_SESSION[u];
	$sel1="select * from user where umail='".$id."'";
	$s=mysql_query($sel1) or die(mysql_error());
	$l=mysql_fetch_array($s);
    
	echo("
	<br><b>Name:&nbsp;</b>$l[uname]
	<br><b>Gender:&nbsp;</b>$l[gender]
	<br><b>Mail id:&nbsp;</b>$l[umail]
	<br><b>Contact no:&nbsp;</b>$l[ucontact]
	<br><br>
	<table width=\"50%\" border=\"1\" cellpadding=\"0\" cellspacing=\"15\">
	<tr><td width=\"100%\">            
	<table width=\"100%\"><tr bgcolor=\"#C0C0C0\"><td width=\"100%\">Academic Background</td></tr></table>
	</td></tr>
	<tr><td width=\"100%\">
	<table width=\"100%\" border=\"1\">
	
	<tr>
	<td width=\"25%\" bgcolor=\"#FDEEF4\">Post Grad.</td>
	<td width=\"25%\" bgcolor=\"#FDEEF4\">$l[year_pgrad]</td>
	<td width=\"25%\" bgcolor=\"#FDEEF4\">$l[post_grad_college]</td>
	<td width=\"25%\" bgcolor=\"#FDEEF4\">$l[p_grad]</td>
	</tr>
	
	<tr>
	<td width=\"25%\" bgcolor=\"#FDEEF4\">Graduation</td>
	<td width=\"25%\" bgcolor=\"#FDEEF4\">$l[year_engg]</td>
	<td width=\"25%\" bgcolor=\"#FDEEF4\">$l[grad_college]</td>
	<td width=\"25%\" bgcolor=\"#FDEEF4\">$l[engg]</td>
	</tr>
	
	<tr>
	<td width=\"25%\" bgcolor=\"#FDEEF4\">Class 12</td>
	<td width=\"25%\" bgcolor=\"#FDEEF4\">$l[year_grade12]</td>
	<td width=\"25%\" bgcolor=\"#FDEEF4\">$l[jr_college]</td>
	<td width=\"25%\" bgcolor=\"#FDEEF4\">$l[grade12]</td>
	</tr>
	
	<tr>
	<td width=\"25%\" bgcolor=\"#FDEEF4\">Class 10</td>
	<td width=\"25%\" bgcolor=\"#FDEEF4\">$l[year_grade10]</td>
	<td width=\"25%\" bgcolor=\"#FDEEF4\">$l[school]</td>
	<td width=\"25%\" bgcolor=\"#FDEEF4\">$l[grade10]</td>
	</tr>
	
	
	</table>
	</td></tr>
	
	<tr><td width=\"100%\">
	<table width=\"100%\" border=\"1\">
	<tr><td width=\"100%\" bgcolor=\"#C0C0C0\">Certifications</td></tr>
	<tr><td width=\"100%\" bgcolor=\"#FDEEF4\">$l[certification]</td></tr>
	</table>
	</td></tr>
	
	<tr><td width=\"100%\">
	<table width=\"100%\" border=\"1\">
	<tr><td width=\"100%\" bgcolor=\"#C0C0C0\">Programming Languages Known</td></tr>
	<tr><td width=\"100%\" bgcolor=\"#FDEEF4\">$l[lang]</td></tr>
	</table>
	</td></tr>
	
	
	<tr><td width=\"100%\">
	<table width=\"100%\"  border=\"1\">
	<tr><td width=\"100%\" bgcolor=\"#C0C0C0\">Job Experience/Internship</td></tr>
	<tr><td width=\"100%\" bgcolor=\"#FDEEF4\">$l[exp_info]<br>$l[intern_info]</td></tr>
	</table>
	</td></tr>
	
	<tr><td width=\"100%\">
	<table width=\"100%\" border=\"1\">
	<tr><td width=\"100%\" bgcolor=\"#C0C0C0\">Extra curricular activities</td></tr>
	<tr><td width=\"100%\" bgcolor=\"#FDEEF4\">$l[extra]</td></tr>
	</table>
	</td></tr>
	</table>
");
}
else 
if(isset($_POST['s2']))
{
	$id=$_SESSION[u];
	$sel2="SELECT grade10, grade12, engg ,p_grad
FROM hr.user
WHERE umail ='".$id."'";
    $s=mysql_query($sel2)or die(mysql_error());
    $l=mysql_fetch_array($s);
    echo("<br><br><table width=\"80%\" border=\"1\">
    <th width=\"25%\">class 10</th><th width=\"25%\">class 12</th><th width=\"25%\">Engineering grades</th><th width=\"25%\">Post Graduation grades</th>
    <tr>
    <td><center>$l[grade10]</center></td>
    <td><center>$l[grade12]</center></td>
    <td><center>$l[engg]</center></td>
    <td><center>$l[p_grad]</center></td>
    </tr></table>");
}
else 
if(isset($_POST['s3']))
{
	$id=$_SESSION[u];
	$sel3="SELECT marks,testno FROM performance WHERE uid like'".$id."' AND cid='".$_SESSION[cid]."'";
    $s1=mysql_query($sel3)or die(mysql_error());
    $l1=mysql_fetch_array($s1);

    $sel4="SELECT marks,testno
FROM performance
WHERE performance.uid ='".$id."' AND performance.cid =1";
    $s2=mysql_query($sel4)or die(mysql_error());
    $l2=mysql_fetch_array($s2);
    echo("<br><br><table width=\"80%\" border=\"1\">
    <th width=\"30%\">company test</th><th width=\"20%\">Number of attempts of company test</th><th width=\"30%\">career launcher test</th><th width=\"20%\">Number of attempts of career launcher test</th>
    <tr>
    <td><center>$l1[marks]</center></td><td><center>$l1[testno]</center></td>
    <td><center>$l2[marks]</center></td><td><center>$l2[testno]</center></td>
    </tr></table>");
}
else 
if(isset($_POST['s4']))
{
	$sel="select apply_field,apply_letter from apply where cid='".$_SESSION[cid]."' and uid='".$_SESSION[u]."'";
	$s=mysql_query($sel) or die(mysql_error());
	$l=mysql_fetch_array($s);
	
	echo("<br><br>
	<b>Application field:</b>&nbsp;&nbsp;&nbsp;$l[apply_field]<br><br><br>");
	echo("<b>Application letter:</b><br>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<p>
	$l[apply_letter]</p>");

}
echo("</body></html>");
?>