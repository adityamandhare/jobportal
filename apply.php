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
$apply_field=stripslashes(trim($_POST['category']));
$apply_letter=addslashes(trim($_POST['letter']));

$del="delete from apply where cid='".$_SESSION[c]."' and uid='".$_SESSION[userlogin]."'";
mysql_query($del) or die(mysql_error());

$ins1="insert into apply(uid,cid,apply_date,apply_field,apply_letter)values('$_SESSION[userlogin]','$_SESSION[c]',CURDATE(),'$apply_field','$apply_letter')";
mysql_query($ins1) or die(mysql_error());
}
	if(! $con)
    die("couldn't connect to database");
    else
    mysql_select_db("hr",$con) or die("cannot select db");	
    
    echo("<html>
    <head><title>apply for job</title><link rel=\"stylesheet\" href=\"pattern.css\"></head>
    <body>
    <script type=\"text/javascript\">
    function notify()
    {
    alert(\"Your application has been sent.\");
    notify1();
    }
    function notify1()
    {
    alert(\"Note:If you have applied previously for this job your application wil be updated.\");
    }
    
    </script>
    <br>
    <a href=\"user.php\"><b>go back</b></a>
    <br><br>
    <form id=\"f1\" method=\"POST\" action=\"apply.php\">
    <font size=\"5\"><b>Fill The Application Form</b></font>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <input type=\"submit\" name=\"s1\" value=\"Send Application\" onclick=\"notify()\">
    <br><br><br>
    Select field in which you wish to apply:&nbsp&nbsp;
    <select name=\"category\">
<option value=\"Any job that suits my qualification\">Any job that suits my qualification</option>
<option value=\"Computer/IT/Software development\">Computer/IT/Software development</option>
<option value=\"Electronics/Electrical\">Electronics/Electrical</option>
<option value=\"Electronics/Telecommunication\">Electronics/Telecommunication</option>
<option value=\"Mechanical\">Mechanical</option>
<option value=\"Chemical\">Chemical</option>

</select>
    <br><br><br><br>
    Write application Letter(<i>100 words</i>):<br>
    &nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;
    &nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;
    &nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;
    &nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;
    &nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    &nbsp;
    <textarea name=\"letter\" rows=\"30\" cols=\"80\"></textarea>
    
    
    </form>
    </body>
    </html>");

?>