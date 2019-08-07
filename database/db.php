<?php
// The database class is used to build a connection to the database
class database {
  // Variables of database objects
  private $host = "localhost";
  private $db_name = "k78222_kegeldb";
  private $username = "root";
  private $password = "";
  public $db;

  // Build connection to the database and return it
  function getConnection () {
    $this->db = null;

    try{
      $this->db = new PDO("mysql:host=$this->host;dbname=$this->db_name;charset=utf8", $this->username, $this->password);
      return $this->db;
    }catch(PDOException $exception){
      echo "Connection error: " . $exception->getMessage();
    }
  }
}
?>
