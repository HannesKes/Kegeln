<?php
// The User class is used to create and manage User objects
class User {
  // Database connection and Table name used for database access
  private $db;
  private static $table_name = "users";

  // Attributes of an User object
  private $id;
  private $username;
  private $password;
  private $email;
  private $firstname;
  private $lastname;
  private $isNew;
  private $isAdmin;

  // The constructor of the User class.
  // This function is called when a new User object is created and instantiates the db attribute.
  public function __construct($db) {
    $this->db = $db;
    echo "2.1<br/>";
  }

  // Reads information about a single user from the database using either the ID, username or e-mail attribute.
  // After an user has been found the attributes of the user object are set using the data from the database.
  public function readOne() {
    if (!empty($this->id)){
      $query = "SELECT * FROM " . User::$table_name . " WHERE id=:id limit 0,1";
      $stmt = $this->db->prepare($query);
      $stmt->bindParam(":id", $this->id);
    } elseif (!empty($this->username)) {
      $query = "SELECT * FROM " . User::$table_name . " WHERE username LIKE :username limit 0,1";
      $stmt = $this->db->prepare($query);
      $stmt->bindParam(":username", $this->username);
    } elseif (!empty($this->email)) {
      $query = "SELECT * FROM " . User::$table_name . " WHERE email LIKE :email limit 0,1";
      $stmt = $this->db->prepare($query);
      $stmt->bindParam(":email", $this->email);
    } else {
      return false;
    }
    // Executes the query. If no record was found return false. Else update the Attributes of the User Object.
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

  // Creates a new User in the database
  public function create() {
    // Prepares query
    $query = "INSERT INTO " . User::$table_name . " SET firstname=:firstname, lastname=:lastname,
      username=:username, email=:email, password=:password, isNew=:isNew, isAdmin=:isAdmin";
    $stmt = $this->db->prepare($query);

    // Sets the variables in the query to the corresponding attribute values of the user object
    $stmt->bindParam(":firstname", $this->firstname);
    $stmt->bindParam(":lastname", $this->lastname);
    $stmt->bindParam(":username", $this->username);
    $stmt->bindParam(":email", $this->email);
    $stmt->bindParam(":password", $this->password);
    $stmt->bindParam(":isNew", $this->isNew);
    $stmt->bindParam(":isAdmin", $this->isAdmin);

    // If the execution of the query is successful return true and set the ID of the user object
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
    $query = "UPDATE " . User::$table_name . " SET username=:username, firstname=:firstname, lastname=:lastname,
      email=:email, password=:password, isNew=:isNew, isAdmin=:isAdmin WHERE id =:id";
    $stmt = $this->db->prepare($query);

    // Sets the variables in the query to the corresponding attribute values of the user object
    $stmt->bindParam(':username', $this->username);
    $stmt->bindParam(':firstname', $this->firstname);
    $stmt->bindParam(':lastname', $this->lastname);
    $stmt->bindParam(':email', $this->email);
    $stmt->bindParam(':id', $this->id);
    $stmt->bindParam(":password", $this->password);
    $stmt->bindParam(":isNew", $this->isNew);
    $stmt->bindParam(":isAdmin", $this->isAdmin);

    // Execute the query and return true if the execution was successful
    if($stmt->execute()) {
      return true;
    } else {
      return false;
    }
  }

  // Updates the DB using the id of the object
  public static function accept($db, $id) {
    // Prepares query
    $query = "UPDATE " . User::$table_name . " SET isNew='0' WHERE id =:id";
    $stmt = $db->prepare($query);

    // Sets the variables in the query to the corresponding attribute values of the user object
    $stmt->bindParam(':id', $id);

    // Execute the query and return true if the execution was successful
    if($stmt->execute()) {
      return true;
    } else {
      return false;
    }
  }

  // deletes an object from the database using the given id
  public static function delete($db, $id) {
    // Prepares query
    $query = "DELETE FROM " . User::$table_name . " WHERE id =:id";
    $stmt = $db->prepare($query);

    // Sets the variables in the query to the corresponding attribute values of the user object
    $stmt->bindParam(':id', $id);

    // Execute the query and return true if the execution was successful
    if($stmt->execute()) {
      return true;
    } else {
      return false;
    }
  }

  // Checks the database for multiple criteria the username has to
  // Fulfill to be a valid username. If not an Exception with the corresponding message is thrown.
  public static function isUsernameValid($db, $username) {
    // Check if the username contains spaces
    if(strpos($username, ' ') !== false) {
      throw new Exception('Der Benutzername darf kein Leerzeichen enthalten. Bitte wähle einen anderen Namen und versuche es erneut.');
    }

    // Check if the username already exists in the database
    $query = "SELECT id FROM " . User::$table_name . " WHERE username=:username limit 0,1";
    $stmt = $db->prepare($query);

    // Bind username param
    $stmt->bindParam(":username", $username);

    // Execute the query and check if any User has been found. If so throw an exception.
    $stmt->execute();
    if($stmt->rowCount() > 0) {
      throw new Exception('Dieser Benutzername existiert bereits. Bitte wähle einen anderen Namen und versuche es erneut.', 2);
    }

    // Return true if the Username matches all criteria
    return true;
  }

  // Checks the email if it contains an @ and a following dot. If not an Exception with the corresponding message is thrown.
  public static function isEmailValid($db, $email) {
    // Check if the email contains spaces
    if(strpos($email, ' ') !== false) {
      throw new Exception("Die E-Mail-Adresse $email darf kein Leerzeichen enthalten. Bitte tragen Sie eine valide E-Mail-Adresse ein und versuchen Sie es erneut.", 3);
    }

    // Check if the email contains @
    if(strpos($email, '@') == false) {
      throw new Exception("Die E-Mail-Adresse $email enthält kein @. Bitte tragen Sie eine valide E-Mail-Adresse ein und versuchen Sie es erneut.", 3);
    }

    $string1 = substr($email, strpos($email, '@'));

    // Check if the email contains a dot after the @
    if(strpos($string1, '.') == false) {
      throw new Exception("Die E-Mail-Adresse $email enthält keinen Punkt nach dem @. Bitte tragen Sie eine valide E-Mail-Adresse ein und versuchen Sie es erneut.", 3);
    }

    $string2 = substr($string1, strpos($string1, '.'));

    // Check if the email contains a dot after the dot after the @
    if(strpos($string2, '.')) {
      throw new Exception("Die E-Mail-Adresse $email enthält einen Punkt nach dem Punkt nach dem @. Bitte tragen Sie eine valide E-Mail-Adresse ein und versuchen Sie es erneut.", 3);
    }

    // Return true if the Email matches all criteria
    return true;
  }

  // Returns an array containing all User objects with values from the Database.
  public static function readAll($db) {
    // Prepares and executes the query.
    $query = "SELECT * From " . User::$table_name . " order by username";

    $stmt = $db->prepare($query);
    $stmt->execute();

    // Create a User object array
    $user_array = array();

    // Traverses the Resultset of the query Execution.
    // Adds a new element to the array for each record.
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
      $user = new User($db);
      User::updateAttributes($user, $row);
      // Adds the User object to the array
      $user_array[] = $user;
    }

    return $user_array;
  }

