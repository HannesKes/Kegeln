<?php
include_once $_SERVER["DOCUMENT_ROOT"] . '/Kegeln/database/db.php';
include_once $_SERVER["DOCUMENT_ROOT"] . '/Kegeln/objects/game.php';

function insertGame() {

  $database = new Database();
  $db = $database->getConnection();

  $game = Game::readLast($db);
  if ($game->getNextGame()==NULL){
    throw new Exception("Es kann kein neues Spiel erstellt werden, wenn im alten Spiel noch kein nächstes Spiel festgelegt wurde. Du kannst das Datum <a href='/Kegeln/game/update_game.php'>hier</a> ergänzen.");
  }

  $game = new Game($db);
  $next = false;

  //Set attributes of the new user object
  $game->setDate($_POST['date']);
  $game->setKing($_POST['user_id']);
  $game->setAmount($_POST['number']);
  if (!$_POST['nextGame']=="0001-01-01"){
    $game->setNextGame($_POST['nextGame']);
    $next = true;
  }



  if ($game->create()) {
    // registration successful message

    if(next){
      header("Location: /Kegeln/index.php?message=2");
    } else {
      header("Location: /Kegeln/index.php?message=3");
    }
    exit();
  } else {
    throw new Exception('Es konnte kein neues Spiel erstellt werden. Bitte versuchen Sie es erneut. Es kann nicht mehrere Spiele an einem Tag geben.');
  }
}
?>
