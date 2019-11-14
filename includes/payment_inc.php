<?php
include_once $_SERVER["DOCUMENT_ROOT"] . '/Kegeln/database/db.php';
include_once $_SERVER["DOCUMENT_ROOT"] . '/Kegeln/objects/payment.php';
include_once $_SERVER["DOCUMENT_ROOT"] . '/Kegeln/objects/bill.php';

function insertPayment() {

  $database = new Database();
  $db = $database->getConnection();

  $game = new Game($db);
  $game->setId($_POST['game_id']);
  $game->readOne();

  $bill = new Bill($db);
  $bill->setDate($game->getDate());
  $bill->setUser($_POST['user_id']);
  $bill->setPayment($_POST['payment_id']);
  if (isset($_POST['paid'])) {
    $bill->setPaid(true);
  } else {
    $bill->setPaid(false);
  }
  if (!$bill->create()) {
    throw new Exception('Es konnte keine Rechnung erstellt werden.');
  }

  // TODO: Erfolgsmeldung
  // if(next){
  //   header("Location: /Kegeln/index.php?message=2");
  // } else {
  //   header("Location: /Kegeln/index.php?message=3");
  // }
  header("Location: /Kegeln/payment.php");
  exit();
}
?>
