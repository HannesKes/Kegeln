<?php
include_once $_SERVER["DOCUMENT_ROOT"] . '/Kegeln/objects/session.php';
  $page_title = "Bierpumpen";

  //You may not be on this pag when logged out.
  //Redirect to index page
  $redirect_when_loggedin = false;
  $redirect_when_loggedout = true;
  $redirect_page = 'index.php';

  include_once $_SERVER["DOCUMENT_ROOT"] . '/Kegeln/header.php';
  include_once $_SERVER["DOCUMENT_ROOT"] . '/Kegeln/includes/insert_inc.php';

  if($isNew){
    header("Location: /Kegeln/index.php?errorcode=3");
  }

  $allUsers = User::readAll($db);

  date_default_timezone_set("Europe/Berlin");
  $date = date("Y-m-d");

  if (isset($_POST['submit'])){
    insertGame();
  }

?>

<center><h2>Erfassen des aktuellen Spiels</h2></center><br/>

<form method="post">

  Datum:*
  <input class="ml-2 pl-1" type="date" name="date" value="<?php echo $date; ?>" /><br/><br/>

  Anwesend:* TODO: hier noch Tabelle einfügen <!-- Tabelle --> <br/><br/>


  <div class="row">
    Pumpenkönig:*
    <select class='form-control w-50 ml-2 pl-1' name='user_id'>
      <?php
      foreach ($allUsers as $user) { ?>
        <option value="<?php echo $user->getId(); ?>"><?php echo $user->getUsername() . " (" . $user->getFirstname() . " " . $user->getLastname() . ")" ; ?></option>";
      <?php
      }
      ?>
    </select>
  </div><br/><br/>

  Anzahl Pumpen:*
  <input class="pl-2" type="number" class="ml-2" name="number" value="0" min="0" /><br/><br/>

  Nächstes Spiel: (TODO: Feld muss später komplett leer sein)
  <input class="ml-2 pl-1" type="date" name="nextGame" /><br/><br/>

  <!-- Button -->
  <input type="submit" name="submit" value="Speichern" class="btn btn-info" /><br/>

</form>

<?php
include_once $_SERVER["DOCUMENT_ROOT"] . '/Kegeln/footer.php';
?>
