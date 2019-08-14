<?php
include_once $_SERVER["DOCUMENT_ROOT"] . '/Kegeln/database/db.php';
include_once $_SERVER["DOCUMENT_ROOT"] . '/Kegeln/objects/game.php';

function insertGame() {

  $database = new Database();
  $db = $database->getConnection();

  $game = new Game($db);

  //Set attributes of the new user object
  $game->setDate($_POST['date']);
  $game->setKing($_POST['user_id']);
  $game->setAmount($_POST['number']);
  if (isset($_POST['nextGame'])){
    $game->setNextGame($_POST['nextGame']);
  }

  if ($game->create()) {
    // registration successful message


    header("Location: /Kegeln/index.php");
    exit();
  } else {
    throw new Exception('Es konnte kein neues Spiel erstellt werden. Bitte probiere es erneut. Es kann nicht mehrere Spiele an einem Tag geben.');
  }
}
?>
