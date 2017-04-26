<?php
session_start();
require_once 'class.user.php';
$user_login = new USER();

if($user_login->is_logged_in()!="")
{
	$user_login->redirect('home.php');
}

if(isset($_POST['btn-login']))
{
	$email = trim($_POST['txtemail']);
	$upass = trim($_POST['txtupass']);
	
	if($user_login->login($email,$upass))
	{
		$user_login->redirect('home.php');
	}
}



if(isset($_POST['btn-signup']))
{
	
$reg_user = new USER();
	
	$uname = trim($_POST['txtuname']);
	$email = trim($_POST['txtemail']);
	$upass = trim($_POST['txtpass']);
	$code = md5(uniqid(rand()));
	
	$stmt = $reg_user->runQuery("SELECT * FROM tbl_users WHERE userEmail=:email_id");
	$stmt->execute(array(":email_id"=>$email));
	$row = $stmt->fetch(PDO::FETCH_ASSOC);
	
	if($stmt->rowCount() > 0)
	{
		$msg = "
		      <div class='alert alert-error'>
				<button class='close' data-dismiss='alert'>&times;</button>
					<strong>Sorry !</strong>  email allready exists , Please Try another one
			  </div>
			  ";
	}
	else
	{
		if($reg_user->register($uname,$email,$upass,$code))
		{			
			$id = $reg_user->lasdID();		
			$key = base64_encode($id);
			$id = $key;
			
			$message = "					
						Hello $uname,
						<br /><br />
						Welcome to campusDate!<br/>
						To complete your registration  please , just click following link<br/>
						<br /><br />
						<a href='http://rgucampusdating.azurewebsites.net/verify.php?id=$id&code=$code'>Click HERE to Activate :)</a>
						<br /><br />
						Cheers,";
						
			$subject = "Confirm Registration";
						
			$reg_user->send_mail($email,$message,$subject);	
			$msg = "
					<div class='alert alert-success'>
						<button class='close' data-dismiss='alert'>&times;</button>
						<strong>Success!</strong>  We've sent an email to $email.
                    Please click on the confirmation link in the email to create your account. 
			  		</div>
					";
		}
		else
		{
			echo "sorry , Query could no execute...";
		}		
	}
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link href="css/indexDesign.css" type="text/css" rel="stylesheet">
    <title>RGU campusDating</title>
	<script src="js/vendor/modernizr-2.6.2-respond-1.1.0.min.js"></script>
</head>


<body>
<div class="container-fluid">
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
        <div class="collapse navbar-collapse" id="myNavbar">
                <form action="" method="post" class="navbar-form navbar-right">
                    <div class="form-group">
                        <input class="form-control" type="text" name="txtemail" placeholder="Username">
                        <input class="form-control" type="password" name="txtupass" placeholder="Password">
                        <button type="submit" name="btn-login" class="btn btn-default">Login</button><br />
                        <a class="resetpwd"  href="fpass.php">Reset Password</a>
						
                    </div>
                </form>
				
        </div>
		<?php
        if(isset($_GET['error']))
		{
			 echo 'Wrong Details!'; 
			
		}
		if(isset($_GET['inactive']))
		{
			
   

			echo'Sorry! This Account is not Activated Go to your Inbox and Activate it.';  
			
           
		}
		?>
    </nav><br /><br />
</div>
<div class="container">
    <div class="row">
        <div class="col col-left col-sm-8 col-md-8 col-lg-6">
            <img class="img-responsive" src="img/studentpic.jpg" alt="CampusStudents">
        </div>
        <div class="col col-right col-sm-4 col-md-4 col-lg-6">
            <blockquote>"Single students - <br /> Campus Date helps you to find your perfect match"</blockquote>
            <div class="signup">
                <form action="" method="post">
				<?php if(isset($msg)) echo $msg;  ?>
                    <div class="form-group">
					
                        <p>New to Campus Dating? Find your MATCH NOW!!!!</p>
                        <input class="form-control" type="text" name="txtuname" placeholder="Username"><br />
                        <input class="form-control" type="email" name="txtemail" placeholder="Email"><br />
						<input class="form-control" type="password" name="txtpass" placeholder="Password"><br />
                        <button class="btn btn-default" value="sugnup" name="btn-signup">Sign up!</button>
                    </div><br />
                    <div id="tandc">
                        <p>I accept the <a href="Terms and Conditions page">Terms and Conditions</a> and
                            <a href="Privacy Policy page">Privacy Policy</a></label>
                            <input type="checkbox" name="tandc" value="accepted" checked="checked" required="required"/></p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="container-fluid">
    <div class="row row2">
        <div class="col2 col-sm-4">
            <div class="col2-left">
                <h1>About this page</h1>
                <p>Have you ever wondered what if you could meet up with all the hottest people on campus?
                You are at the right place to make that come true!!!!
                With all the hottest ladies and guys registering in here you will be able
                to find some one in your taste.</p>
                <p>And the best part is that it is all for FREE!!!!</p>
            </div>
        </div>
        <div class="col2 col-sm-4">
            <div class="col2-middle">
                <h1>Events</h1>
                <p>Trip to Isle of Skye. For more info contact 1223432432</p>
                <p>Student undergrad party! You want to be there. </p>
                <p>Valentines day ideas. <a href="#">Click here</a></p>
            </div>
        </div>
        <div class="col2 col-sm-4">
            <div class="col2-right">
                <div id="myCarousel" class="carousel slide" data-ride="carousel">
                    <!-- Indicators -->
                    <ol class="carousel-indicators">
                        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                        <li data-target="#myCarousel" data-slide-to="1"></li>
                    </ol>

                    <!-- Wrapper for slides -->
                    <div class="carousel-inner" role="listbox">

                        <div class="item active">
                            <img class="img-responsive" src="img/hotperson2.jpg" alt="Campus Students" width="460" height="450">
                            <div class="carousel-caption">
                                <h3>Hot chic</h3>
                                <p>We should be friends</p>
                            </div>
                        </div>

                        <div class="item">
                            <img class="img-responsive" src="img/hotperson1.jpg" alt="Spongebob" width="400" height="345">
                            <div class="carousel-caption">
                                <h3>Hot guy</h3>
                                <p>I am into sports and hot ladies</p>
                            </div>
                        </div>

                    </div>

                    <!-- Left and right controls -->
                    <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
                        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
                        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
<footer>
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
</body>
</html>