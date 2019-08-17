<?php
include_once $_SERVER["DOCUMENT_ROOT"] . '/Kegeln/objects/session.php';
include_once $_SERVER["DOCUMENT_ROOT"] . '/Kegeln/objects/game.php';
  $page_title = "Spiel " . $_GET['id'];

  //You may not be on this page when you are logged out or new.
  //Redirect to index page
  $redirect_when_loggedin = false;
  $redirect_when_loggedout = true;
  $redirect_when_new = true;
  $redirect_when_no_admin = false;
  $redirect_page = 'index.php';

  include_once $_SERVER["DOCUMENT_ROOT"] . '/Kegeln/header.php';

  $game = new Game($db);
  $game->setId($_GET['id']);
  $game->readOne();

  $date = $game->getDate();
  $formattedDate = substr($date, 8, 2) . "." . substr($date, 5, 2) . "." . substr($date, 0, 4);

  $user = new User($db);
  $user->setId($game->getId());
  $user->readOne();
  $king = $user->getUsername() . " (" . $user->getFirstname() . " " . $user->getLastname() . ")";

  if(isset($_GET['id'])){
  ?>

    <u style="color: #5DC3FE"><center><h2 style="color: #FE01DC">Spiel vom <b><?php echo $formattedDate;?></b></h2></center></u><br/><br/>

    <b>Pumpenkönig: </b><?php echo $king; ?> <br/>
    <b>Anzahl: </b><?php echo $game->getAmount(); ?> <br/><br/>

    <b>Strafen: </b><br/><br/>

    <b>Ausstehender Monatsbeitrag: </b><br/><br/>

  <?php
  } else {
    header("Location: /Kegeln/index.php?errorcode=6");
  }

include_once $_SERVER["DOCUMENT_ROOT"] . '/Kegeln/footer.php';
?>
