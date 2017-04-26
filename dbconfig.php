<?php
class Database
{
     
    private $host = "br-cdbr-azure-south-b.cloudapp.net";
    private $db_name = "campusdate";
    private $username = "b5878316b539fe";
    private $password = "8e5d969e";
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
$username = "b5878316b539fe";
$password = "8e5d969e";
$dbname = "campusdate";
?>
