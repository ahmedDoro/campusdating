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
$User_name = $row['userName'];
$image = $row['userID'];

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
    <link href="css/creatupdatestyle.css" type="text/css" rel="stylesheet">
    <title>Create or Update Profile</title>
</head>
<body>
<?php
		
		
		
		if (!isset($_GET['sbm_bt']) && !isset($_GET['sbm_bt2']) && !isset($_GET['sbm_bt4']) && $_SERVER['REQUEST_METHOD'] ==='GET'){
		// execute if requested using HTTP GET Method
		?>
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
<div class="container">
   <form action="<?php echo $_SERVER['PHP_SELF']; ?> " method="POST" >
        <div class="form-group">
            <fieldset>
                <legend>Profile Details</legend>
                <label for="firstName">Full name: </label>
                <input class="form-control" type="text" name="f_name" /><br />
                <label for="surName">Username: </label>
                <input class="form-control" type="text"  name="u_name" value="<?php echo ($User_name); ?>" /><br />
                <label for="dob">DoB: </label>
                <input class="form-control" type="date" name="dob" /><br />
                <label  for="study_level">Level of Study: </label><br />
                <select class="form-control" name="study_level">
                    <option value="Select">--select--</option>
					<option value="PhD">PhD</option>
                    <option value="Masters">Masters</option>
                    <option value="First Degree">First Degree</option>
                    <option value="Postgraduate Diploma">Postgraduate Diploma</option>
                    <option value="Diploma">Diploma</option>
                    <option value="other">Other</option>
                </select><br /><br />
                <label  for="height">Height(in centimeters): </label>
                <input class="form-control" type="number" name="height" min="30" max="350" /><br /><br />
                <label for="gender">Gender: </label>
                <select class="form-control" name="gender">
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                </select><br /><br />
				 <label  for="nationaliy">Nationality: </label>
				 <select class="form-control" name="nationality">
                    <option value="UK">UK</option>
                    <option value="Nigeria">Nigeria</option>
					<option value="Australia">Australia</option>
                </select><br /><br />
                
                <label  for="ethnicity">Ethnicity: </label><br />
                <select class="form-control" name="ethnic">
                    <option value="white">White</option>
                    <option value="Black-African">Black</option>
                    <option value="asian">Asian</option>
                    <option value="Indian">Indian</option>
                    <option value="notTell">Rather not tell</option>
                    <option value="other">Other</option>
                </select><br /><br />
				<label   for="religion">Religion/Believe: </label><br />
                <select class="form-control" name="religion" >
				<option value="">--select--</option>
                    <option value="Islam">Islam</option>
                    <option value="Christianity">Christianity</option>
                    <option value="Hinduism">Hinduism</option>
                    <option value="Judaism">Judaism</option>
					<option value="Atheist">Atheist</option>
                    <option value="other">Other</option>
                </select><br /><br />
                
                <label  for="maritalStatus">Marital Status: </label>
                <select class="form-control" name="m_status">
                    <option value="married">Married</option>
                    <option value="single">Single</option>
                    <option value="divorced">Divorced</option>
                    <option value="widowed">Widowed</option>
                    <option value="civil partners">Civil partners</option>
                </select><br />
				<input class="submit" type="submit" name="sbm_bt1" value="Next">
            </fieldset>
       
    </form>
    <?php
		}
		elseif($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['sbm_bt1'])) {
	// execute if requested using HTTP POST Method
			$member_ID = $path;
			$f_name = $_POST["f_name"];
			$u_name = $_POST["u_name"];
			$gender = $_POST["gender"];
			$dob = $_POST["dob"];
			$study_level = $_POST["study_level"];
			$religion = $_POST["religion"];
			$nationality = $_POST["nationality"];
			$ethnic = $_POST["ethnic"];
			$height = $_POST["height"];
			$m_status = $_POST["m_status"];
			$course_ID =$path;
			
			
			
		
			require_once 'dbconfig.php';

				try {
					   $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
					// set the PDO error mode to exception
					$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
					  
					$sql = "UPDATE  members SET member_ID ='".$member_ID."', f_name='".$f_name."', 
					username='".$u_name."', gender='".$gender."' , dob='".$dob."', study_level='".$study_level."', religion='".$religion."', nationality='".$nationality."', ethnic='".$ethnic."', height='".$height."', m_status='".$m_status."', course_ID='".$course_ID."' WHERE member_ID ='".$path."' ";
					
					
					// use exec() because no results are returned
					$conn->exec($sql);
					header('location: edit.php?sbm_bt=Next');
					}
				catch(PDOException $e)
					{
					echo $sql . "<br>" . $e->getMessage();
					}

				$conn = null;

		} 
		
		// execute if requested using HTTP POST Method
		elseif(isset($_GET['sbm_bt'])== 'Next' && $_SERVER['REQUEST_METHOD'] ==='GET') {
	// execute if requested using HTTP POST Method
			
			?>
			 
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
<div class="container">
			<h2>Programme of Study</h2>
			<br />
			<form action="<?php echo $_SERVER['PHP_SELF']; ?> " method="POST" >
            <fieldset>
                <legend>Course</legend><br />
                <label  for="course">Course Name: </label>
                <input class="form-control" type="text" name="course_name" required><br /> <br />
                <label  for="Department">Department: </label>
                <input class="form-control" type="text" name="department" ><br /><br />
                <label  for="start_date">Start Date: </label>
                <input class="form-control" type="date" name="start_date" /><br /><br />
				<label  for="end_date">End Date: </label>
                <input class="form-control" type="date" name="end_date" /><br /><br />
				<input class="submit" type="submit" name="sbm_bt2" value="Next">
            </fieldset>
        </form>
		<?php	
		} 
		elseif($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['sbm_bt2'])) {
	// execute if requested using HTTP POST Method
			
			$course_name = $_POST["course_name"];
			$department = $_POST["department"];
			$start_date = $_POST["start_date"];
			$end_date = $_POST["end_date"];
			
			$course_ID =$path;
			
			
			
		
			require_once 'dbconfig.php';

				try {
					   $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
					// set the PDO error mode to exception
					$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
					
					$sql = "UPDATE  course SET course_ID ='".$course_ID."', course_name='".$course_name."', 
					department='".$department."', start_date='".$start_date."' , end_date='".$end_date."' WHERE course_ID ='".$path."' ";
					
					
					$conn->exec($sql);
					header('location: edit.php?sbm_bt2=Next');
					}
				catch(PDOException $e)
					{
					echo $sql . "<br>" . $e->getMessage();
					}

				$conn = null;

		} 
		
		// execute if requested using HTTP POST Method
		elseif(isset($_GET['sbm_bt2'])== 'Next' && $_SERVER['REQUEST_METHOD'] ==='GET') {
	// execute if requested using HTTP POST Method
			
			?>
			 
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
<div class="container">
			<h2> Interest Details</h2>
			<form action="<?php echo $_SERVER['PHP_SELF']; ?> " method="POST" >
            <fieldset>
                <legend>Interest</legend><br />
                 <label for="sexualorient">Sexual Orientation:</label>
                <select class="form-control" name="sexualorient">
					<option value="">--select--</option>
                    <option value="Hetrosexual">Hetrosexual</option>
                    <option value="Homosexual">Homosexual</option>
                    <option value="Bisexual">Bisexual</option>
                </select><br /><br />
				 <label  for="hobby">Hobby:</label>
                <input class="form-control" type="text" name="hobby" ><br /><br />
				
                <label  for="looking_for">Looking for: </label>
                <select class="form-control" name="looking_for">
                    <option value="white">Girls</option>
                    <option value="black">Boys</option>
                    <option value="other">Other</option>
                </select><br />
				<input class="submit" type="submit" name="sbm_bt3" value="Next">
            </fieldset>
        </form>
		<?php	
		} 
		elseif($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['sbm_bt3'])) {
	// execute if requested using HTTP POST Method
			$member_ID =$path;
			$sexual_orientation = $_POST["sexualorient"];
			$hobby = $_POST["hobby"];
			$looking_for = $_POST["looking_for"];
			
			$activity_iD =$path;
			
			$profile = "Y";
			
		
			require_once 'dbconfig.php';

				try {
					   $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
					// set the PDO error mode to exception
					$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
					  
					
					
					$sql = "UPDATE  interest SET member_ID ='".$path."', sexual_orientation='".$sexual_orientation."', 
					hobby='".$hobby."', looking_for='".$looking_for."' , activity_iD='".$path."' WHERE member_ID ='".$path."' ";
				
					
					$conn->exec($sql);
					header('location: eaction.php');
					}
				catch(PDOException $e)
					{
					echo $sql . "<br>" . $e->getMessage();
					}

				$conn = null;

		} 
		
		
		// execute if requested using HTTP POST Method
		elseif(isset($_GET['sbm_bt4'])== 'Next' && $_SERVER['REQUEST_METHOD'] ==='GET') {
	// execute if requested using HTTP POST Method
			
			?>
			
		<?php	
		} 
		?>
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