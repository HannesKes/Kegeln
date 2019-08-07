<?php
include_once $_SERVER["DOCUMENT_ROOT"] . '/Kegeln/objects/session.php';
  $page_title = "Bierpumpen";

  //You may always be on this page.
  //Redirect to profile page
  $redirect_when_loggedin = false;
  $redirect_when_loggedout = false;
  $redirect_page = 'index.php';

  include_once $_SERVER["DOCUMENT_ROOT"] . '/Kegeln/header.php';
?>

<main role="main" class="container d-none d-sm-block"> <!-- content for larger devices -->

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


</main>

<main role="main" class="container d-sm-none"> <!-- content for mobile devices -->
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

</main>

<?php
include_once $_SERVER["DOCUMENT_ROOT"] . '/Kegeln/footer.php';
?>
