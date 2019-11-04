<?php
// The Game class is used to create and manage Game objects
class Game {
  // Database connection and Table name used for database access
  private $db;
  public static $table_name = "games";

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
      $query = "SELECT * FROM " . Game::$table_name . " WHERE id=:id LIMIT 0,1";
      $stmt = $this->db->prepare($query);
      $stmt->bindParam(":id", $this->id);
    } elseif (!empty($this->date)) {
      $query = "SELECT * FROM " . Game::$table_name . " WHERE date=:date LIMIT 0,1";
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
      Game::updateAttributes($this, $row);
      return true;
    } else {
      return false;
    }
  }

  // Creates a new Game in the database
  public function create() {
  	// check nextGame of lastGame
    $query = "SELECT nextGame FROM " . Game::$table_name . " ORDER BY date DESC LIMIT 0, 1";
    $stmt = $this->db->prepare($query);

    if($stmt->execute()){
      $row = $stmt->fetch(PDO::FETCH_ASSOC);
      $nextGame_last = $row['nextGame'];
    } else {
      return false;
    }

    // update nextGame of lastGame
    if ($nextGame_last != $this->date){
      $query = "UPDATE " . Game::$table_name . " SET nextGame=:nextGame WHERE nextGame=:currentGame";
      $stmt = $this->db->prepare($query);
      $stmt->bindParam(":nextGame", $this->date);
      $stmt->bindParam(":currentGame", $nextGame_last);

      if($stmt->execute()){
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $nextGame_last = $row['nextGame'];
      } else {
        return false;
      }
    }

    // Prepares query
    $query = "INSERT INTO " . Game::$table_name . " SET date=:date, king=:king,
      amount=:amount, nextGame=:nextGame";
    $stmt = $this->db->prepare($query);

    // Sets the variables in the query to the corresponding attribute values of the game object
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

    // Sets the variables in the query to the corresponding attribute values of the game object
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

  // add date for nextGame to latest Game
  public static function addDate($db, $date){

    // get id of newest game
    $game = Game::readLast($db);
    $id = $game->getId();

    // Prepares query
    $query = "UPDATE " . Game::$table_name . " SET nextGame=:date WHERE id=:id";
    $stmt = $db->prepare($query);

    // Sets the variables in the query to the corresponding attribute values of the game object
    $stmt->bindParam(":date", $date);
    $stmt->bindParam(":id", $id);

    // execute query. return false if execution failed.
    if($stmt->execute()) {
        return true;
    } else {
        return false;
    }
  }

  //get the id vor a given date
  public static function getIdForDate($db, $date){

    // Prepares query
    $query = "SELECT id FROM " . Game::$table_name . " WHERE date=:date";
    $stmt = $db->prepare($query);

    // Sets the variables in the query to the corresponding attribute values of the game object
    $date = substr($date, 6, 4) . "-" . substr($date, 3, 2) . "." . substr($date, 0, 2);
    $stmt->bindParam(":date", $date);

    // execute query. return false if execution failed.
    if($stmt->execute()) {
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row['id'];
    } else {
        return false;
    }
  }

  // returns the newest game from the database
  public static function readLast($db) {
    // Prepares and executes the query.
    $query = "SELECT * from " . Game::$table_name . " ORDER BY date DESC LIMIT 0,1";
    $stmt = $db->prepare($query);

    // Executes the query. If no record was found return 0. Else update the Attributes of the Game Object.
    $stmt->execute();
    $count = $stmt->rowCount();
    if($count == 0){
      return 0;
    }
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    $game = new Game($db);
    Game::updateAttributes($game, $row);

    return $game;
  }

  // Returns an array containing all Game objects with values from the Database.
  public static function readAll($db) {
    // Prepares and executes the query.
    $query = "SELECT * From " . Game::$table_name . " ORDER BY date DESC";

    $stmt = $db->prepare($query);
    $stmt->execute();

    // Create a Game object array
    $game_array = array();

    // Traverses the Resultset of the query Execution.
    // Adds a new element to the array for each record.
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
      $game = new Game($db);
      Game::updateAttributes($game, $row);
      // Adds the Game object to the array
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
