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
    $query = "SELECT SUM(t2.amount) AS balance FROM bills AS t1 LEFT JOIN payments AS t2 ON t1.payment = t2.id WHERE paid=true";
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

  // returns the sum of the bills (=balance) from the database
  public static function getSumByUser($db, $user) {
    // Prepares and executes the query.
    $query = "SELECT SUM(t2.amount) AS sum FROM bills AS t1 LEFT JOIN payments AS t2 ON t1.payment = t2.id WHERE t1.user = :user";
    $stmt = $db->prepare($query);
    $stmt->bindParam(':user', $user);

    // Executes the query. If no record was found return 0. Else update the Attributes of the Bill Object.
    $stmt->execute();
    $count = $stmt->rowCount();
    if($count == 0){
      return 0;
    }
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $sum = $row['sum'];

    return $sum;
  }

  // Updates the DB using the id of the object
  public static function pay($db, $id) {
    // Prepares query
    $query = "UPDATE " . Bill::$table_name . " SET paid=true WHERE id =:id";
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

  // Returns an array containing all Bill objects with attribute paid = false
  public static function getOpenBills($db) {
    // Prepares and executes the query.
    $query = "SELECT * From " . Bill::$table_name . " WHERE paid=false ORDER BY payment, user, date";

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

  // Returns an array containing all Bill objects with attribute paid = false and corresponding to the given user
  public static function getOpenBillsByUser($db, $userid) {
    // Prepares and executes the query.
    $query = "SELECT * From " . Bill::$table_name . " WHERE user=:user AND paid=false ORDER BY payment, date DESC";

    $stmt = $db->prepare($query);
    $stmt->bindParam(":user", $userid);

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

  // Returns an array containing all Bill objects corresponding to the given user
  public static function getAllBillsByUser($db, $userid) {
    // Prepares and executes the query.
    $query = "SELECT * From " . Bill::$table_name . " WHERE user=:user ORDER BY payment, date DESC";

    $stmt = $db->prepare($query);
    $stmt->bindParam(":user", $userid);

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

  // Returns an array containing all Bill objects with attribute paid = false and corresponding to the given payment
  public static function getOpenBillsByPayment($db, $payment) {
    // Prepares and executes the query.
    $query = "SELECT * From " . Bill::$table_name . " WHERE paid=false AND payment=:payment ORDER BY user, date";

    $stmt = $db->prepare($query);
    $stmt->bindParam(":payment", $payment);

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

  // Returns an array containing all payment objects that have corresponding relations to an unpaid bill
  public static function getOpenPayments($db) {
    // Prepares and executes the query.
    $query = "SELECT * From payments AS t1 WHERE EXISTS (SELECT * FROM bills AS t2 where t1.id = t2.payment)";

    $stmt = $db->prepare($query);
    $stmt->execute();

    // Create a Bill object array
    $payment_array = array();

    // Traverses the Resultset of the query Execution.
    // Adds a new element to the array for each record.
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
      $payment = new Payment($db);
      Payment::updateAttributes($payment, $row);
      // Adds the Bill object to the array
      $payment_array[] = $payment;
    }

    return $payment_array;
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
