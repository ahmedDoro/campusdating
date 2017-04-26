<?php
	
session_start();
require_once '../class.user.php';
require_once 'connection.php';

$recipient_ID=$_GET['id'];


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

?>
<html lang="EN">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
		<link href="chatroomDesign.css" type="text/css" rel="stylesheet">
		<title>Chat</title>
		<style>
			body {
				font-family:"Tahoma",Arial Narrow;
				font-size: 12px;
			}
			.holder {
				padding:3px;
				margin-left:auto;
				margin-right:auto;
				margin-top:10%;
				display:table;
				border:solid 1px #cccccc;
				border-width: thin;
			}
			.style {
				bottom:0px;
				border:1px solid #666;
				background-color:#FFF;
				border-radius:3px;
				-webkit-border-radius:3px;
				-moz-border-radius:3px;
				box-shadow:0 0 5px #000;			
				-moz-box-shadow:0 0 5px #000;			
				-webkit-box-shadow:0 0 5px #000;			
			}
			.alpha {
				float:right;
				width:300px;
				padding:2px;
				border:1px solid #666;
				background-color:#FFF;
				border-radius: 3px;
				}
			.refresh {
				border: 1px solid #3366FF;
				border-left: 4px solid #3366FF;
				color: green;
				font-family: tahoma;
				font-size: 12px;
				height: 225px;
				overflow: auto;
				width: 270px;
				padding:10px;
				background-color:#FFFFFF;
			}	
			#post_button{
				border: 1px solid #3366FF;
				background-color:#3366FF;
				width: 50px;
				color:#FFFFFF;
				font-weight: bold;
				margin-left: -04px; padding-top: 4px; padding-bottom: 4px;
				cursor:pointer;
			}
			#textb{
				border: 1px solid #3366FF;
				border-left: 4px solid #3366FF;
				padding-top: 5px;
				padding-bottom: 5px;
				padding-left: 5px;
				width: 220px;
			}
			#texta{
				border: 1px solid #3366FF;
				border-left: 4px solid #3366FF;
				width: 210px;
				margin-bottom: 10px;
				padding:5px;
			}
			#johnlei{
				margin-left:3px;
				color: #ffffff;
				text-shadow: 0 -1px 0 rgba(0, 0, 0, 0.25);
				background-color: #49afcd;
				*background-color: #2f96b4;
				background-image: -moz-linear-gradient(top, #5bc0de, #2f96b4);
				background-image: -webkit-gradient(linear, 0 0, 0 100%, from(#5bc0de), to(#2f96b4));
				background-image: -webkit-linear-gradient(top, #5bc0de, #2f96b4);
				background-image: -o-linear-gradient(top, #5bc0de, #2f96b4);
				background-image: linear-gradient(to bottom, #5bc0de, #2f96b4);
				background-repeat: repeat-x;
				border-color: #2f96b4 #2f96b4 #1f6377;
				border-color: rgba(0, 0, 0, 0.1) rgba(0, 0, 0, 0.1) rgba(0, 0, 0, 0.25);
				filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#ff5bc0de', endColorstr='#ff2f96b4', GradientType=0);
				filter: progid:DXImageTransform.Microsoft.gradient(enabled=false);
				float:right;
				cursor:pointer;	
				height: 53px;
				width:70px;
			}
			#johnlei:hover,
			#johnlei:active,
			#johnlei.active,
			#johnlei.disabled,
			#johnlei[disabled] {
				color: #ffffff;
				background-color: #51a351;
				*background-color: #499249;
			}
			#johnlei:active,
			#johnlei.active {
				background-color: #408140;
			}
			#johnlei:hover{
				background-color: #2f96b4;
			}
		</style>
		<script src="js/jquery.js"></script>
	</head>
	<body>
		<?php
$t=time();
($t . "<br>");
(date("Y-m-d",$t));

									$sql = "SELECT * FROM tbl_users where userID='$recipient_ID' ORDER BY userID";
									$qry = $con->prepare($sql);
									$qry->execute();
									$fetch = $qry->fetchAll();
									foreach ($fetch as $fe):
										$name = $fe['userID'];
								

?> 
<body>
    <div class="container-fluid header">
        <nav class="navbar">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand">
                    <fieldset>
                        <p class="logo">C</p><p>ampus</p><p class="logo">D</p><p>ate</p>
                    </fieldset>
                </a>
            </div>
        </nav><br /><br />
    </div>
    <div class="container main">
        <div class="row">
            <div class="col-md-12">
                <div class="container">
                    <div class="container bootstrap snippet">
                        <div class="row">
						------------
	<div class="holder">
		<label="welcomemsg">Chating with:<a href="../r_profile.php?id=<?php echo $recipient_ID; ?> "/>  </label><label for="name"><strong><?php echo $fe['userName'];?></strong></a></label>
			<div class="style">	
				<div class="alpha">
					<b align="center">Live chat</b>
					<input name="user" type="hidden" id="texta" value="<?php echo $username ?>"/>
					<div class="refresh">
					</div>
					<br/>
					<form name="newMessage" class="newMessage" action="" onsubmit="return false">
						
						
								
									
									<input type="hidden" name="recipient" id="recipient" value="<?php echo $name; ?>" style="width:270px;">
								<?php endforeach; ?>
						</select>
					<textarea name="textb" id="textb">Enter your message here</textarea>
					<input name="submit" type="submit" value="Send" id="johnlei" />
				</form>
			</div>
		</div>
		<script src="js/sendchat.js" type="text/javascript"></script>
		<script src="js/refresh.js" type="text/javascript"></script>
	</div>	
	</body>
</html>