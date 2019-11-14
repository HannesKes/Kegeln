<?php
include_once $_SERVER["DOCUMENT_ROOT"] . '/Kegeln/objects/session.php';
  $page_title = "Strafe erfassen";

  //You may not be on this page when you are logged out or no admin.
  //Redirect to index page
  $redirect_when_loggedin = false;
  $redirect_when_loggedout = true;
  $redirect_when_new = false;
  $redirect_when_no_admin = true;
  $redirect_page = '/Kegeln/index.php';

  include_once $_SERVER["DOCUMENT_ROOT"] . '/Kegeln/header.php';
  include_once $_SERVER["DOCUMENT_ROOT"] . '/Kegeln/objects/payment.php';
  include_once $_SERVER["DOCUMENT_ROOT"] . '/Kegeln/includes/payment_inc.php';

  $games = Game::readAll($db);
  $activeUsers = User::readAll($db);
  $payments = Payment::readAll($db);

  date_default_timezone_set("Europe/Berlin");
  $date = date("Y-m-d");

  if (isset($_POST['submit'])){
    try {
      insertPayment();
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

<center><h2>Strafe erfassen</h2></center><br/>

<form method="post">

  <div class="form-group">
    <label class="font-weight-bold" for="user">Spiel</label>
    <select id="game" class='form-control' name='game_id'>
      <?php
      foreach ($games as $game) {
        $date = $game->getDate();
        $date = substr($date, 8, 2) . "." . substr($date, 5, 2) . "." . substr($date, 0, 4);
        ?>
        <option value="<?php echo $game->getId(); ?>"><?php echo $date; ?></option>";
        <?php
      }
      ?>
    </select>
  </div>

  <!-- <div class="form-group">
    <label class="font-weight-bold" for="date">Datum</label>
    <input id="date" class="form-control" type="date" name="date" value="<?php echo $date; ?>" />
  </div> -->

  <div class="form-group">
    <label class="font-weight-bold" for="user">Nutzer</label>
    <select id="user" class='form-control' name='user_id'>
      <?php
      foreach ($activeUsers as $user) {
        ?>
        <option value="<?php echo $user->getId(); ?>"><?php echo $user->getUsername() . " (" . $user->getFirstname() . " " . $user->getLastname() . ")" ; ?></option>";
        <?php
      }
      ?>
    </select>
  </div>

  <div class="form-group">
    <label class="font-weight-bold" for="payment">Art der Strafe</label>
    <select id="payment" class='form-control' name='payment_id'>
      <?php
      foreach ($payments as $payment) {
        if (!($payment->getId() == 1 || $payment->getId() == 2)) {
          ?>
          <option value="<?php echo $payment->getId(); ?>"><?php echo $payment->getDescription() . " (" . $payment->getAmount() . ")" ; ?></option>";
          <?php
        }
      }
      ?>
    </select>
  </div>

  <input type="submit" name="submit" value="Speichern" class="btn btn-info" /><br/>

</form>

<?php
include_once $_SERVER["DOCUMENT_ROOT"] . '/Kegeln/footer.php';
?>
