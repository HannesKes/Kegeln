<?php
include_once $_SERVER["DOCUMENT_ROOT"] . '/Kegeln/objects/session.php';
include_once $_SERVER["DOCUMENT_ROOT"] . '/Kegeln/objects/game.php';
  $page_title = "Spiel " . $_GET['id'];

  //You may not be on this page when logged out.
  //Redirect to index page
  $redirect_when_loggedin = false;
  $redirect_when_loggedout = true;
  $redirect_page = 'index.php';

  include_once $_SERVER["DOCUMENT_ROOT"] . '/Kegeln/header.php';

  if($isNew){
    header("Location: /Kegeln/index.php?errorcode=3");
  }

  $games = Game::readAll($db);

  if(isset($_GET['id'])){
  ?>

    <?php echo "Spiel: " . $_GET['id']; ?>

  <?php
  } else {
    // TODO: Fehlermeldung
  }

include_once $_SERVER["DOCUMENT_ROOT"] . '/Kegeln/footer.php';
?>
