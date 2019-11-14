<?php
include_once $_SERVER["DOCUMENT_ROOT"] . '/Kegeln/database/db.php';
include_once $_SERVER["DOCUMENT_ROOT"] . '/Kegeln/objects/game.php';
include_once $_SERVER["DOCUMENT_ROOT"] . '/Kegeln/objects/game_user.php';
include_once $_SERVER["DOCUMENT_ROOT"] . '/Kegeln/objects/bill.php';

function insertGame() {

  $database = new Database();
  $db = $database->getConnection();

  // $game = Game::readLast($db);
  // if ($game->getNextGame()==NULL){
  //   throw new Exception("Es kann kein neues Spiel erstellt werden, wenn im alten Spiel noch kein nächstes Spiel festgelegt wurde. Du kannst das Datum <a href='/Kegeln/game/update_game.php'>hier</a> ergänzen.");
  // }  

  $game = new Game($db);
  $next = false;

  // Set attributes of the new user object
  $game->setDate($_POST['date']);
  $game->setKing($_POST['user_id']);
  $game->setAmount($_POST['number']);
  if (!($_POST['nextGame']=="0001-01-01" || $_POST['nextGame']=="")){
    $game->setNextGame($_POST['nextGame']);
    $next = true;
  }

  if (!$game->create()) {
    throw new Exception('Es konnte kein neues Spiel erstellt werden. Bitte versuchen Sie es erneut. Es kann nicht mehrere Spiele an einem Tag geben.');
  }

  $activeUsers = User::readAll($db);

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
      throw new Exception('Es konnte kein neues Spiel erstellt werden. Bitte versuchen Sie es erneut.');
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
      throw new Exception('Es konnte keine Rechnung für den Nutzer ' . $user->getUsername() . ' erstellt werden.');
    }
  }

  if(next){
    header("Location: /Kegeln/index.php?message=2");
  } else {
    header("Location: /Kegeln/index.php?message=3");
  }
  exit();
}
?>
