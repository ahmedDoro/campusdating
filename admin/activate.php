<?php
// including the database connection file
include_once("config.php");

$userID = $_GET['userID'];
		$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "UPDATE tbl_users SET block='N' WHERE userID=$userID";

if ($conn->query($sql) === TRUE) {
   header("Location: index.php");
} else {
    echo "Error updating record: " . $conn->error;
}

$conn->close();
		
	

?>
 <?php


// Create connection

?> 
