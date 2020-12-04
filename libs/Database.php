<?php
class Database {
    private $dsn = 'mysql:host=localhost;dbname=propertydb';
    private $username = 'root';
    private $password = 'root';
    private $conn;

	/*
    public function getConnection () {
        if (!isset($this->conn)) {
            try {
                $this->conn = new PDO($this->dsn, $this->username, $this->password);
            } catch (PDOException $e) {
                $error_message = $e->getMessage();
                exit();
            }
        }
        return $this->conn;
    }
	*/
	
	public function getConnection(){
			$this->conn = null;
			try{
				$this->conn = new PDO($this->dsn, $this->username, $this->password);
				$this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			}catch(PDOException $e){
				echo $e->getMessage();
				echo("ERROR!");
			}
			return $this->conn;
		}
}
?>