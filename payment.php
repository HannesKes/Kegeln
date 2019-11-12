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
  include_once $_SERVER["DOCUMENT_ROOT"] . '/Kegeln/objects/punishment.php';
  include_once $_SERVER["DOCUMENT_ROOT"] . '/Kegeln/includes/payment_inc.php';

  $activeUsers = User::readAll($db);
  $punishments = Punishment::readAll($db);

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
    <label class="font-weight-bold" for="date">Datum</label>
    <input id="date" class="form-control" type="date" name="date" value="<?php echo $date; ?>" />
  </div>

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
    <label class="font-weight-bold" for="punishment">Art der Strafe</label>
    <select id="punishment" class='form-control' name='punishment_id'>
      <?php
      foreach ($punishments as $punishment) {
        ?>
        <option value="<?php echo $punishment->getId(); ?>"><?php echo $punishment->getDescription() . " (" . $punishment->getAmount() . ")" ; ?></option>";
        <?php
      }
      ?>
    </select>
  </div>

  <input type="submit" name="submit" value="Speichern" class="btn btn-info" /><br/>

</form>

<?php
include_once $_SERVER["DOCUMENT_ROOT"] . '/Kegeln/footer.php';
?>
