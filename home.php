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
 


$title= $userID;

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
    <link href="css/homePageDesign.css" type="text/css" rel="stylesheet">
    <title>Home Page</title>
	<script src="js/jquery.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="main.js"></script>
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
            <div class="collapse navbar-collapse" id="myNavbar">
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="#"><span class="glyphicon glyphicon-user"></span> Welcome: <?php echo $username; ?></a></li>
                    <li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Sign out</a></li>
                </ul>
            </div>
        </nav><br /><br />
    </div>
    <div class="container main">
        <div class="row">
            <div class="col-pics col-sm-4">
               <div id="get_photo">
			   </div>
                    <div class="row row-pics">
                        <div class="col-md-3">
                                <a href="hotperson1.jpg">
                                    <img src="img/hotperson1.jpg" alt="hp1" class="thumbnail">
                                </a>
                        </div>
                        <div class="col-md-3">
                                <a href="hotperson3.jpg">
                                    <img src="img/hotperson3.jpg" alt="hp3" class="thumbnail">
                                </a>
                        </div>
                        <div class="col-md-3">
                                <a href="hotperson4.jpg">
                                    <img src="img/hotperson4.jpg" alt="hp4" class="thumbnail">
                                </a>
                        </div>
                        <div class="col-md-3">
                                <a href="hotperson5.jpg">
                                    <img src="img/hotperson5.jpg" alt="hp5" class="thumbnail">
                                </a>
                        </div>
							<a href="uploads/multiupload.php" /><button class="btn">Manage Photos</button></a>
                    </div>
            </div>
            <div class="col-md-5">
                <ul class="nav nav-tabs">
                    <li class="active"><a data-toggle="tab" href="#home">Home</a></li>
                    <li><a data-toggle="tab" href="#menu1">My Profile</a></li>
                    <li><a data-toggle="tab" href="#menu2">Search for matches</a></li>
                    <li><a data-toggle="tab" href="#menu3">About me</a></li>
                    <li><a data-toggle="tab" href="#menu4">Favourites</a></li>
                </ul>
                <div class="tab-content">
                    <div id="home" class="tab-pane fade in active">
                        <h3>HOME</h3>
                        <p>Welcome <?php echo $username; ?> to your profile. You are at the best place if you are looking to meet some of the
                        hottest students!</p>
                        <p>Hope you will find your perfect match in here soon!</p>
                    </div>
                    <div id="menu1" class="tab-pane fade">
                        <h3>My Profile</h3>
                        <table class="table">
                            <tr><th>Full name</th><td><?php echo $f_name; ?></td></tr>
                            <tr><th>Username</th><td><?php echo $username; ?></td></tr>
                            <tr><th>Date of Birth</th><td><?php echo $dob; ?></td></tr>
                            <tr><th>Campus email</th><td><?php echo $userEmail; ?></td></tr>
                            <tr><th>Height</th><td><?php echo $height; ?> cm</td></tr>
                            <tr><th>Gender</th><td><?php echo $gender; ?></td></tr>
                            <tr><th>Sexual orientation</th><td><?php echo $sexual_orientation; ?></td></tr>
                            <tr><th>Ethnicity</th><td><?php echo $ethnic; ?></td></tr>
                            <tr><th>Department</th><td><?php echo $department; ?></td></tr>
                            <tr><th>Programme</th><td><?php echo $course_name; ?></td></tr>
                            <tr><th>Marital Status</th><td><?php echo $m_status; ?></td></tr>
                        </table>
                       <a href="edit.php" > <button class="btn">Update</button></a>
                    </div>
                    <div id="menu2" class="tab-pane fade">
                        <h3></h3>
                        
                            <div class="form-group">
                                <h1>Search our singles</h1>
                                <label for="gender">Gender</label>
                                <select id="gender" name="gender" class="form-control">
                                    <option value="Female">Female</option>
                                    <option value="Male">Male</option>
                                </select>
                                <label for="sex">Sexual Orientation</label>
                                <select id="sex" class="form-control" name="age">
                                    <option value="Heterosexual">Heterosexual</option>
                                    <option value="Bisexual">Bisexual</option>
                                    <option value="Homosexual">Homosexual</option>
                                </select>
                                <label for="ethnicity">Ethnicity</label>
                                <select id="ethnicity" class="form-control" name="ethnicity">
                                    <option value="white">White</option>
                                    <option value="Black">Black</option>
                                    <option value="Black">Asian</option>
                                    <option value="Black">Indian</option>
                                    <option value="Black">Other</option>
                                </select>
                            </div>
							<button class="btn btn-primary" id="search_btn">Search</button>
							<p><br/></p>
							
							<div class="panel-body">
							<div id="get_result">
							</div>
							</div>
                    </div>
                    <div id="menu3" class="tab-pane fade">
                        <h3>About me</h3>
                            <h4>My interests and hobbies</h4>
                            <p>I like sports and music and many many other things which you can find
                            out if we can meet up for a drink or two!</p>
                            <h4>I am looking for</h4>
                            <p>A nice looking young person with a fun personality and
                            great attitude. That person must be sporty and play music too.</p>
                            <button value="update" class="btn">Update</button>
                    </div>
                    <div id="menu4" class="tab-pane fade">
                        <h3>Favourites</h3>
							<div class="panel-body">
							<div id="get_friends">
							</div>
							<br />
							<div id="get_friend_request">
							</div>
							</div>
							
							
							<div class="row row-pics">
                            <div class="col-md-3">
                                <a href="hotperson1.jpg">
                                 
                                </a>
                            </div>
                            <div class="col-md-3">
                                <a href="hotperson3.jpg">
                                   
                                </a>
                            </div>
                            <div class="col-md-3">
                                <a href="hotperson4.jpg">
                                  
                                </a>
                            </div>
                            <div class="col-md-3">
                                <a href="hotperson5.jpg">
                                   
                            </div>
                        </div>
                    </div>
					
                </div>
				
            </div>
			
            <div class="col-md-3">
                <div class="row topics-box">
                    <div class="topics">
                        <h3>Topics to talk about</h3>
						 <a href="group_chat/chat.php"><p>Group Chat</p></a>
                        <a href="http://www.bbc.co.uk/sport"><p>Sports</p></a>
                        <a href="https://www.bbc.co.uk/music/news"><p>Music</p></a>
                        <a href="http://www.imdb.com/"><p>Movies</p></a>
                        <a href="http://www.rgu.ac.uk/news-and-events"><p>Campus news and events</p></a>
                    </div>
                </div>
                <div class="row recommended-box">
                    <div class="recommended">
                        <h3>Recommended to you</h3>
                        <div id="get_r_friends">
                        </div>
                        
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