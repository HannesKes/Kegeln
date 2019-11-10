<?php
// The Game_User class is used to create and manage Game_User objects
class Game_User {
  // Database connection and Table name used for database access
  private $db;
  private static $table_name = "game_user";

  // Attributes of an Game_User object
  private $id;
  private $game;
  private $user;
  private $present;
  private $pumps;

  // The constructor of the Game_User class.
  // This function is called when a new Game_User object is created and instantiates the db attribute.
  public function __construct($db) {
    $this->db = $db;
  }

  // Creates a new Game_User in the database
  public function create() {
    // Prepares query
    $query = "INSERT INTO " . Game_User::$table_name . " SET game=:game, user=:user, present=:present, pumps=:pumps";
    $stmt = $this->db->prepare($query);

    // Sets the variables in the query to the corresponding attribute values of the game_user object
    $stmt->bindParam(":game", $this->game);
    $stmt->bindParam(":user", $this->user);
    $stmt->bindParam(":present", $this->present);
    $stmt->bindParam(":pumps", $this->pumps);

    // If the execution of the query is successful return true and set the ID of the game_user object
    // To the one of the newly created record in the database.
    if($stmt->execute()) {
        $this->id = $this->db->lastInsertId();
        return true;
    } else {
        return false;
    }
  }

  // Returns an array containing all Game_User objects with values from the Database.
  public static function readAll($db) {
    // Prepares and executes the query.
    $query = "SELECT * From " . Game_User::$table_name;

    $stmt = $db->prepare($query);
    $stmt->execute();

    // Create a Game_User object array
    $game_user_array = array();

    // Traverses the Resultset of the query Execution.
    // Adds a new element to the array for each record.
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
      $game_user = new Game_User($db);
      Game_User::updateAttributes($game_user, $row);
      // Adds the Game_User object to the array
      $game_user_array[] = $game_user;
    }

    return $game_user_array;
  }

  // Updates all attributes of the consigned Game_User object using the values from the $row parameter.
  public static function updateAttributes($game_user, $row){
    $game_user->setId($row['id']);
    $game_user->setGame($row['game']);
    $game_user->setUser($row['user']);
    $game_user->setPresent($row['present']);
    // $game_user->setPaid($row['paid']);
    $game_user->setPumps($row['pumps']);
  }

  // Getter and Setter methods
  // In the setters unwanted connectors/symbols are removed when setting the attrbute value.
  function getId() {
    return $this->id;
  }

  public function setId($newId) {
    $this->id = htmlspecialchars(strip_tags($newId));
  }

  public function getGame() {
    return $this->date;
  }

  public function setGame($newGame) {
    $this->game = htmlspecialchars(strip_tags($newGame));
  }

  public function getUser() {
    return $this->user;
  }

  public function setUser($newUser) {
    $this->user = htmlspecialchars(strip_tags($newUser));
  }

  public function getPresent() {
    return $this->amount;
  }

  public function setPresent($newPresent) {
    $this->present = htmlspecialchars(strip_tags($newPresent));
  }

  public function getPumps() {
    return $this->pumps;
  }

  public function setPumps($newPumps) {
    $this->pumps = htmlspecialchars(strip_tags($newPumps));
  }

  // End of Getter and Setter Methods
}
?>
