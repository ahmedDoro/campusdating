
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
$path = $row['userID'];
$image = $row['userID'];
$userID = $row['userID'];
$username = $row['userName'];
$imagename ="uploads/". $path ."/".$image.".jpeg";





$sql = "SELECT * FROM user_chat_messages where sender_ID='$userID' OR recipient_ID='$userID' ORDER BY message_time";
$qry =mysqli_query($con, $sql);


while($row=mysqli_fetch_array($qry)){

	$time = date("Y-m-d",strtotime($row['message_time']));
	$now = date("Y-m-d");
	if (($row['sender_ID'] == $username) && ($time == $now)) {
		$user = '<strong style="color:green;">'.$row['sender_ID'].'</strong>'.'-->'.$row['recipient_ID']; 
	}else{
		$user = '<strong style="color:blue;">'.$row['username'].'</strong>'; 			
	}	
	if ($time == $now) {
		$hourAndMinutes = date("h:i A", strtotime($row['message_time']));
	}else{
		$hourAndMinutes = date("Y-m-d", strtotime($row['message_time']));
	}			
	
	echo '<p>'.$user.' '. $row["message_content"]. '</p>';
	

     
}

?>