<?php
// The Pun Class is used to retrieve beer puns from the database and access them over pun objects.
class Pun {
  // Database connection and Table name used for database access
  private $db;
  private static $table_name = "puns";

  // Attributes of a Pun object
  public $id;
  public $content;

  // The contructor of the Pun class.
  // This function is called when a new Pun object is created and instantiates the db attribute.
  public function __construct($db){
    $this->db = $db;
  }

  // Selects a random record from the database, creates a new pun object,
  // Sets the attributes of the pun object and returns it.
  public static function randomPun($db){
    $query = "SELECT * FROM " . Pun::$table_name . " ORDER BY RAND() LIMIT 1";
    $stmt = $db->prepare($query);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $pun = new Pun($db);
    Pun::updateAttributes($pun, $row);
    return $pun;
  }

  // Updates all attributes of the consigned Pun object using the values from the $row parameter.
  public static function updateAttributes($pun, $row){
    $pun->setId($row['id']);
    $pun->setContent($row['content']);
  }

  // Getter and Setter methods
  // In the setters unwanted connectors/symbols are removed when setting the attribute value.
  public function getId(){
    return $this->id;
  }

  public function setId($newId){
    $this->id = htmlspecialchars(strip_tags($newId));
  }

  public function getContent(){
    return $this->content;
  }

  public function setContent($newContent){
    $this->content = htmlspecialchars(strip_tags($newContent));
  }
  // End of Getter and Setters methods

}
?>
