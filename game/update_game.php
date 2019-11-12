<?php
include_once $_SERVER["DOCUMENT_ROOT"] . '/Kegeln/objects/session.php';
  $page_title = "Nächstes Spiel festlegen";

  //You may not be on this pag when logged out.
  //Redirect to index page
  $redirect_when_loggedin = false;
  $redirect_when_loggedout = true;
  $redirect_when_new = false;
  $redirect_when_no_admin = true;
  $redirect_page = '/Kegeln/index.php';

  include_once $_SERVER["DOCUMENT_ROOT"] . '/Kegeln/header.php';

  if (isset($_POST['submit'])){
    Game::addDate($db, $_POST['date']);
    header("Location: /Kegeln/index.php?message=5");
    exit();
  }

  date_default_timezone_set("Europe/Berlin");
  $date = date("Y-m-d");

?>

<!-- <center><h2>Datum des nächsten Spiels erfassen</h2></center><br/><br/><br/> -->

<form method="post">

  <div class="row">
    <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
      <div class="card card-signin my-5">
        <div class="card-body">
          <h5 class="card-title text-center">Datum des nächsten Spiels</h5>
          <hr class="my-4">
          <form method="POST" role="form">
            <div class="form-label-group">
              <input type="date" id="date" name="date" value="<?php echo $date; ?>" class="form-control">
              <label for="date">Datum</label>
            </div>
            <hr class="my-4">
            <button class="btn btn-lg btn-primary btn-block text-uppercase" type="submit" name="submit">Speichern</button>
          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- <div class="form-group mx-auto">
    <label class="font-weight-bold" for="date">Datum</label>
    <input class="form-control w-25" type="date" name="date" value="<?php echo $date; ?>" /><br/><br/><br/>
  </div>

  <center><input type="submit" name="submit" value="Speichern" class="btn btn-info" /><br/></center> -->

</form>

<?php
include_once $_SERVER["DOCUMENT_ROOT"] . '/Kegeln/footer.php';
?>
