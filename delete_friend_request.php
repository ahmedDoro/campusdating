  
  
  <?php

              session_start();
               include("connection.php"); // connect to the database
                include("function.php"); //get the id (member_id) for the login user

              ?>
  
  
  
  <?php
       

       $myfriend=$_GET['accept'];
       $me= $_SESSION["logged"];
       $query = mysql_query("delete from friendship WHERE receiver = '" . $_SESSION["logged"] . "' AND sender = '" . $_GET['accept'] . "' OR receiver = '" . $_GET['accept'] . "' AND sender = '" . $_SESSION["logged"] . "' ");
    
     
	 {
		echo "<script type=\"text/javascript\">
							alert(\"friend request deleted\");
							window.location='home.php';
						</script>";
			
		
	}
	
	
  ?>