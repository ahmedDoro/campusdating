<?php
session_start();
require_once 'class.user.php';
include('search/db.php');
$user_home = new USER();
if(!$user_home->is_logged_in())
{
	$user_home->redirect('index.php');
}
$stmt = $user_home->runQuery("SELECT * FROM tbl_users WHERE userID=:uid");
$stmt->execute(array(":uid"=>$_SESSION['userSession']));
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$userID = $row['userID'];
$image = $row['userID'];
$username = $row['userName'];



			
        $myfriend=$_GET['accept'];
        
		$me= $row['userID'];
        
		$mfriends=mysql_query("INSERT INTO myfriends(myid,myfriends) VALUES('$me','$myfriend') ")or die(mysql_error());
     
	    $query = mysql_query("delete from friendship WHERE receiver = '" . $row['userID'] . "' AND sender = '" . $_GET['accept'] . "' OR receiver = '" . $_GET['accept'] . "' AND sender = '" . $row['userID'] . "' ");
     
	  {
		
		echo "<script type=\"text/javascript\">
							alert(\"friend added\");
							window.location='home.php';
						</script>";
			
		
      }
	
	
  ?>