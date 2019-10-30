<?php
include_once $_SERVER["DOCUMENT_ROOT"] . '/Kegeln/objects/session.php';
include_once $_SERVER["DOCUMENT_ROOT"] . '/Kegeln/objects/game.php';
include_once $_SERVER["DOCUMENT_ROOT"] . '/Kegeln/objects/bill.php';
  $page_title = "Übersicht";

  //You may not be on this page when your are logged out or new.
  //Redirect to index page
  $redirect_when_loggedin = false;
  $redirect_when_loggedout = true;
  $redirect_when_new = true;
  $redirect_when_no_admin = false;
  $redirect_page = 'index.php';

  include_once $_SERVER["DOCUMENT_ROOT"] . '/Kegeln/header.php';

  $games = Game::readAll($db);

  if(isset($_GET['date'])){
    $id = Game::getIdForDate($db, $_GET['date']);
    header("Location: /Kegeln/spiel.php?id=$id");
  }

  $pumpKingAndGame = User::readPumpKingAndGame($db);
  $pumpKingUser = $pumpKingAndGame[0];
  $pumpKingGame = $pumpKingAndGame[1];

  $balance = Bill::readBalance($db);

?>

<!-- content for larger devices -->
<div class="d-none d-sm-block">

  <div class="justify-content-left" style="padding-top:30px">
    <h4>Hallo Bierpumpe! <!-- User aus DB ziehen --></h4>
  </div>

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
            <td class="pull-right"><?php echo $pumpKingUser->getUsername() . " (" . $pumpKingUser->getFirstname() . " " . $pumpKingUser->getLastname() . ")"; ?></td>
          </tr>
          <tr>
            <th scope="row">Pumpenrekord:</th>
            <td class="pull-right"><?php echo $pumpKingGame->getAmount(); ?></td>
          </tr>
          <tr>
            <th scope="row">Kassenstand:</th>
            <td class="pull-right"><?php echo $balance; ?></td>
          </tr>
          <tr>
            <th scope="row">Nächstes Treffen:</th>
            <td class="pull-right">
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
              <td>5 Geld</td>
            </tr>
            <tr>
              <th scope="row">Strafe Klingel:</th>
              <td>1 Geld</td>
            </tr>
            <tr>
              <th scope="row">Strafe Pumpenkönig:</th>
              <td>1 Geld</td>
            </tr>
            <tr>
              <th scope="row">Verlorene Runde:</th>
              <td>10 Kleingeld</td>
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
        <table class="table">
          <thead class="thead-light">
            <tr>
              <th scope="col" colspan="2" class="text-center">Termine</th>
            </tr>
          </thead>
          <tbody>

            <?php
            foreach ($games as $game) {
              $date = $game->getDate();
              $date = substr($date, 8, 2) . "." . substr($date, 5, 2) . "." . substr($date, 0, 4)
              ?>
              <tr>
                <td colspan="2" class="text-center"><a href="membersarea.php?date=<?php echo $date ;?>"><?php echo $date ;?></a></td>
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
  <div class="row justify-content-center d-block" style="padding-top:30px">
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
            <td><!-- Names aus DB ziehen (Pumpenkönig-Feld des letzten Treffens auf true) --></td>
          </tr>
          <tr>
            <th scope="row">Pumpenrekord:</th>
            <td><!-- Namen mit den meisten geworfenen Pumpen aus der DB ziehen --></td>
          </tr>
          <tr>
            <th scope="row">Kassenstand:</th>
            <td><!-- Alle Saldi zusammen rechnen? Geht das irgendwie mit den Tabellen? --></td>
          </tr>
          <tr>
            <th scope="row">Nächstes Treffen:</th>
            <td>25.08.2019</td>
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
            <td>5 Geld</td>
          </tr>
          <tr>
            <th scope="row">Strafe Klingel:</th>
            <td>1 Geld</td>
          </tr>
          <tr>
            <th scope="row">Strafe Pumpenkönig:</th>
            <td>1 Geld</td>
          </tr>
          <tr>
            <th scope="row">Verlorene Runde:</th>
            <td>10 Kleingeld</td>
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
            <th scope="col" colspan="2" class="text-center">Termine</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td colspan="2" class="text-center"><a href="#">Neuestes Treffen</a></td>
          </tr>
          <tr>
            <td colspan="2" class="text-center"><a href="#">Treffen</a></td>
          </tr>
          <tr>
            <td colspan="2" class="text-center"><a href="#">Treffen</a></td>
          </tr>
          <tr>
            <td colspan="2" class="text-center"></td>
          </tr>
        </tbody>
      </table>
    </h5>
  </div>

</div>

<?php

include_once $_SERVER["DOCUMENT_ROOT"] . '/Kegeln/footer.php';
?>
