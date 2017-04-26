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
$userID = $row['userID'];

$con = mysqli_connect($servername, $username, $password, $dbname);

//retrieving main photo

if(isset($_POST["photos"])){

$path ="uploads/". $userID;	
$dir_path = $path. "/*.*";

   $files = glob($dir_path);

  for ($i=0; $i<count($files); $i++)

{

$image = $files[$i];
$supported_file = array(
    'gif',
    'jpg',
    'jpeg',
    'png'
);

$ext = strtolower(pathinfo($image, PATHINFO_EXTENSION));
if (in_array($ext, $supported_file)) {
  
  echo '<img src="'.$image .'" alt="Random image" class="responsive" alt="hotperson2" />';
    
	exit();
	
} else {
    continue;
 }

}
}

// Recomended friends
if(isset($_POST["r_friends"])){
	
	
$interested = "SELECT *  FROM interest WHERE member_ID='$userID' limit 1";

$run_query = mysqli_query($con, $interested);

 
$lines=mysqli_fetch_array($run_query);
 
$sex = $lines["sexual_orientation"];

	$r_friends_query = "SELECT member_ID FROM interest  WHERE sexual_orientation='$sex'
								ORDER BY RAND() LIMIT 3";
	$result = mysqli_query($con, $r_friends_query);
	
	while($row=mysqli_fetch_array($result)){
		  $suggest = $row["member_ID"]; 
		 
						
		  $imagename1 ="uploads/". $suggest ."/".$suggest.".jpeg";
		  
		  echo "
		   <div class='rec-person'>
             <a href='viewprofile.php?r_id=".$suggest."' class='selectFriend'>
             <img src='$imagename1' alt='hp1' class='thumbnail'>
             </a>
           </div>
		  
		  ";
		  
	}
	
}


//Search

if(isset($_POST["search"])){
	
		 $keyword1 = $_POST["keyword1"];
		 $keyword2 = $_POST["keyword2"];
		 $keyword = $_POST["keyword"];
		
		$sql = "SELECT members.member_ID, f_name, gender, nationality
							  FROM members, interest
							 WHERE members.member_ID = interest.member_ID 
							 AND sexual_orientation LIKE '$keyword2' AND gender='$keyword1' ";		
	
	$run_query1 =mysqli_query($con, $sql);
	while($row= mysqli_fetch_array($run_query1)){
		
				$id = $row["member_ID"];
				$f_name = $row["f_name"];
				$gender = $row["gender"];
				$nationality = $row["nationality"];
				$path="uploads/".$id."/".$id.".jpeg";
				echo "<div class='row'>						
						<a href='viewprofile.php?r_id=$id' ><div class='col-md-3'><img src='$path' width='60px' height='50px'></div>
						<div class='col-md-3'>$f_name</div></a>
						<div class='col-md-3'>$keyword2</div></a>
						<div class='col-md-3'>$nationality</div>
					</div> 
				";
		echo "<hr />";
	}
}
//end search
//Friend request

if(isset($_POST["friend_request"])){
	$member_id=$userID;
     
	 $f_request_query = "SELECT * FROM friendship WHERE receiver = '$member_id' LIMIT 1";
          $f_r_query = mysqli_query($con, $f_request_query);
			  if(mysqli_num_rows($f_r_query) > 0){
					while($row = mysqli_fetch_array($f_r_query)){ 
					$_query = "SELECT * FROM members WHERE member_ID = '" . $row["sender"] . "'";
					$f_r_query2 = mysqli_query($con, $_query);
					while($_row = mysqli_fetch_array($f_r_query2)){ 
					
					  echo '
			                         
									 <div class="myfriend_div1">
									 
								  
			                    
			                     <div style="position:relative; margin:2px 0px 0px 13px;"><span style="font-size:20px; color:red;">'.$_row['username']." ".$_row['gender'].' </span>want to be friends with you</div>
			                      <br>
								 <div class="myfriend"><a href="add_friend.php?accept=' .$row['sender'].' ">Accept</a></div><br>
			                     <div class="myfriend"><a href="delete_friend_request.php?accept=' .$row['sender'].'">Reject</a></div>
                                 
								 <hr>
								  </div>';
					 }
	                      
	                }
				}else{  
						echo"<div class='myfriend_div1'>
						You do not have any friend pending  </li>
						 </div>";
									
			}
}
	// Favorates 
	
if(isset($_POST["friends"])){	
	$member_id=$userID;		
	
	$post = "SELECT * FROM myfriends WHERE myid = '$member_id' OR myfriends = '$member_id' ";
	$run_query_post = mysqli_query($con, $post);
								
	$num_rows  =mysqli_num_rows($run_query_post);
							
if ($num_rows != 0 ){

		while($row = mysqli_fetch_array($run_query_post)){
				
			$myfriend = $row['myid'];
			$member_id=$userID;
								
								
								
			if($myfriend == $member_id){
									
				$myfriend1 = $row['myfriends'];
				$friends = "SELECT * FROM members WHERE member_ID = '$myfriend1'";
				$friends_query =mysqli_query($con, $friends);
				$friendsa = mysqli_fetch_array($friends_query);
				
				$name = $friendsa['f_name'];
			    $m_id = $friendsa['member_ID'];
									  
				$path="uploads/".$m_id."/".$m_id.".jpeg";
				
									echo "
												<div class='row row-pics'>
													<div class='col-md-3'>
													<a href='hotperson1.jpg'>
													<img src='$path' alt='profile' class='thumbnail'>
													</a>
											<p  class='btn'>$name</p></a>
											<div class='myfriend'><a href='delete_friend.php?delete=".$m_id."' >Unfriend</a> </div> 
											<div class='myfriend'><a href='chatbox/chat.php?id=".$m_id."' >Chat</a> </div>
											</div>
											";
					
									    
									
					}else{
										
						$friends = "SELECT * FROM members WHERE member_ID = '$myfriend'";
						$friends_query =mysqli_query($con, $friends);
						$friendsa = mysqli_fetch_array($friends_query);
						$name = $friendsa['f_name'];
						$m_id = $friendsa['member_ID'];
										
						$path="uploads/".$m_id."/".$m_id.".jpeg";
										
							echo "
									<div class='row row-pics'>
													<div class='col-md-3'>
													<a href='hotperson1.jpg'>
													<img src='img/hotperson1.jpg' alt='hp1' class='thumbnail'>
													</a>
											<p  class='btn'>$name</p></a>
											<div class='myfriend'><a href='delete_friend.php?delete=".$m_id."' >Unfriend</a> </div> 
											<div class='myfriend'><a href='chatbox/chat.php?id=".$m_id."' >Chat</a> </div>
											</div>
											";
							
								
									
							}
									
						}
								
								
								
				}else{
								
			echo"<div id='myfriend_div'>";
								  
		echo 'You don\'t have friends </li>';
				}
										



}
	echo'</div>';
		echo'</div>';

	

?>