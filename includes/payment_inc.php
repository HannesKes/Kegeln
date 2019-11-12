<?php
include_once $_SERVER["DOCUMENT_ROOT"] . '/Kegeln/database/db.php';
include_once $_SERVER["DOCUMENT_ROOT"] . '/Kegeln/objects/payment.php';
include_once $_SERVER["DOCUMENT_ROOT"] . '/Kegeln/objects/bill.php';

function insertPayment() {

  $database = new Database();
  $db = $database->getConnection();

  $punishment = new Punishment($db);
  $punishment->setId($_POST['punishment_id']);
  $punishment->readOne();

  $bill = new Bill($db);
  $bill->setDate($_POST['date']); // TODO: Spiel auswählen statt Datum?
  $bill->setUser($_POST['user_id']);
  $bill->setAmount($punishment->getAmount());
  if (isset($_POST['paid'])) {
    $bill->setPaid(true);
  } else {
    $bill->setPaid(false);
  }
  if (!$bill->create()) {
    throw new Exception('Es konnte keine Rechnung erstellt werden.');
  }

  $payment = new Payment($db);

  // Set attributes of the new user object
  $payment->setDate($_POST['date']);
  $payment->setUser($_POST['user_id']);
  $payment->setPunishment($_POST['punishment_id']);
  $payment->setBill($bill->getId());

  if (!$payment->create()) {
    throw new Exception('Es konnte keine Strafe erstellt werden. Bitte versuchen Sie es erneut.');
  }

  // TODO: Erfolgsmeldung
  // if(next){
  //   header("Location: /Kegeln/index.php?message=2");
  // } else {
  //   header("Location: /Kegeln/index.php?message=3");
  // }
  exit();
}
?>
