<?php
// The Payment class is used to create and manage Payment objects
class Payment {
  // Database connection and Table name used for database access
  private $db;
  private static $table_name = "payments";

  // Attributes of an Payment object
  private $id;
  private $amount;
  private $description;

  // The constructor of the Payment class.
  // This function is called when a new Payment object is created and instantiates the db attribute.
  public function __construct($db) {
    $this->db = $db;
  }

  // Creates a new Payment in the database
  public function create() {
    // Prepares query
    $query = "INSERT INTO " . Payment::$table_name . " SET amount=:amount, description=:description";
    $stmt = $this->db->prepare($query);

    // Sets the variables in the query to the corresponding attribute values of the payment object
    $stmt->bindParam(":amount", $this->amount);
    $stmt->bindParam(":description", $this->description);

    // If the execution of the query is successful return true and set the ID of the payment object
    // To the one of the newly created record in the database.
    if($stmt->execute()) {
        $this->id = $this->db->lastInsertId();
        return true;
    } else {
        return false;
    }
  }

  // Reads information about a single payment from the database using the ID.
  // After a payment has been found the attributes of the payment object are set using the data from the database.
  public function readOne() {
    if (!empty($this->id)){
      $query = "SELECT * FROM " . Payment::$table_name . " WHERE id=:id LIMIT 0,1";
      $stmt = $this->db->prepare($query);
      $stmt->bindParam(":id", $this->id);
    } else {
      return false;
    }
    // Executes the query. If no record was found return false. Else upamount the Attributes of the Game Object.
    if($stmt->execute()){
      $count = $stmt->rowCount();
      if($count == 0){
        return false;
      }
      $row = $stmt->fetch(PDO::FETCH_ASSOC);
      Payment::upamountAttributes($this, $row);
      return true;
    } else {
      return false;
    }
  }

  // Returns an array containing all Payment objects with values from the Database.
  public static function readAll($db) {
    // Prepares and executes the query.
    $query = "SELECT * From " . Payment::$table_name . " ORDER BY amount DESC";

    $stmt = $db->prepare($query);
    $stmt->execute();

    // Create a Payment object array
    $payment_array = array();

    // Traverses the Resultset of the query Execution.
    // Adds a new element to the array for each record.
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
      $payment = new Payment($db);
      Payment::upamountAttributes($payment, $row);
      // Adds the Payment object to the array
      $payment_array[] = $payment;
    }

    return $payment_array;
  }

  // Upamounts all attributes of the consigned Payment object using the values from the $row parameter.
  public static function upamountAttributes($payment, $row){
    $payment->setId($row['id']);
    $payment->setAmount($row['amount']);
    $payment->setDescription($row['description']);
  }

  // Getter and Setter methods
  // In the setters unwanted connectors/symbols are removed when setting the attrbute value.
  function getId() {
    return $this->id;
  }

  public function setId($newId) {
    $this->id = htmlspecialchars(strip_tags($newId));
  }

  public function getAmount() {
    return $this->amount;
  }

  public function setAmount($newAmount) {
    $this->amount = htmlspecialchars(strip_tags($newAmount));
  }

  public function getDescription() {
    return $this->description;
  }

  public function setDescription($newDescription) {
    $this->description = htmlspecialchars(strip_tags($newDescription));
  }

  // End of Getter and Setter Methods
}
?>
