<?php
include_once $_SERVER["DOCUMENT_ROOT"] . '/Kegeln/includes/session.php';
include_once $_SERVER["DOCUMENT_ROOT"] . '/Kegeln/objects/game.php';
include_once $_SERVER["DOCUMENT_ROOT"] . '/Kegeln/objects/bill.php';
  $page_title = "Übersicht";

  //You may not be on this page when your are logged out or new.
  //Redirect to index page
  $redirect_when_loggedin = false;
  $redirect_when_loggedout = false;
  $redirect_when_new = false;
  $redirect_when_no_admin = false;
  $redirect_page = '/Kegeln/index.php';

  include_once $_SERVER["DOCUMENT_ROOT"] . '/Kegeln/header.php';

  if (!$loggedin) {
    header("Location: /Kegeln/user/login.php");
    exit();
  }

  // Page that is given in the URL: Default value is one.
  $page = isset($_GET['page']) ? $_GET['page'] : 1;

  // Set the number of records per page and the LIMIT clause for the get.
  $records_per_page = 4;
  $from_record_num = ($records_per_page * $page) - $records_per_page;

  $games = Game::readAll($db, $from_record_num, $records_per_page);

  if(isset($_GET['date'])){
    $id = Game::getIdForDate($db, $_GET['date']);
    header("Location: /Kegeln/game/game.php?id=$id");
  }

  $pumpKingAndGame = User::readPumpKingAndGame($db);
  $pumpKingUser = $pumpKingAndGame[0];
  $pumpKingGame = $pumpKingAndGame[1];

  $balance = Bill::readBalance($db);
  $balance = str_replace(".", ",", $balance);

?>

<!-- content for larger devices -->
<div class="d-none d-sm-block">

  <h2 class="my-2">Hallo <?php echo $username; ?>!</h2>

  <div class="row justify-content-center" style="padding-top:20px">
    <!-- Kopfbereich mit allen wichtigen Infos -->
    <h5>
      <table class="table">
        <thead class="thead-light">
          <tr>
            <th scope="col" colspan="2" class="text-center">Infos</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <th scope="row">Aktueller Pumpenkönig:</th>
            <td><?php echo $pumpKingUser->getUsername() . " (" . $pumpKingUser->getFirstname() . " " . $pumpKingUser->getLastname() . ")"; ?></td>
          </tr>
          <tr>
            <th scope="row">Pumpenrekord:</th>
            <td><?php echo $pumpKingGame->getAmount(); ?></td>
          </tr>
          <tr>
            <th scope="row">Kassenstand:</th>
            <td><?php echo $balance . " €"; ?></td>
          </tr>
          <tr>
            <th scope="row">Nächstes Treffen:</th>
            <td>
              <?php
                $game = Game::readLast($db);
                if(!$game->getNextGame()==NULL){
                  echo $game->getNextGame();
                } else {
                  echo "noch kein Spiel geplant";
                }
              ?>
            </td>
          </tr>
          <tr>
            <td colspan="2" class="text-center"></td>
          </tr>
        </tbody>
      </table>
    </h5>
  </div>
  <div class="row justify-content-center">
    <div class="col-sm">
      <h5>
        <table class="table">
          <thead class="thead-light">
            <tr>
              <th scope="col" colspan="2" class="text-center">Gebühren und Strafen</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <th scope="row">Monatsbeitrag:</th>
              <td>5 Euro</td>
            </tr>
            <tr>
              <th scope="row">Strafe Klingel:</th>
              <td>2 Euro</td>
            </tr>
            <tr>
              <th scope="row">Strafe Pumpenkönig:</th>
              <td>1 Euro</td>
            </tr>
            <tr>
              <th scope="row">Verlorene Runde:</th>
              <td>1 Euro</td>
            </tr>
            <tr>
              <th scope="row">Schnapszahl:</th>
              <td>1 Euro</td>
            </tr>
            <tr>
              <td colspan="2" class="text-center"></td>
            </tr>
          </tbody>
        </table>
      </h5>
    </div>
    <div class="col-sm-2 d-none d-md-block">
    </div>
    <div class="col-sm">
      <h5>
        <table class="table table-hover">
          <thead class="thead-light">
            <tr>
              <th scope="col" colspan="2" class="text-center">Bisherige Spiele</th>
            </tr>
          </thead>
          <tbody>

            <?php
            foreach ($games as $game) {
              $date = $game->getDate();
              $date = substr($date, 8, 2) . "." . substr($date, 5, 2) . "." . substr($date, 0, 4);
              ?>
              <tr>
                <td colspan="2" class="text-center"><a href="/Kegeln/membersarea.php?date=<?php echo $date ;?>"><?php echo $date ;?></a></td>
              </tr>
              <?php
            }
            ?>

          </tbody>
        </table>
      </h5>
    </div>
  </div>

