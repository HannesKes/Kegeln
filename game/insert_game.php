<?php
include_once $_SERVER["DOCUMENT_ROOT"] . '/Kegeln/objects/session.php';
  $page_title = "Neues Spiel";

  //You may not be on this page when you are logged out or no admin.
  //Redirect to index page
  $redirect_when_loggedin = false;
  $redirect_when_loggedout = true;
  $redirect_when_new = false;
  $redirect_when_no_admin = true;
  $redirect_page = '/Kegeln/index.php';

  include_once $_SERVER["DOCUMENT_ROOT"] . '/Kegeln/header.php';
  include_once $_SERVER["DOCUMENT_ROOT"] . '/Kegeln/includes/insert_inc.php';

  if($isNew){
    header("Location: /Kegeln/index.php?errorcode=3");
  }

  $activeUsers = User::readAll($db);

  date_default_timezone_set("Europe/Berlin");
  $date = date("Y-m-d");

  if (isset($_POST['submit'])){
    try {
      insertGame();
    } catch (Exception $e) { ?>
      <br/>
      <div class="alert alert-danger alert-dismissible">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <strong>Fehler!</strong> <?php echo $e->getMessage(); ?>
      </div>
    <?php
    }
  }

?>

<center><h2>Erfassen des aktuellen Spiels</h2></center><br/>

<form method="post">
  <div class="form-group">
    <label class="font-weight-bold" for="date">Datum</label>
    <input id="date" class="form-control" type="date" name="date" value="<?php echo $date; ?>" />
  </div>

  <div class="form-group">
    <label class="font-weight-bold" for="pumpKing">Pumpenkönig</label>
    <select class='form-control' name='user_id'>
      <?php
      foreach ($activeUsers as $user) {
        ?>
        <option value="<?php echo $user->getId(); ?>"><?php echo $user->getUsername() . " (" . $user->getFirstname() . " " . $user->getLastname() . ")" ; ?></option>";
        <?php
      }
      ?>
    </select>
  </div>

  <div class="form-group mb-4">
    <label class="font-weight-bold" for="amount">Anzahl Pumpen</label>
    <input class="form-control" type="number" name="number" value="0" min="0" max="100" />
  </div>

  <table class="table table-striped table-bordered">
    <thead>
      <tr>
        <th class="font-weight-bold" scope="col"><u>Spieler</u></th>
        <th class="font-weight-bold text-center" scope="col">Anwesend</th>
        <th class="font-weight-bold text-center" scope="col">Beitrag</th>
        <th class="font-weight-bold text-center" scope="col">Pumpen</th>
      </tr>
    </thead>
    <tbody>
      <?php
      foreach ($activeUsers as $user) {
        ?>
        <tr>
          <th class="align-middle" scope="row"><?php echo $user->getUsername(); ?></th>
          <td class="align-middle">
            <div class="custom-control custom-checkbox text-center">
              <input id="present<?php echo $user->getId(); ?>" type="checkbox" class="custom-control-input" name="present<?php echo $user->getId(); ?>" value="0">
              <label class="custom-control-label" for="present<?php echo $user->getId(); ?>"></label>
            </div>
          </td>
          <td class="align-middle">
            <div class="custom-control custom-checkbox text-center">
              <input id="paid<?php echo $user->getId(); ?>" type="checkbox" class="custom-control-input" name="paid<?php echo $user->getId(); ?>" value="0">
              <label class="custom-control-label" for="paid<?php echo $user->getId(); ?>"></label>
            </div>
          </td>
          <td>
            <input type="number" class="form-control" name="pumps<?php echo $user->getId(); ?>" value="0" min="0" max="100">
          </td>
        </tr>
        <?php
      }
      ?>
    </tbody>
  </table>

  <div class="form-group">
    <label class="font-weight-bold" for="nextGame">Nächstes Spiel</label>
    <input id="nextGame" class="form-control w-50" type="date" value="0001-01-01" name="nextGame" />
  </div>

  <input type="submit" name="submit" value="Speichern" class="btn btn-info" /><br/>

</form>

<?php
include_once $_SERVER["DOCUMENT_ROOT"] . '/Kegeln/footer.php';
?>
