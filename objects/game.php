<?php
// The Game class is used to create and manage Game objects
class Game {
  // Database connection and Table name used for database access
  private $db;
  private static $table_name = "games";

  // Attributes of an Game object
  private $id;
  private $date;
  private $king;
  private $amount;
  private $nextGame;

  // The constructor of the Game class.
  // This function is called when a new Game object is created and instantiates the db attribute.
  public function __construct($db) {
    $this->db = $db;
  }

  // Reads information about a single game from the database using either the ID or date attribute.
  // After a game has been found the attributes of the game object are set using the data from the database.
  public function readOne() {
    if (!empty($this->id)){
      $query = "SELECT * FROM " . Game::$table_name . " WHERE id=:id limit 0,1";
      $stmt = $this->db->prepare($query);
      $stmt->bindParam(":id", $this->id);
    } elseif (!empty($this->date)) {
      $query = "SELECT * FROM " . Game::$table_name . " WHERE date=:date limit 0,1";
      $stmt = $this->db->prepare($query);
      $stmt->bindParam(":date", $this->date);
    } else {
      return false;
    }
    // Executes the query. If no record was found return false. Else update the Attributes of the Game Object.
    if($stmt->execute()){
      $count = $stmt->rowCount();
      if($count == 0){
        return false;
      }
      $row = $stmt->fetch(PDO::FETCH_ASSOC);
      User::updateAttributes($this, $row);
      return true;
    } else {
      return false;
    }
  }

  // Creates a new Game in the database
  public function create() {
    // Prepares query
    $query = "INSERT INTO " . Game::$table_name . " SET date=:date, king=:king,
      amount=:amount, nextGame=:nextGame";
    $stmt = $this->db->prepare($query);

    // Sets the variables in the query to the corresponding attribute values of the user object
    $stmt->bindParam(":date", $this->date);
    $stmt->bindParam(":king", $this->king);
    $stmt->bindParam(":amount", $this->amount);
    $stmt->bindParam(":nextGame", $this->nextGame);

    // If the execution of the query is successful return true and set the ID of the game object
    // To the one of the newly created record in the database.
    if($stmt->execute()) {
        $this->id = $this->db->lastInsertId();
        return true;
    } else {
        return false;
    }
  }

  // Updates the DB using the attributes of the object
  public function update() {
    // Prepares query
    $query = "UPDATE " . Game::$table_name . " SET date=:date, king=:king,
      amount=:amount, nextGame=:nextGame WHERE id =:id";
    $stmt = $this->db->prepare($query);

    // Sets the variables in the query to the corresponding attribute values of the user object
    $stmt->bindParam(":date", $this->date);
    $stmt->bindParam(":king", $this->king);
    $stmt->bindParam(":amount", $this->amount);
    $stmt->bindParam(":nextGame", $this->nextGame);

    // Execute the query and return true if the execution was successful
    if($stmt->execute()) {
      return true;
    } else {
      return false;
    }
  }

  public static function addDate($db, $id, $date){
    // Prepares query
    $query = "UPDATE " . Game::$table_name . " SET date=:date WHERE id =:id";
    $stmt = $db->prepare($query);

    // Sets the variables in the query to the corresponding attribute values of the user object
    $stmt->bindParam(":date", $this->date);
    $stmt->bindParam(":id", $this->id);
  }

  // Returns an array containing all Game objects with values from the Database.
  public static function readAll($db) {
    // Prepares and executes the query.
    $query = "SELECT * From " . Game::$table_name . " ORDER BY date DESC";

    $stmt = $db->prepare($query);
    $stmt->execute();

    // Create a User object array
    $game_array = array();

    // Traverses the Resultset of the query Execution.
    // Adds a new element to the array for each record.
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
      $user = new Game($db);
      Game::updateAttributes($game, $row);
      // Adds the User object to the array
      $game_array[] = $game;
    }

    return $game_array;
  }

  // Updates all attributes of the consigned Game object using the values from the $row parameter.
  public static function updateAttributes($game, $row){
    $game->setId($row['id']);
    $game->setDate($row['date']);
    $game->setKing($row['king']);
    $game->setAmount($row['amount']);
    $game->setNextGame($row['nextGame']);
  }

  // Getter and Setter methods
  // In the setters unwanted connectors/symbols are removed when setting the attrbute value.
  function getId() {
    return $this->id;
  }

  public function setId($newId) {
    $this->id = htmlspecialchars(strip_tags($newId));
  }

  public function getDate() {
    return $this->date;
  }

  public function setDate($newDate) {
    $this->date = htmlspecialchars(strip_tags($newDate));
  }

  public function getKing() {
    return $this->king;
  }

  public function setKing($newKing) {
    $this->king = htmlspecialchars(strip_tags($newKing));
  }

  public function getAmount() {
    return $this->amount;
  }

  public function setAmount($newAmount) {
    $this->amount = htmlspecialchars(strip_tags($newAmount));
  }

  public function getNextGame() {
    return $this->nextGame;
  }

  public function setNextGame($newNextGame) {
    $this->nextGame = htmlspecialchars(strip_tags($newNextGame));
  }

  // End of Getter and Setter Methods
}
?>
