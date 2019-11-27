<?php
// The Bill class is used to create and manage Bill objects
class Bill {
  // Database connection and Table name used for database access
  private $db;
  public static $table_name = "bills";

  // Attributes of an Bill object
  private $id;
  private $date;
  private $user;
  private $payment;
  private $paid;

  // The constructor of the Bill class.
  // This function is called when a new Bill object is created and instantiates the db attribute.
  public function __construct($db) {
    $this->db = $db;
  }

  // Creates a new Bill in the database
  public function create() {
    // Prepares query
    $query = "INSERT INTO " . Bill::$table_name . " SET date=:date, user=:user,
      payment=:payment, paid=:paid";
    $stmt = $this->db->prepare($query);

    // Sets the variables in the query to the corresponding attribute values of the bill object
    $stmt->bindParam(":date", $this->date);
    $stmt->bindParam(":user", $this->user);
    $stmt->bindParam(":payment", $this->payment);
    $stmt->bindParam(":paid", $this->paid);

    // If the execution of the query is successful return true and set the ID of the bill object
    // To the one of the newly created record in the database.
    if($stmt->execute()) {
        $this->id = $this->db->lastInsertId();
        return true;
    } else {
        return false;
    }
  }

  // returns the sum of the bills (=balance) from the database
  public static function readBalance($db) {
    // Prepares and executes the query.
    $query = "SELECT SUM(payment) AS balance FROM " . Bill::$table_name . " WHERE paid=true";
    $stmt = $db->prepare($query);

    // Executes the query. If no record was found return 0. Else update the Attributes of the Bill Object.
    $stmt->execute();
    $count = $stmt->rowCount();
    if($count == 0){
      return 0;
    }
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $balance = $row['balance'];

    return $balance;
  }

  // Returns an array containing all Bill objects with values from the Database.
  public static function readAll($db) {
    // Prepares and executes the query.
    $query = "SELECT * From " . Bill::$table_name . " ORDER BY date DESC";

    $stmt = $db->prepare($query);
    $stmt->execute();

    // Create a Bill object array
    $bill_array = array();

    // Traverses the Resultset of the query Execution.
    // Adds a new element to the array for each record.
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
      $bill = new Bill($db);
      Bill::updateAttributes($bill, $row);
      // Adds the Bill object to the array
      $bill_array[] = $bill;
    }

    return $bill_array;
  }

  // Returns an array containing all Bill objects corresponding to the date that are punishments and no other payments
  public static function getPunishmentsByDate($db, $date) {
    // Prepares and executes the query.
    $query = "SELECT * From " . Bill::$table_name . " WHERE date=:date AND payment != 1 AND payment != 2 ORDER BY payment, user";

    $stmt = $db->prepare($query);
    $stmt->bindParam(":date", $date);

    $stmt->execute();

    // Create a Bill object array
    $bill_array = array();

    // Traverses the Resultset of the query Execution.
    // Adds a new element to the array for each record.
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
      $bill = new Bill($db);
      Bill::updateAttributes($bill, $row);
      // Adds the Bill object to the array
      $bill_array[] = $bill;
    }

    return $bill_array;
  }

  // Updates all attributes of the consigned Bill object using the values from the $row parameter.
  public static function updateAttributes($bill, $row){
    $bill->setId($row['id']);
    $bill->setDate($row['date']);
    $bill->setUser($row['user']);
    $bill->setPayment($row['payment']);
    $bill->setPaid($row['paid']);
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

  public function getUser() {
    return $this->user;
  }

  public function setUser($newUser) {
    $this->user = htmlspecialchars(strip_tags($newUser));
  }

  public function getPayment() {
    return $this->payment;
  }

  public function setPayment($newPayment) {
    $this->payment = htmlspecialchars(strip_tags($newPayment));
  }

  public function getPaid() {
    return $this->paid;
  }

  public function setPaid($newPaid) {
    $this->paid = htmlspecialchars(strip_tags($newPaid));
  }

  // End of Getter and Setter Methods
}
?>
