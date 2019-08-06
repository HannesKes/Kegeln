<?php
// The Securitytoken class is used to create and manage Securitytoken objects
class Securitytoken{
  // Database connection and table name used for database access
  private $db;
  private static $table_name = "securitytokens";

  // Attributes of a Securitytoken object
  private $id;
  private $user_id;
  private $identifier;
  private $token;
  private $created_at;

  // The constructor of the Securitytoken class.
  // This function is called when a new Securitytoken object is created and instantiates the db attribute.
  public function __construct($db){
      $this->db = $db;
  }

  // Creates a new Securitytoken in the database
  public function create(){
    // Prepares query
    $query = "INSERT INTO " . Securitytoken::$table_name .
      " SET user_id=:user_id, identifier=:identifier, token=:token";
    $stmt = $this->db->prepare($query);

    // Sets the variables in the query to the corresponding attribute values of the securitytoken object
    $stmt->bindParam(":user_id", $this->user_id);
    $stmt->bindParam(":identifier", $this->identifier);
    $stmt->bindParam(":token", $this->token);

    // If the execution of the query is successful return true and set the ID of the securitytoken object
    // to the one of the newly created record in the database.
    if($stmt->execute()){
      $this->id = $this->db->lastInsertId();
      return true;
    }else{
      return false;
    }
  }

  // Reads information about a single securitytoken from the database using the identifier attribute.
  // After a securitytoken has been found the attributes of the Securitytoken object are set using the data from the database.
  public function readOne(){
    if (!empty($this->identifier)){
      $query = "SELECT * FROM " . Securitytoken::$table_name . " WHERE identifier=:identifier LIMIT 0,1";
      $stmt = $this->db->prepare($query);
      $stmt->bindParam(":identifier", $this->identifier);
    }

    // Executes the query. If no record was found return false. Else update the Attributes of the Securitytoken object.
    if($stmt->execute()) {
      $count = $stmt->rowCount();
      if($count == 0){
        return false;
      }
      $row = $stmt->fetch(PDO::FETCH_ASSOC);
      Securitytoken::updateAttributes($this, $row);
      return true;
    } else {
      return false;
    }
  }

  // Updates the DB using the attributes of the object
  public function update(){
    // Prepares query
    $query = "UPDATE " . Securitytoken::$table_name .
      " SET token=:token WHERE identifier=:identifier,";
    $stmt = $this->db->prepare($query);

    // Sets the variables in the query to the corresponding attribute values of the Securitytoken object
    $stmt->bindParam(":identifier", $this->identifier);
    $stmt->bindParam(":token", $this->token);

    // Execute the query and return true if the execution was successful
    if($stmt->execute()){
      return true;
    }else{
      return false;
    }
  }

  // Updates all attributes of the consigned Securitytoken object using the values from the $row parameter.
  public static function updateAttributes($securitytoken, $row){
    $securitytoken->setId($row['id']);
    $securitytoken->setUser_id($row['user_id']);
    $securitytoken->setIdentifier($row['identifier']);
    $securitytoken->setToken($row['token']);
    $securitytoken->setCreated_at($row['created_at']);
  }

  // Getter and Setter methods
  // In the setters unwanted connectors/symbols are removed when setting the attrbute value.
  public function getId()
  {
      return $this->id;
  }
  public function setId($id)
  {
      $this->id = htmlspecialchars(strip_tags($id));
  }
  public function getUser_id()
  {
      return $this->user_id;
  }
  public function setUser_id($user_id)
  {
      $this->user_id = htmlspecialchars(strip_tags($user_id));
  }
  public function getIdentifier()
  {
      return $this->identifier;
  }
  public function setIdentifier($identifier)
  {
      $this->identifier = htmlspecialchars(strip_tags($identifier));
  }
  public function getToken()
  {
      return $this->token;
  }
  public function setToken($token)
  {
      $this->token = htmlspecialchars(strip_tags($token));
  }
  public function getCreated_at()
  {
      return $this->created_at;
  }
  public function setCreated_at($created_at)
  {
      $this->created_at = htmlspecialchars(strip_tags($created_at));
  }
  // End of Getter and Setter Methods
}
?>
