<?php
include_once $_SERVER["DOCUMENT_ROOT"] . '/Kegeln/objects/game.php';

// Instantiate game
$game = new Game($db);
$game->setId($_GET['id']);

if (isset($_GET['id']) and $_GET['id'] !== "") {
  $id = $_GET['id'];
  $game->setId($id);
} else {
  header("Location: $redirect_page?errorcode=6");
  exit();
}
// Read the details of user to be read
if(!$game->readOne()){
  // If you dont find one you get redirected
  header("Location: $redirect_page?errorcode=7");
  exit();
}

// Controls toggle of $edit
$edit = false;
if (isset($_POST['edit']) ) {
  $edit = true;
}

function updateGame($db, $gameId) {

  $edit = false;

}
?>