</div>

<!-- content for mobile devices -->
<div class="d-sm-none px-2">
  <div class="row justify-content-center d-block">
    <h2 class="my-2">Hallo <?php echo $username; ?>!</h2>
      <table class="table">
        <thead class="thead-light">
          <tr>
            <th scope="col" colspan="2" class="text-center">Infos</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <th scope="row">Aktueller Pumpenkönig:</th>
            <td><?php echo $pumpKingUser->getUsername() . " (" . $pumpKingUser->getFirstname() . " " . $pumpKingUser->getLastname() . ")"; ?></td>
          </tr>
          <tr>
            <th scope="row">Pumpenrekord:</th>
            <td><?php echo $pumpKingGame->getAmount(); ?></td>
          </tr>
          <tr>
            <th scope="row">Kassenstand:</th>
            <td><?php echo $balance . " €"; ?></td>
          </tr>
          <tr>
            <th scope="row">Nächstes Treffen:</th>
            <td>
              <?php
                $game = Game::readLast($db);
                if(!$game->getNextGame()==NULL){
                  echo $game->getNextGame();
                } else {
                  echo "noch kein Spiel geplant";
                }
              ?>
            </td>
          </tr>
          <tr>
            <td colspan="2" class="text-center"></td>
          </tr>
        </tbody>
      </table>
    </h5>
  </div>
  <div class="row justify-content-center d-block">
    <h5>
      <table class="table">
        <thead class="thead-light">
          <tr>
            <th scope="col" colspan="2" class="text-center">Gebühren und Strafen</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <th scope="row">Monatsbeitrag:</th>
            <td>5 Euro</td>
          </tr>
          <tr>
            <th scope="row">Strafe Klingel:</th>
            <td>2 Euro</td>
          </tr>
          <tr>
            <th scope="row">Strafe Pumpenkönig:</th>
            <td>1 Euro</td>
          </tr>
          <tr>
            <th scope="row">Verlorene Runde:</th>
            <td>1 Euro</td>
          </tr>
          <tr>
            <th scope="row">Schnapszahl:</th>
            <td>1 Euro</td>
          </tr>
          <tr>
            <td colspan="2" class="text-center"></td>
          </tr>
        </tbody>
      </table>
    </h5>
  </div>
  <div class="row justify-content-center d-block">
    <h5>
      <table class="table">
        <thead class="thead-light">
          <tr>
            <th scope="col" colspan="2" class="text-center">Bisherige Spiele</th>
          </tr>
        </thead>
        <tbody>

          <?php
          foreach ($games as $game) {
            $date = $game->getDate();
            $date = substr($date, 8, 2) . "." . substr($date, 5, 2) . "." . substr($date, 0, 4);
            ?>
            <tr>
              <td colspan="2" class="text-center"><a href="/Kegeln/membersarea.php?date=<?php echo $date ;?>"><?php echo $date ;?></a></td>
            </tr>
            <?php
          }
          ?>

        </tbody>
      </table>
    </h5>
  </div>

</div>

<?php

// the page where this paging is used
$page_url = "membersarea.php?";

// count all products in the database to calculate total pages
$total_rows = Game::countAll($db);

// paging buttons here
include_once $_SERVER["DOCUMENT_ROOT"] . '/Kegeln/includes/paging.php';

include_once $_SERVER["DOCUMENT_ROOT"] . '/Kegeln/footer.php';
?>
