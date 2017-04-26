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



    $myfriend=$_GET['delete'];
    $me= $row['userID'];;
     $query = mysql_query("delete from myfriends WHERE myid = '" . $row['userID'] . "' AND myfriends = '" . $_GET['delete'] . "' OR myid = '" . $_GET['delete'] . "' AND myfriends = '" . $row['userID'] . "' ");
     {
		echo "<script type=\"text/javascript\">
							alert(\"friend has been deleted\");
							window.location='home.php';
						</script>";
			
		
		}
	
	
  ?>