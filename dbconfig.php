<?php
class Database
{
     
    private $host = "localhost";
    private $db_name = "id1474749_campusdate";
    private $username = "id1474749_campusdate";
    private $password = "";
    public $conn;
     
    public function dbConnection()
	{
     
	    $this->conn = null;    
        try
		{
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
			$this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);	
        }
		catch(PDOException $exception)
		{
            echo "Connection error: " . $exception->getMessage();
        }
         
        return $this->conn;
    }
}
$servername = "localhost";
$username = "id1474749_campusdate";
$password = "";
$dbname = "id1474749_campusdate";
?>
