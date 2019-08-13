<?php
include_once $_SERVER["DOCUMENT_ROOT"] . '/Kegeln/database/db.php';
include_once $_SERVER["DOCUMENT_ROOT"] . '/Kegeln/objects/user.php';

function insertGame() {

  $database = new Database();
  $db = $database->getConnection();

  $user = new User($db);

  //Set attributes of the new user object
  $game->setDate($_POST['date']);
  $game->setKing($_POST['user_id']);
  $game->setAmount($_POST['number']);

  if ($game->create()) {
    // registration successful message


    header("Location: /Kegeln/index.php");
    exit();
  } else {
    throw new Exception('Es konnte kein neues Spiel erstellt werden. Bitte probiere es erneut. Es kann nicht mehrere Spiele an einem Tag geben.');
  }
}
?>
