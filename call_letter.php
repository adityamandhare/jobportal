<?php 
session_start();
error_reporting(E_PARSE);
$con=mysql_connect("localhost","root","");
    if(! $con)
    die("couldn't connect to database");
    else
    mysql_select_db("hr",$con) or die("cannot select db");	
    
    
    if(isset($_POST['s1']))
    {
    	$calldate=stripslashes(trim($_POST['dt']));
    	$p=stripslashes(trim($_POST['p']));
    	$m=stripslashes(trim($_POST['m']));    	
   
   $del="delete from hr.call where cid='".$_SESSION[cid]."' and uid='".$_SESSION[u]."'";
   mysql_query($del) or die(mysql_error());
   
   $ins="INSERT INTO `hr`.`call` (`cid`,`uid`,`calldate`,`position`,`callmessage`) VALUES ('$_SESSION[cid]', '$_SESSION[u]', '$calldate', '$p', '$m')";
   mysql_query($ins) or die(mysql_error());

   $del="delete from apply where uid='".$_SESSION[u]."'";
   mysql_query($del) or die(mysql_error());
   
    }
    echo("<html><head><title>Call Letter</title></head><body>
    <h3>Call Letter</h3>
    <form id=\"f1\" method=\"POST\" action=\"call_letter.php\">
  Date of interview/call:<input type=\"text\" name=\"dt\">&nbsp;&nbsp;(yyyy-mm-dd)
  <br><br><br>
  Post offered:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type=\"text\" name=\"p\">
  <br><br><br>
  Any message:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
 <textarea name=\"m\" rows=\"5\" cols=\"15\"></textarea><br><br><br>
 <input type=\"submit\" name=\"s1\" value=\"send call letter\">
  </form>  
  </body></html>");
$_SESSION['u']=$_GET['userid'];
?>