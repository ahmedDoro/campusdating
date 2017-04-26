<?php
session_start();
require_once '../class.user.php';
$user_home = new USER();

if(!$user_home->is_logged_in())
{
	$user_home->redirect('index.php');
}

$stmt = $user_home->runQuery("SELECT * FROM tbl_users WHERE userID=:uid");
$stmt->execute(array(":uid"=>$_SESSION['userSession']));
$row = $stmt->fetch(PDO::FETCH_ASSOC);

$picID = $row["userID"];
$path = $row['userID'];
//$image = $row['userID'];
$username = $row['userName'];
$image="";
$imagename ="../uploads/". $path ."/".$image.".jpeg";

?>

<?php

     require_once('dbconnect.php');

     db_connect();
     $pic="";
	 $pic='<img src="'.$imagename.'" width="50" height="50"/>';
      
     $sql = "SELECT *, date_format(chatdate,'%d-%m-%Y %r') as cdt from chat order by ID desc limit 200";
     $sql = "SELECT * FROM (" . $sql . ") as ch order by ID";
     $result = mysql_query($sql) or die('Query failed: ' . mysql_error());
     // Update Row Information
	 
     $msg="<li class='right clearfix'>
              
                     <div class='chat-body clearfix'>
                        <div class='header'>
	 <table border='0' style='font-size: 10pt; color: blue; font-family: verdana, arial;'>";
     while ($line = mysql_fetch_array($result, MYSQL_ASSOC))
     { 
			$image= $line["C_ID"];
			$imagename ="../uploads/". $image ."/".$image.".jpeg";
			$pic='<img src="'.$imagename.'" width="50" height="50"/>';
           $msg = $msg . "<tr><td>" .$pic. "&nbsp;</td>" .
                "<td>" . $line["USERNAME"] . ":&nbsp;</td>" .
                "<td>" . $line["MSG"] . "</td></tr>";
     }
     $msg=$msg . "</table> </div></div>
                             </li>";
     
     echo $msg;

?>





