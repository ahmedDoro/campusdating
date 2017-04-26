<style>
p{
border-top: 1px solid #EEEEEE;
margin-top: 0px; margin-bottom: 5px; padding-top: 5px;
}
</style>
<?php
session_start();
require_once '../class.user.php';
include('connection.php');



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
$qry = $con->prepare($sql);
$qry->execute();
$fetch = $qry->fetchAll();
foreach ($fetch as $row):

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
	$image= $row['sender_ID'];
			$imagename ="../uploads/". $image ."/".$image.".jpeg";
			
	
	echo '<p>'.$user.':'.'<br/>'.' '.'<img src="'.$imagename.'" width="20" height="20">'.' '. $row['message_content']. '</p>';

endforeach; 

?>