<?php
// The Comment class is used to create and manage Comment objects
class Comment{
  // Database connection and table name used for database access
  private $db;
  private static $table_name = "comments";

  // Attributes of a Comment object
  private $id;
  private $user;
  private $game;
  private $content;
  private $timestamp;

  // The constructor of the Comment class.
  // This function is called when a new Comment object is created and instantiates the db attribute.
  public function __construct($db){
      $this->db = $db;
  }

  // Creates a new Comment in the database
  public function create(){
    // Prepares query
    $query = "INSERT INTO " . Comment::$table_name . " SET game=:game,
      user=:user,content=:content, timestamp=:timestamp";
    $stmt = $this->db->prepare($query);

    // Sets the timestamp for the creation of the Comment
    $this->setTimestamp(date('Y-m-d G:i:s'));

    // Sets the variables in the query to the corresponding attribute values of the comment object
    $stmt->bindParam(":game", $this->game);
    $stmt->bindParam(":user", $this->user);
    $stmt->bindParam(":content", $this->content);
    $stmt->bindParam(":timestamp", $this->timestamp);

    // Execute the query and return true if the execution was successful
    if($stmt->execute()){
      return true;
    }else{
      return false;
    }
  }

  // Updates the DB using the attributes of the object
  public function update(){
    // Prepares query
    $query = "UPDATE " . Comment::$table_name . " SET game=:game, user=:user,
      content=:content, timestamp=:timestamp WHERE id=:id";
    $stmt = $this->db->prepare($query);

    // Sets the timestamp for the editing of the comment and hasChanged on true because it was edited
    $this->setTimestamp(date('Y-m-d G:i:s'));

    // Sets the variables in the query to the corresponding attribute values of the Comment object
    $stmt->bindParam(":game", $this->game);
    $stmt->bindParam(":user", $this->user);
    $stmt->bindParam(":content", $this->content);
    $stmt->bindParam(":timestamp", $this->timestamp);
    $stmt->bindParam(":id", $this->id);

    // Execute the query and return true if the execution was successful
    if($stmt->execute()){
      return true;
    }else{
      return false;
    }
  }

  // If comments exist, returns an Array containing all Comment objects with values from the Database. Else returns null.
  // Parameters for filtering the Array can be set. Otherwise they are set to NULL.
  public static function readAll($game = null, $user = null, $db){
    // Comments either filtered by game, user or unfiltered
    if (!empty($game)){
      $query = "SELECT * FROM " . Comment::$table_name . " WHERE game = :game order by timestamp desc";
      $stmt = $db->prepare($query);
      $stmt->bindParam(":game", $game);
    } elseif (!empty($user)) {
      $query = "SELECT * FROM " . Comment::$table_name . " WHERE user = :user order by timestamp desc";
      $stmt = $db->prepare($query);
      $stmt->bindParam(":user", $user);
    } else {
      $query = "SELECT * FROM " . Comment::$table_name;
      $stmt = $db->prepare($query);
    }

    if($stmt->execute()){
      // Create a Comment object Array
      $comment_array = array();
      // Traverses the Resultset of the query Execution.
      // Adds a new element to the array for each record.
      while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        $comment = new Comment($db);
        Comment::updateAttributes($comment, $row);
        // Adds the Comment object to the array
        $comment_array[] = $comment;
      }
      return $comment_array;
    } else {
      return null;
    }
  }

  // Reads information about a single comment from the database using the game and user attribute.
  // After a comment has been found the attributes of the Comment object are set using the data from the database.
  public function readOne(){
    $query = "SELECT * FROM " . Comment::$table_name . " WHERE game = :game AND user = :user LIMIT 0,1";
    $stmt = $this->db->prepare($query);
    $stmt->bindParam(":game", $this->game);
    $stmt->bindParam(":user", $this->user);

    // Executes the query. If no record was found return false. Else update the Attributes of the Comment object.
    if($stmt->execute()){
      $count = $stmt->rowCount();
      if($count == 0){
        return false;
      }
      $row = $stmt->fetch(PDO::FETCH_ASSOC);
      Comment::updateAttributes($this, $row);
      return true;
    } else {
      return false;
    }
  }

  // Deletes the current comment from the database
  public function delete(){
    $query = "DELETE FROM " . Comment::$table_name . " WHERE game=:game AND user=:user";
    $stmt = $this->db->prepare($query);

    // Sets the variables in the query to the corresponding attribute values of the Comment object
    $stmt->bindParam(':game', $this->game);
    $stmt->bindParam(':user', $this->user);

    if ($stmt->execute()){
      return true;
    } else {
      return false;
    }
  }

  // Updates all attributes of the consigned Comment object using the values from the $row parameter.
  public static function updateAttributes($comment, $row){
    $comment->setId($row['id']);
    $comment->setUser($row['user']);
    $comment->setGame($row['game']);
    $comment->setContent($row['content']);
    $comment->setTimestamp($row['timestamp']);
  }

  // Getter and Setter methods
  // In the setters unwanted connectors/symbols are removed when setting the attrbute value.
	public function getId(){
		return $this->id;
	}

	public function setId($id){
		$this->id = htmlspecialchars(strip_tags($id));
	}

	public function getUser(){
		return $this->user;
	}

	public function setUser($user){
		$this->user = htmlspecialchars(strip_tags($user));
	}

	public function getGame(){
		return $this->game;
	}

	public function setGame($game){
		$this->game = htmlspecialchars(strip_tags($game));
	}

	public function getContent(){
		return $this->content;
	}

	public function setContent($content){
		$this->content = htmlspecialchars(strip_tags($content));
	}

	public function getTimestamp(){
		return $this->timestamp;
	}

  public function setTimestamp($newTimestamp) {
    $this->timestamp = htmlspecialchars(strip_tags($newTimestamp));
  }
  // End of Getter and Setter Methods
}
?>
