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

  include_once $_SERVER["DOCUMENT_ROOT"] . '/Kegeln/includes/game_inc.php';

  $next = false;
  $nextId = $_GET['id']+1;
  $nextGame = new Game($db);
  $nextGame->setId($nextId);
  if ($nextGame->readOne()) {
    $next = true;
  }

  $date = $game->getDate();
  $formattedDate = substr($date, 8, 2) . "." . substr($date, 5, 2) . "." . substr($date, 0, 4);

  $nextDate = $game->getNextGame();
  $formattedNext = substr($nextDate, 8, 2) . "." . substr($nextDate, 5, 2) . "." . substr($nextDate, 0, 4);

  if ($game->getKing() != null) {
    $user = new User($db);
    $user->setId($game->getKing());
    $user->readOne();
    $king = $user->getUsername() . " (" . $user->getFirstname() . " " . $user->getLastname() . ")";
  }

  $punishments = Bill::getPunishmentsByDate($db, $date);
  $dumbUsers = User::getOpenMonthly($db, $date);
  $absentUsers = User::getAbsent($db, $date);

  if (isset($_POST['save'])) {
    try {
      updateGame($db, $gameId);
    } catch (Exception $e) { ?>
      <br/>
      <div class="alert alert-danger alert-dismissible">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <strong>Fehler!</strong> <?php echo $e->getMessage(); ?>
      </div>
      <?php
    }
  }

  if ($next) {
    echo "<a href='/Kegeln/game/game.php?id=$nextId'><button class='btn btn-secondary float-right mt-2'>nächstes Spiel</button></a>";
  }

?>

  <u><center><h2>Spiel vom <b><?php echo $formattedDate;?></b></h2></center></u><br/>

  <ul class="list-group">
    <li class="list-group-item">
      <b>Pumpenkönig</b><br/>
      <?php if ($game->getKing() != null) {
        echo $king . "," . $game->getAmount() . " Pumpen";
      } else {
        echo "Kein Pumpenkönig vorhanden <i class='far fa-frown'></i>";
      }
      ?>
    </li>
    <li class="list-group-item">
      <b>Nächster Termin</b><br/>
      <?php
      if ($next){
        echo "<a href='/Kegeln/game/game.php?id=$nextId'>$formattedNext</a>";
      } else {
        if ($game->getNextGame() == NULL) {
          if ($isAdmin) {
            echo "Sie haben noch kein nächstes Spiel geplant. Sie können das Datum des nächsten Spiels <a href='/Kegeln/game/update_game.php'>hier</a> festlegen.";
          } else {
            echo "noch kein nächstes Spiel geplant";
          }
        } else {
          echo $formattedNext;
        }
      }
      ?>
    </li>
    <li class="list-group-item"><b>Strafen</b><br/>
      <?php
      if (sizeof($punishments) == 0) {
          echo "Da hat der Niko wohl ausnahmsweise mal nicht die Klingel getroffen... Keine Strafen bei diesem Spiel.";
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
    <li class="list-group-item"><b>Anwesend: </b>
      <?php
      if (sizeof($absentUsers) == 0) {
        echo "Alle!";
      } else {
        echo "der Rest";
      }
      ?>
    </li>
  </ul>

  <?php
  // if ($edit == false && $isAdmin) { TODO: Vorarbeit für Funktion "Spiel bearbeiten"
  ?>

  <!-- <form class="float-right mt-3" action="" method="POST">
    <input type="submit" name="edit" class="btn btn-primary" value="Spiel bearbeiten">
  </form> -->

  <?php
  if (isset($comments) && !empty($comments)) {
  ?>

  <br/><br/>

  <!-- Comment Section -->

  <div class="row bootstrap snippets">
    <div class="col-md-offset-2 col-sm-12">
        <div class="comment-wrapper">
            <div class="card">
                <div class="card-header">
                    <b>Kommentare</b>
                </div>
                <div class="card-body"> <!-- style="max-height:650px; overflow: auto" -->
                  <form action="" method="POST">
                    <textarea class="form-control" name="content" placeholder="Schreibe einen Kommentar..." rows="3"></textarea>
                    <br>
                    <button type="submit" name="submitComment" class="btn btn-info float-right">Post</button><br/><br/>
                  </form>
                    <hr>
                    <ul class=""> <!-- media-list -->

                      <?php foreach ($comments as $comment) {
                        $commentUser = new User($db);
                        $commentUser->setId($comment->getUser());
                        $commentUser->readOne();

                        // Timestamp formatieren

                        // TODO: Strich (<hr>) nur, wenn noch nachfolgende Kommentare
                        ?>

                        <li class="media">
                            <a href="#">
                                <img src="<?php echo $commentUser->getFullImagePath(); ?>" style="width:64px; height:64px; border:2px solid #e5e7e8" alt="" class="rounded-circle mr-3">
                            </a>
                            <div class="media-body">
                                <span class="text-muted float-right">
                                    <small class="text-muted"><?php echo $comment->getTimestamp(); ?></small> <!-- 30 min ago -->
                                </span>
                                <strong class="text-success">@<?php echo $commentUser->getUsername(); ?></strong>
                                <p>
                                    <?php echo $comment->getContent(); ?>
                                </p>
                            </div>
                        </li>
                        <hr>

                      <?php } ?>

                        <!-- <li class="media">
                            <a href="#">
                                <img src="https://bootdey.com/img/Content/user_1.jpg" style="width:64px; height:64px; border:2px solid #e5e7e8" alt="" class="rounded-circle mr-3">
                            </a>
                            <div class="media-body">
                                <span class="text-muted float-right">
                                    <small class="text-muted">30 min ago</small>
                                </span>
                                <strong class="text-success">@MartinoMont</strong>
                                <p>
                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                                    Lorem ipsum dolor sit amet, <a href="#">#consecteturadipiscing </a>.
                                </p>
                            </div>
                        </li>
                        <hr>
                        <li class="media">
                            <a href="#">
                                <img src="https://bootdey.com/img/Content/user_2.jpg" style="width:64px; height:64px; border:2px solid #e5e7e8" alt="" class="rounded-circle mr-3">
                            </a>
                            <div class="media-body">
                                <span class="text-muted float-right">
                                    <small class="text-muted">30 min ago</small>
                                </span>
                                <strong class="text-success">@LaurenceCorreil</strong>
                                <p>
                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit.<br/>
                                    Lorem ipsum dolor <a href="#">#ipsumdolor </a>adipiscing elit.
                                </p>
                            </div>
                        </li>
                        <hr>
                        <li class="media">
                            <a href="#">
                                <img src="https://bootdey.com/img/Content/user_3.jpg" style="width:64px; height:64px; border:2px solid #e5e7e8" alt="" class="rounded-circle mr-3">
                            </a>
                            <div class="media-body">
                                <span class="text-muted float-right">
                                    <small class="text-muted">30 min ago</small>
                                </span>
                                <strong class="text-success">@JohnNida</strong>
                                <p>
                                    Lorem ipsum dolor <a href="#">#sitamet</a> sit amet, consectetur adipiscing elit.
                                </p>
                            </div>
                        </li> -->

                    </ul>
                </div>
            </div>
        </div>

      </div>
  </div>


<?php
  }
  // }

include_once $_SERVER["DOCUMENT_ROOT"] . '/Kegeln/footer.php';
?>
