<?php
// The Payment class is used to create and manage Payment objects
class Payment {
  // Database connection and Table name used for database access
  private $db;
  private static $table_name = "payments";

  // Attributes of an Payment object
  private $id;
  private $date;
  private $user;
  private $payment;
  private $bill;

  // The constructor of the Payment class.
  // This function is called when a new Payment object is created and instantiates the db attribute.
  public function __construct($db) {
    $this->db = $db;
  }

  // Creates a new Payment in the database
  public function create() {
    // Prepares query
    $query = "INSERT INTO " . Payment::$table_name . " SET date=:date, user=:user,
      payment=:payment, bill=:bill";
    $stmt = $this->db->prepare($query);

    // Sets the variables in the query to the corresponding attribute values of the payment object
    $stmt->bindParam(":date", $this->date);
    $stmt->bindParam(":user", $this->user);
    $stmt->bindParam(":payment", $this->payment);
    $stmt->bindParam(":bill", $this->bill);

    // If the execution of the query is successful return true and set the ID of the payment object
    // To the one of the newly created record in the database.
    if($stmt->execute()) {
        $this->id = $this->db->lastInsertId();
        return true;
    } else {
        return false;
    }
  }

  // returns the payments that are not paid from the database
  public static function readAllOpenPayments($db) {
    // Prepares and executes the query.
    $query = "SELECT t1.id, t1.date, t1.user, t1.payment, t1.bill FROM " . Payment::$table_name . " AS t1
    LEFT JOIN " . Bill::$table_name . " AS t2 ON t1.bill = t2.id WHERE t2.paid=false";
    $stmt = $db->prepare($query);

    // Executes the query. If no record was found return 0. Else update the Attributes of the Payment Object.
    $stmt->execute();
    $count = $stmt->rowCount();
    if($count == 0){
      return 0;
    }
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
      $payment = new Payment($db);
      Payment::updateAttributes($payment, $row);
      // Adds the Payment object to the array
      $payment_array[] = $payment;
    }

    return $payment_array;
  }

  // returns the unpaid payments corresponding to the given user
  public static function readOpenPaymentsForUser($db, $user_id) {
    // Prepares and executes the query.
    $query = "SELECT t1.id, t1.date, t1.user, t1.payment, t1.bill FROM " . Payment::$table_name . " AS t1
    LEFT JOIN " . Bill::$table_name . " AS t2 ON t1.bill = t2.id WHERE t2.paid=false AND t1.user=:user";
    $stmt = $db->prepare($query);

    $stmt->bindParam(":user", $user_id);

    // Executes the query. If no record was found return 0. Else update the Attributes of the Payment Object.
    $stmt->execute();
    $count = $stmt->rowCount();
    if($count == 0){
      return 0;
    }
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
      $payment = new Payment($db);
      Payment::updateAttributes($payment, $row);
      // Adds the Payment object to the array
      $payment_array[] = $payment;
    }

    return $payment_array;
  }

  // returns the payments correspending to the given date
  public static function readByDate($db, $date) {
    // Prepares and executes the query.
    $query = "SELECT * FROM " . Payment::$table_name . " WHERE date=:date";
    $stmt = $db->prepare($query);

    $stmt->bindParam(":date", $date);

    // Executes the query. If no record was found return 0. Else update the Attributes of the Payment Object.
    $stmt->execute();
    $count = $stmt->rowCount();
    if($count == 0){
      return 0;
    }
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
      $payment = new Payment($db);
      Payment::updateAttributes($payment, $row);
      // Adds the Payment object to the array
      $payment_array[] = $payment;
    }

    return $payment_array;
  }

  // Returns an array containing all Payment objects with values from the Database.
  public static function readAll($db) {
    // Prepares and executes the query.
    $query = "SELECT * From " . Payment::$table_name . " ORDER BY date DESC";

    $stmt = $db->prepare($query);
    $stmt->execute();

    // Create a Payment object array
    $payment_array = array();

    // Traverses the Resultset of the query Execution.
    // Adds a new element to the array for each record.
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
      $payment = new Payment($db);
      Payment::updateAttributes($payment, $row);
      // Adds the Payment object to the array
      $payment_array[] = $payment;
    }

    return $payment_array;
  }

  // Updates all attributes of the consigned Payment object using the values from the $row parameter.
  public static function updateAttributes($payment, $row){
    $payment->setId($row['id']);
    $payment->setDate($row['date']);
    $payment->setUser($row['user']);
    $payment->setPayment($row['payment']);
    $payment->setBill($row['bill']);
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

  public function getBill() {
    return $this->bill;
  }

  public function setBill($newBill) {
    $this->bill = htmlspecialchars(strip_tags($newBill));
  }

  // End of Getter and Setter Methods
}
?>
