<?php
	
session_start();
require_once '../class.user.php';



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
$uname = $row['userName'];
$imagename ="uploads/". $path ."/".$image.".jpeg";

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link href="../css/homePageDesign.css" type="text/css" rel="stylesheet">
    <title>Home Page</title>
	<script src="js/jquery.js"></script>
	<script src="../js/bootstrap.min.js"></script>
	
</head>
<body>
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
		<li><p>User:<?php echo $uname; ?></p></li> <!--this should show logged in user's username-->
            <li><p>Status: Online</p></li><!--This should show login status-->
            <li class="right"><a href="../logout.php">Log out</a></li>
            <div class="col-md-12">
                <div class="container">
                    <div class="container bootstrap snippet">
                        <div class="row">
		<?php
$t=time();
($t . "<br>");
(date("Y-m-d",$t));

									$sql = "SELECT * FROM tbl_users where userID='$recipient_ID' ORDER BY userID LIMIT 1";
									$qry = mysqli_query($con, $sql);
									
									while($row=mysqli_fetch_array($qry)){
										$name = $row['userID'];
								
									
?> 
	<div class="col-md-12 bg-white ">
               <div class="chat-message">
                   <ul class="chat">
		<label="welcomemsg">Chating with:<a href="../r_profile.php?id=<?php echo $recipient_ID; ?> "/>  </label><label for="name"><strong><?php echo $row["userName"];?></strong></a></label>
			<div class="chat-box bg-white">	
				<div class="alpha">
					<b align="center">Live chat</b>
					<input name="user" type="hidden" id="texta" value="<?php echo $username ?>"/>
					<div class="refresh">
					</div>
					<br/>
					<form name="newMessage" class="newMessage" action="send_save_chat.php" onsubmit="return false">
						
						
								
									
									<input type="hidden" name="recipient" id="recipient" value="<?php echo $name; ?>" style="width:270px;">
								<?php } ?>
						</select>
					<textarea name="textb" id="textb">Enter your message here</textarea>
					<input name="submit" type="submit" value="Send"  />
				</form>
			</div>
		</div>
		</div>
		</div>
		
	
    </div>
      </div><footer>
        <div class="row footer-row">
            <div class="footer-col1 col-sm-4">
                <h3>About us</h3>
                <p><a class="footer-a" href="#">About the authors</a></p>
                <p><a class="footer-a" href="#">About the webpage</a></p>
                <p><a class="footer-a" href="#">Our vision</a></p>
                <p><a class="footer-a" href="#">Testimonials</a></p>
                <p><a class="footer-a" href="#">Contact us</a></p>
            </div>
            <div class="footer-col2 col-sm-4">
                <h3>Terms and conditions</h3>
                <p><a class="footer-a" href="#">Terms of use</a></p>
                <p><a class="footer-a" href="#">About cookies and cookie policy</a></p>
                <p><a class="footer-a" href="#">Data protection</a></p>
                <p><a class="footer-a" href="#">Privacy policy</a></p>
                <p><a class="footer-a" href="#">Copy rights</a></p>
            </div>
            <div class="footer-col3 col-sm-4">
                <h3>Something else</h3>
            </div>
        </div>
    </footer>

	<script src="js/sendchat.js" type="text/javascript"></script>
	<script src="js/refresh.js" type="text/javascript"></script>
</body>
</html>