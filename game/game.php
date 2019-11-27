<?php
include_once $_SERVER["DOCUMENT_ROOT"] . '/Kegeln/includes/session.php';
include_once $_SERVER["DOCUMENT_ROOT"] . '/Kegeln/objects/game.php';
include_once $_SERVER["DOCUMENT_ROOT"] . '/Kegeln/objects/payment.php';
include_once $_SERVER["DOCUMENT_ROOT"] . '/Kegeln/objects/bill.php';
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

      $punishments = Bill::getPunishmentsByDate($db, $date);
      $dumbUsers = User::getOpenMonthly($db, $date);
      $absentUsers = User::getAbsent($db, $date);

      if ($next) {
        echo "<a href='/Kegeln/game/game.php?id=$nextId'><button class='btn btn-secondary float-right mt-2'>nächstes Spiel</button></a>";
      }

    ?>

      <u><center><h2>Spiel vom <b><?php echo $formattedDate;?></b></h2></center></u><br/>

      <ul class="list-group">
        <li class="list-group-item">
          <b>Pumpenkönig</b><br/>
          <?php echo $king; ?>, <?php echo $game->getAmount(); ?> Pumpen
        </li>
        <li class="list-group-item">
          <b>Nächster Termin</b><br/>
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
        </li>
        <li class="list-group-item"><b>Strafen</b><br/>
          <?php
          if (sizeof($punishments) == 0) {
              echo "Da hat der Niko wohl ausnahmsweise mal nicht die Klingel getroffen...";
          } else {
            echo "<br/>";
            $payment = new Payment($db);
            $payment->setId($punishments[array_key_first($punishments)]->getPayment());
            $payment->readOne();
            echo "<i><u>" . $payment->getDescription() . " (" . $payment->getAmount() . " €)</u></i>";
            $old_user = null;
            $counter = 1;
            $multiple = false;
            foreach ($punishments as $punishment) {
              $user = new User($db);
              $user->setId($punishment->getUser());
              $user->readOne();
              if ($punishment->getPayment() != $payment->getId()) {
                $payment->setId($punishment->getPayment());
                $payment->readOne();
                echo "<br/><br/><i><u>" . $payment->getDescription() . " (" . $payment->getAmount() . " €)</u></i>";
              }

              if ($old_user == $user->getId()) {
                $multiple = true;
                $counter = $counter + 1;
              } else {
                if ($multiple) {
                  echo " <b>(" . $counter . "x)</b>";
                }
                echo "<br/>" . $user->getUsername();
                $counter = 1;
                $multiple = false;
                $old_user = $user->getId();
              }
            }
          }
          ?>
        </li>
        <li class="list-group-item"><b>Ausstehender Monatsbeitrag</b>
          <?php
          if (sizeof($dumbUsers) == 0) {
              echo "Welch eine erfreuliche Überraschung! Alle User scheinen bezahlt zu haben... "
              . "<i class='pl-2 far fa-grin-hearts fa-2x'></i>";
          } else {
            foreach ($dumbUsers as $user) {
              echo "<br/>" . $user->getUsername();
            }
          }
          ?>
        </li>
        <li class="list-group-item"><b>Abwesende Mitglieder: </b>
          <?php
          if (sizeof($absentUsers) == 0) {
            if (sizeof($dumbUsers) == 0) {
              echo "Eine weitere Überraschung! Alle User sind erschienen! ";
            } else {
              echo "Welch eine erfreuliche Überraschung! Alle User sind erschienen! ";
            }
            echo "<i class='pl-2 far fa-grin-hearts fa-2x'></i>";
          } else {
            echo array_shift($absentUsers)->getUsername();
            foreach ($absentUsers as $user) {
              echo ", " . $user->getUsername();
            }
          }
          ?>
        </li>
        <li class="list-group-item"><b>Anwesend: </b>der Rest</li>
      </ul>

    <?php

    } else {
      header("Location: /Kegeln/index.php?errorcode=7");
    }

  } else {
    header("Location: /Kegeln/index.php?errorcode=6");
  }

include_once $_SERVER["DOCUMENT_ROOT"] . '/Kegeln/footer.php';
?>
