<?php
include_once $_SERVER["DOCUMENT_ROOT"] . '/Kegeln/objects/game.php';
include_once $_SERVER["DOCUMENT_ROOT"] . '/Kegeln/objects/comment.php';

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

$comments = Comment::readAll($game->getId(), null, $db);

// Controls toggle of $edit
$edit = false;
if (isset($_POST['edit']) ) {
  $edit = true;
}

if (isset($_POST['submitComment'])) {
  $comment = new Comment($db);
  $comment->setUser($userid);
  $comment->setGame($id);
  $comment->setContent($_POST['content']);
  $comment->create();
  // After the comment is submitted, reload the page to list the comment
  header("location: #");
  exit();
}

function updateGame($db, $gameId) {

  $edit = false;

}
?>
