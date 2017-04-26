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
$image = $row['userID'];
$userID = $row['userID'];
$username = $row['userName'];
$userEmail = $row['userEmail'];
$imagename ="uploads/". $path ."/".$image.".jpeg";



include "search/db.php";
 $result=mysql_query("SELECT *
							  FROM interest
							   WHERE member_ID='{$path}' limit 1");
 $found=mysql_num_rows($result);
 $row1=mysql_fetch_array($result);
 $profile_var=$row1["profile"];
 
 

if($row1["profile"]==="Y"){
	$profile ='<a href="edit.php">Update</a>';
	
}else{
	
	
	$profile ='<a href="form.php">Create</a>';
}
$interested=mysql_query("SELECT *
							  FROM interest
							   WHERE member_ID='{$path}' limit 1");
 
 $lines=mysql_fetch_array($interested);
 $path1 = $profile_var=$lines["sexual_orientation"];




$result1=mysql_query("SELECT member_ID FROM interest  WHERE sexual_orientation='{$path1}'
								ORDER BY RAND()
	
									LIMIT 3");
 


$title= $_GET["r_id"];

$query=mysql_query("SELECT members.member_ID, f_name, username, gender, dob, study_level, religion, nationality, ethnic, height, m_status, 				interest.sexual_orientation, interest.hobby, interest.looking_for, course.course_name, course.department, course.start_date, course.end_date
							  FROM members, interest, course
							   WHERE members.member_ID =$title ");


							   
$line=mysql_fetch_array($query);
$id  = $line['member_ID'];
$f_name  = $line['f_name'];
$username  = $line['username'];
$gender = $line['gender'];
$dob  = $line['dob'];
$study_level = $line['study_level'];
$religion = $line['religion'];
$nationality = $line['nationality'];
$ethnic = $line['ethnic'];
$height = $line['height'];
$m_status = $line['m_status'];
$course_name = $line['course_name'];
$sexual_orientation = $line['sexual_orientation'];
$looking_for  = $line['looking_for'];
$hobby  = $line['hobby'];
$department  = $line['department'];
$start_date  = $line['start_date'];
$end_date  = $line['hobby'];



?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link href="css/viewprofilestyle.css" type="text/css" rel="stylesheet">
    <title>View profile</title>
	
</head>
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
            <div class="col-pics col-sm-3">
                <div class="photos">
                    <div id="myCarousel" class="carousel slide" data-ride="carousel">
                        <!-- Indicators -->
                        

                        <!-- Wrapper for slides -->
                        <div class="carousel-inner" role="listbox">
							<?php 
							
//retrieving main photo

if(isset($_GET["r_id"])){
 $p_id = $_GET["r_id"];
$path ="uploads/". $p_id;	
$dir_path = $path. "/*.*";

   $files = glob($dir_path);

  for ($i=0; $i<1; $i++)

{

$image = $files[$i];
$supported_file = array(
    'gif',
    'jpg',
    'jpeg',
    'png'
);
$count = 0;
$ext = strtolower(pathinfo($image, PATHINFO_EXTENSION));
while ($count<1){
if (in_array($ext, $supported_file)) {
  
 
    echo ' <div class="item active">
						
							
                                <img class="img-responsive" src="'.$image .'" alt="hp1">
                                <div class="carousel-caption">
                                   
                                    <p>We should be friends</p>
                                </div>
                            </div> ';
							
		$count++;
							
	
	
} else {
    continue;
 }
}
}
}
                           
							?>

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
                <div class="row button">
                   
                    <button value="chat" class="btn md"><a href="chatbox/chat.php"> Chat </a></button>
                   
					<a href="process.php?send=<?php echo $title; ?>">  <button value="friend" class="btn right">Add Friend</button>
				
                 
                </div>
            </div>
            <div class="info col-sm-4">
                <div class="aboutme">
                    <h3>About me</h3>
                    <h4>My interests and hobbies</h4>
                    <p>I like sports and music and many many other things which you can find
                        out if we can meet up for a drink or two!</p>
                    <h4>I am looking for</h4>
                    <p>A nice looking young person with a fun personality and
                        great attitude. That person must be sporty and play music too.</p>
                </div>
            </div>
            <div class="info col-sm-5">
                <h3><?php echo $username; ?> Profile</h3>
                        <table class="table">
					
                            <tr><th>Full name</th><td><?php echo $f_name; ?></td></tr>
                            <tr><th>Username</th><td><?php echo $username; ?></td></tr>
                            <tr><th>Date of Birth</th><td><?php echo $dob; ?></td></tr>                          
                            <tr><th>Height</th><td><?php echo $height; ?> cm</td></tr>
                            <tr><th>Gender</th><td><?php echo $gender; ?></td></tr>
                            <tr><th>Sexual orientation</th><td><?php echo $sexual_orientation; ?></td></tr>
                            <tr><th>Ethnicity</th><td><?php echo $ethnic; ?></td></tr>
                            <tr><th>Department</th><td><?php echo $department; ?></td></tr>
                            <tr><th>Programme</th><td><?php echo $course_name; ?></td></tr>
                            <tr><th>Marital Status</th><td><?php echo $m_status; ?></td></tr>
                        </table>
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