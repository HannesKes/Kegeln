<?php
include_once $_SERVER["DOCUMENT_ROOT"] . '/Kegeln/database/db.php';
include_once $_SERVER["DOCUMENT_ROOT"] . '/Kegeln/objects/game.php';
include_once $_SERVER["DOCUMENT_ROOT"] . '/Kegeln/objects/game_user.php';
include_once $_SERVER["DOCUMENT_ROOT"] . '/Kegeln/objects/bill.php';

function insertGame() {

  $database = new Database();
  $db = $database->getConnection();

  $activeUsers = User::readAll($db);

  // Validierungen
  if (!isset($_POST['no_pumpking'])) {
    if (!isset($_POST['present' . $_POST['pumpking_id']])) {
      throw new Exception('Der eingetragene Pumpenkönig scheint nicht anwesend zu sein.');
    }

    $highest_pumps = 0;
    foreach ($activeUsers as $user) {
      if ($_POST['pumps' . $user->getId()] > $highest_pumps) {
        $highest_pumps = $_POST['pumps' . $user->getId()];
      }
      if ($_POST['pumps' . $user->getId()] > $_POST['number']) {
        throw new Exception('Der eingetragene Pumpenkönig scheint nicht die Person mit der hächsten Pumpenanzahl zu sein. Die meisten Pumpen geworfen hat der Nutzer "' . $user->getUsername() . '".');
      }
    }
    if ($highest_pumps != $_POST['number']) {
      throw new Exception('Die Pumpenanzahl des Pumpenkönigs stimmt nicht mit dem Wert in der Tabelle überein.');
    }
  }

  $game = new Game($db);
  $next = false;

  // Set attributes of the new game object
  $game->setDate($_POST['date']);
  if (!isset($_POST['no_pumpking'])) {
    $game->setKing($_POST['pumpking_id']);
    $game->setAmount($_POST['number']);
  }
  if (!($_POST['nextGame']=="0001-01-01" || $_POST['nextGame']=="")){
    $game->setNextGame($_POST['nextGame']);
    $next = true;
  }

  if (!$game->create()) {
    throw new Exception('Es konnte kein neues Spiel erstellt werden. Bitte versuchen Sie es erneut. Es kann nicht mehrere Spiele an einem Tag geben.');
  }

  // Set game_user-objects
  foreach ($activeUsers as $user) { // #SchönPerformantFürJedenEintragEigeneDBAnfrage
    $game_user = new Game_User($db);
    $game_user->setGame($game->getId());
    $game_user->setUser($user->getId());
    $post_pumps = "pumps" . $user->getId();
    $game_user->setPumps($_POST[$post_pumps]);
    $post_present = "present" . $user->getId();
    if (isset($_POST[$post_present])) {
      $game_user->setPresent(true);
    } else {
      $game_user->setPresent(false);
      $game_user->setPumps(0);
    }

    if (!$game_user->create()) {
      throw new Exception('Es konnte kein neues Spiel erstellt werden. Bitte versuchen Sie es erneut. Sie müssen zuerst das aktuelle Spiel sowie die dazugehörigen Einträge ind er Tabelle \'game_user\' entfernen. Viel Spaß!');
    }

    $bill = new Bill($db);
    $bill->setDate($_POST['date']);
    $bill->setUser($user->getId());
    $bill->setPayment(1);
    $post_paid = "paid" . $user->getId();
    if (isset($_POST[$post_paid])) {
      $bill->setPaid(true);
    } else {
      $bill->setPaid(false);
    }
    if (!$bill->create()) {
      throw new Exception('Es konnte keine Rechnung für den Nutzer ' . $user->getUsername() . ' erstellt werden. Sie müssen die Rechnungen unbedingt manuell in der Datenbank korrigieren, damit der Kontostand übereinstimmt. Sie sollten dabei auch das aktuelle Spiel sowie die dazugehörigen Einträge in der Tabelle \'game_user\' entfernen. Viel Spaß dabei!');
    }
  }

  if (!isset($_POST['no_pumpking'])) {
    $bill = new Bill($db);
    $bill->setDate($_POST['date']);
    $bill->setUser($_POST['pumpking_id']);
    $bill->setPayment(2);
    if (isset($_POST['pumpking_paid'])) {
      $bill->setPaid(true);
    } else {
      $bill->setPaid(false);
    }
    if (!$bill->create()) {
      throw new Exception('Es konnte keine Rechnung für den Pumpenkönig erstellt werden. Sie müss dies manuell in der Datenbank ergänzen. Wenden Sie sich hierzu an den unnützen Admin Niko Theders. Schönen Tag noch!');
    }
  }

  if($next){
    header("Location: /Kegeln/index.php?message=2");
  } else {
    header("Location: /Kegeln/index.php?message=3");
  }
  exit();
}

?>
