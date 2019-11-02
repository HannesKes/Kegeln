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
  $redirect_page = '/Kegeln/index.php';

  include_once $_SERVER["DOCUMENT_ROOT"] . '/Kegeln/header.php';

  if (isset($_GET['id']) and $_GET['id'] !== "") {

    $game = new Game($db);
    $game->setId($_GET['id']);

    if ($game->readOne()) {

      $next = false;
      $nextId = $_GET['id']+1;
      $nextGame = new Game($db);
      $nextGame->setId($nextId);
      if ($nextGame->readOne()){
        $next = true;
      }

      $date = $game->getDate();
      $formattedDate = substr($date, 8, 2) . "." . substr($date, 5, 2) . "." . substr($date, 0, 4);

      $nextDate = $nextGame->getDate();
      $formattedNext = substr($nextDate, 8, 2) . "." . substr($nextDate, 5, 2) . "." . substr($nextDate, 0, 4);

      $user = new User($db);
      $user->setId($game->getKing());
      $user->readOne();
      $king = $user->getUsername() . " (" . $user->getFirstname() . " " . $user->getLastname() . ")";

      if ($next) {
        echo "<a href='/Kegeln/game/game.php?id=$nextId'><button class='btn btn-secondary float-right'>nächstes Spiel</button></a>";
      }

    ?>

      <u style="color: #5DC3FE"><center><h2 style="color: #FE01DC">Spiel vom <b><?php echo $formattedDate;?></b></h2></center></u><br/><br/>

      <b>Pumpenkönig: </b><?php echo $king; ?> <br/>
      <b>Anzahl: </b><?php echo $game->getAmount(); ?> <br/><br/>

      <b>Nächster Termin: </b>
      <?php
      if ($next){
        echo "<a href='/Kegeln/game/game.php?id=$nextId'>$formattedNext</a>";
      } else {
        if ($isAdmin) {
          echo "Sie haben noch kein nächstes Spiel geplant. Sie können das Datum des nächsten Spiels <a href='/Kegeln/game/update_game.php'>hier</a> festlegen.";
        } else {
          echo "noch kein nächstes Spiel geplant";
        }
      }

      ?>
      <a href='/Kegeln/game/game.php?id=$nextId'></a>

      <br/><br/>

      <b>Strafen: </b><br/><br/>

      <b>Ausstehender Monatsbeitrag: </b><br/><br/>

    <?php

    } else {
      header("Location: /Kegeln/index.php?errorcode=7");
    }

  } else {
    header("Location: /Kegeln/index.php?errorcode=6");
  }

include_once $_SERVER["DOCUMENT_ROOT"] . '/Kegeln/footer.php';
?>
