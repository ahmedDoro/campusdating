<?php
// including the database connection file
include_once("config.php");

if(isset($_POST['update']))
{	

	$userID = mysqli_real_escape_string($mysqli, $_POST['userID']);
	
	$name = mysqli_real_escape_string($mysqli, $_POST['userName']);
	$status = mysqli_real_escape_string($mysqli, $_POST['block']);
	$email = mysqli_real_escape_string($mysqli, $_POST['userEmail']);	
	
	// checking empty fields
	if(empty($name) || empty($status) || empty($email)) {	
			
		if(empty($name)) {
			echo "<font color='red'>User Name field is empty.</font><br/>";
		}
		
		if(empty($status)) {
			echo "<font color='red'>Status field is empty.</font><br/>";
		}
		
		if(empty($email)) {
			echo "<font color='red'>Email field is empty.</font><br/>";
		}		
	} else {	
		//updating the table
		$result = mysqli_query($mysqli, "UPDATE tbl_users SET block='Y' WHERE userID=$userID");
		
		//redirectig to the display page. In our case, it is index.php
		header("Location: index.php");
	}
}
?>
<?php
//getting id from url
$userID = $_GET['userID'];

//selecting data associated with this particular id
$result = mysqli_query($mysqli, "SELECT * FROM tbl_users WHERE userID=$userID");

while($res = mysqli_fetch_array($result))
{
	$name = $res['userName'];
	$status = $res['block'];
	$email = $res['userEmail'];
}
?>
<html>
<head>	
	<title>Edit Status</title>
</head>

<body>
	<a href="index.php">Admin Page</a>
	<br/><br/>
	
	<form name="form1" method="post" action="edit.php">
		<table border="0">
			<tr> 
				<td>Name</td>
				<td><input type="text" name="userName" value="<?php echo $name;?>"></td>
			</tr>
			<tr> 
				<td>Status</td>
				<td><input type="text" name="block" value="<?php echo $status;?>"></td>
			</tr>
			<tr> 
				<td>Email</td>
				<td><input type="text" name="userEmail" value="<?php echo $email;?>"></td>
			</tr>
			<tr>
				<td><input type="hidden" name="userID" value=<?php echo $_GET['userID'];?>></td>
				<td><input type="submit" name="update" value="Update"></td>
			</tr>
		</table>
	</form>
</body>
</html>
