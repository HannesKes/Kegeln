<?php
include_once $_SERVER["DOCUMENT_ROOT"] . '/Kegeln/objects/session.php';
  $page_title = "Bierpumpen";

  //You may not be on this pag when logged out.
  //Redirect to index page
  $redirect_when_loggedin = false;
  $redirect_when_loggedout = true;
  $redirect_page = 'index.php';

  include_once $_SERVER["DOCUMENT_ROOT"] . '/Kegeln/header.php';

  if($isNew){
    header("Location: /Kegeln/index.php?errorcode=3");
  }

  if (isset($_POST['submit'])){
    Game::addDate($db, $_POST['date']);
  }

  date_default_timezone_set("Europe/Berlin");
  $date = date("Y-m-d");

?>

<center><h2>Datum des nächsten Spiels erfassen</h2></center><br/><br/><br/>

<form method="post">

<div class="row justify-content-center">
  Datum:
  <input class="ml-2 pl-1 form-control w-25" type="date" name="date" value="<?php echo $date; ?>" /><br/><br/><br/>
</div>

  <!-- Button -->
  <center><input type="submit" name="submit" value="Speichern" class="btn btn-info" /><br/></center>

</form>

<?php
include_once $_SERVER["DOCUMENT_ROOT"] . '/Kegeln/footer.php';
?>
