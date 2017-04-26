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
$sender_ID = $row['userID'];

$time=time();


echo $message = $_POST['message'];
echo $recipient_ID = $_POST['recipient'];
$username = $_POST['username'];

$sql = "INSERT INTO user_chat_messages (sender_ID, message_content, message_time, recipient_ID, username)
	VALUES (:a,:b,:c,:d,:e)";
$qry = $con->prepare($sql);
$qry->execute(array(':a'=>$sender_ID,':b'=>$message,':c'=>$time,':d'=>$recipient_ID,':e'=>$username));

?>