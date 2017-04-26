<?php
 
 session_start();
require_once 'class.user.php';
$user_home = new USER();
if(!$user_home->is_logged_in())
{
	$user_home->redirect('index.php');
}
$stmt = $user_home->runQuery("SELECT * FROM tbl_users WHERE userID=:uid");
$stmt->execute(array(":uid"=>$_SESSION['userSession']));
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$path = $row['userID'];
$userID = $row['userID'];
$image = $row['userID'];
$username = $row['userName'];
$imagename ="uploads/". $path ."/".$image.".jpeg";



include "search/db.php";
 
 






          $receiver=$_GET['send'];
           $sender= $userID;


            $query = mysql_query("SELECT * FROM friendship WHERE receiver = '" . $userID . "' AND sender = '" . $_GET['send'] . "' OR receiver = '" . $_GET['send'] . "' AND sender = '" .$sender . "' ");

            if(mysql_num_rows($query) > 0){
   
             $row = mysql_fetch_array($query); 

             echo"
             <script type=\"text/javascript\">
							alert(\"Friend requesr already sent\");
							window.location='home.php';
						</script>

            ";

             }
	
           else{
   
             $query = mysql_query("SELECT * FROM myfriends WHERE `myid`='" . $userID . "' AND `myfriends`='" . $_GET['send'] . "' OR`myid`='" . $_GET['send'] . "' AND `myfriends`='" . $userID . "'");
             
			 if(mysql_num_rows($query) > 0){
    
	         $row = mysql_fetch_array($query);

	       echo"
               <script type=\"text/javascript\">
							alert(\"Is already your friend\");
							window.location='home.php';
						</script>

              ";

            }

             else
     
	         {


              mysql_query("INSERT INTO friendship(receiver,sender) VALUES('$receiver','$sender') ") or
              die(mysql_error());
            
			 {
		    
			           echo "<script type=\"text/javascript\">
							alert(\"friend request sent\");
							window.location='home.php';
						</script>";
			
		
               }
	          }
            }		
 
             ?>


   
    