  // Returns an array containing all User objects with the value isNew=1 from the Database.
  public static function readNew($db) {
    // Prepares and executes the query.
    $query = "SELECT * From " . User::$table_name . " WHERE isNew=1";

    $stmt = $db->prepare($query);
    $stmt->execute();

    // Create a User object array
    $user_array = array();

    // Traverses the Resultset of the query Execution.
    // Adds a new element to the array for each record.
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
      $user = new User($db);
      User::updateAttributes($user, $row);
      // Adds the User object to the array
      $user_array[] = $user;
    }

    return $user_array;
  }

  // Returns an array containing all Users who are not new
  public static function readActive($db) {
    // Prepares and executes the query.
    $query = "SELECT * From " . User::$table_name . " WHERE isNew=0";

    $stmt = $db->prepare($query);
    $stmt->execute();

    // Create a User object array
    $user_array = array();

    // Traverses the Resultset of the query Execution.
    // Adds a new element to the array for each record.
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
      $user = new User($db);
      User::updateAttributes($user, $row);
      // Adds the User object to the array
      $user_array[] = $user;
    }

    return $user_array;
  }

  // Returns an array containing all Users that have not paid Monatsbeitrag for given Date
  public static function getOpenMonthly($db, $date) {
    // Prepares and executes the query.
    $query = "SELECT t1.username From " . User::$table_name . " AS t1 LEFT JOIN " . Bill::$table_name
    . " AS t2 ON t1.id = t2.user WHERE t2.payment = 1 AND t2.paid = 0";

    $stmt = $db->prepare($query);
    $stmt->execute();

    // Create a User object array
    $user_array = array();

    // Traverses the Resultset of the query Execution.
    // Adds a new element to the array for each record.
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
      $user = new User($db);
      // User::updateAttributes($user, $row);
      $user->setUsername($row['username']);
      // Adds the User object to the array
      $user_array[] = $user;
    }

    return $user_array;
  }

  // Returns an array containing all Users that were absent for game on given Date
  public static function getAbsent($db, $date) {
    // Prepares and executes the query.
    $query = "SELECT t1.username From " . User::$table_name . " AS t1 LEFT JOIN game_user "
    . " AS t2 on t1.id = t2.user LEFT JOIN " . Game::$table_name
    . " AS t3 ON t2.game = t3.id WHERE date = :date AND t2.present = 0";

    $stmt = $db->prepare($query);
    $stmt->bindParam(":date", $date);

    $stmt->execute();

    // Create a User object array
    $user_array = array();

    // Traverses the Resultset of the query Execution.
    // Adds a new element to the array for each record.
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
      $user = new User($db);
      // User::updateAttributes($user, $row);
      $user->setUsername($row['username']);
      // Adds the User object to the array
      $user_array[] = $user;
    }

    return $user_array;
  }

  // Returns the User with the newest record for the most pumps and the corresponding game
  public static function readPumpKingAndGame($db) {
    // Prepares and executes the query.
    $query = "SELECT * FROM " . Game::$table_name . " AS t1 LEFT JOIN " . User::$table_name . " AS t2
            on t1.king = t2.id where t1.king IS NOT NULL ORDER BY t1.amount DESC, t1.date DESC LIMIT 0,1";

    $stmt = $db->prepare($query);
    $stmt->execute();

    $kingAndGame = array();

    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $user = new User($db);
    User::updateAttributes($user, $row);
    $kingAndGame[] = $user;

    $game = new Game($db);
    Game::updateAttributes($game, $row);
    $kingAndGame[] = $game;

    return $kingAndGame;
  }

  // Updates all attributes of the consigned User object using the values from the $row parameter.
  public static function updateAttributes($user, $row){
    $user->setId($row['id']);
    $user->setFirstname($row['firstname']);
    $user->setLastname($row['lastname']);
    $user->setUsername($row['username']);
    $user->setEmail($row['email']);
    $user->setpassword($row['password']);
    $user->setIsNew($row['isNew']);
    $user->setIsAdmin($row['isAdmin']);
  }

  // Getter and Setter methods
  // In the setters unwanted connectors/symbols are removed when setting the attrbute value.
  function getId() {
    return $this->id;
  }

  public function setId($newId) {
    $this->id = htmlspecialchars(strip_tags($newId));
  }

  public function getFirstname() {
    return $this->firstname;
  }

  public function setFirstname($newFirstname) {
    $this->firstname = htmlspecialchars(strip_tags($newFirstname));
  }

  public function getLastname() {
    return $this->lastname;
  }

  public function setLastname($newLastname) {
    $this->lastname = htmlspecialchars(strip_tags($newLastname));
  }

  public function getUsername() {
    return $this->username;
  }

  public function setUsername($newUsername) {
    $this->username = htmlspecialchars(strip_tags($newUsername));
  }

  public function getEmail() {
    return $this->email;
  }

  public function setEmail($newEmail) {
    $this->email = htmlspecialchars(strip_tags($newEmail));
  }

  public function getpassword() {
    return $this->password;
  }

  public function setpassword($newpassword) {
    $this->password = htmlspecialchars(strip_tags($newpassword));
  }

  public function getIsNew(){
    return $this->isNew;
  }

  public function setIsNew($newIsNew){
    $this->isNew = htmlspecialchars(strip_tags($newIsNew));
  }

  public function getIsAdmin(){
    return $this->isAdmin;
  }

  public function setIsAdmin($newIsAdmin){
    $this->isAdmin = htmlspecialchars(strip_tags($newIsAdmin));
  }

  // End of Getter and Setter Methods
}
?>
