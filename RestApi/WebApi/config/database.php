<?php
// used to get mysql database connection
class Database {
    private $host = "localhost";
    private $db_name = "u892124399_Mithraateckzy3";
    private $username = "u892124399_Mithraateckzy3";
    private $password = '$Mithr@564589'; // Use single quotes here

    public $conn;

    public function getConnection(){
        $this->conn = null;
        try{
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            $this->conn->exec("set names utf8");
        } catch(PDOException $exception){
            echo "Connection error: " . $exception->getMessage();
        }
        return $this->conn;
    }
}
?>
