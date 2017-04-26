<?php
session_start();
require_once 'class.user.php';
$user = new USER();

$stmt =$user->runQuery("SELECT * FROM tbl_users WHERE userID=:uid");
$stmt->execute(array(":uid"=>$_SESSION['userSession']));
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$path = $row['userID'];
$userID = $row['userID'];


include "search/db.php";
 $result=mysql_query("DELETE FROM chat WHERE C_ID='{$path}'");
 $result1=mysql_query("DELETE FROM user_chat_messages WHERE sender_ID='{$userID}'");

if(!$user->is_logged_in())
{
	$user->redirect('index.php');
}

if($user->is_logged_in()!="")
{
	$user->logout();	
	$user->redirect('index.php');
}

?>
