<?php
include_once $_SERVER["DOCUMENT_ROOT"] . '/Kegeln/includes/session.php';
include_once $_SERVER["DOCUMENT_ROOT"] . '/Kegeln/objects/payment.php';

  //You may not be on this page when you are logged in.
  //Redirect to profile page
  $redirect_when_loggedin = false;
  $redirect_when_loggedout = true;
  $redirect_when_new = false;
  $redirect_when_no_admin = false;
  $redirect_page = '/Kegeln/index.php';

  if ($_GET['id'] == $_SESSION['session_id']) {
    $redirect_when_other_profile = false;
  } else {
    $redirect_when_other_profile = true;
  }

  include_once $_SERVER["DOCUMENT_ROOT"] . '/Kegeln/includes/profile_inc.php';
  $page_title = $profileUser->getUsername() . "'s Profil";

  include_once $_SERVER["DOCUMENT_ROOT"] . '/Kegeln/header.php';

  if (isset($_POST['save'])) {
    try {
      updateUser($db, $profileUser);
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

<div class="container">

  <?php
    // The layout for the profile page when the page is in view mode
    if ($edit == false) {?>
    <div class="row">
      <div class="mr-auto ml-2">
        <h1><?php echo $username ?>'s Benutzerprofil</h1>
      </div>
        <form action="" method="POST">
          <input type="submit" name="edit" class="btn btn-primary mt-2" value="Profil Bierarbeiten">
        </form>
    </div>
    <br/>

    <?php
      if ($isNew) {
        ?>
          <b>Status der Registrierung:</b> Warten auf Antwort des Admins<br/>
        <?php
      }
     ?>

    <br/>

    <div class="row">
      <!--The profile picture of the user-->
      <div class="col-4">
        <img src="/Kegeln/media/user_empty.png" alt="Profilbild" class="img-fluid"/>
      </div>
      <!--Personal information about the user-->
      <div class="col-4">
        <h3 align="left">Benutzername</h3>
        <?php echo $username ?><br/><br/>
        <h3 align="left">Vorname</h3>
        <?php echo $firstname ?><br/><br/>
        <h3 align="left">Nachname</h3>
        <?php echo $lastname ?><br/><br/>
        <h3 align="left">E-Mail</h3>
        <?php echo $email ?>
      </div>
    </div>

    <?php
    //Profile page when the site is in edit mode
    } else { ?>
    <form class="userInformation" action="" method="POST" enctype="multipart/form-data">
    <div class="row">
      <div class="col-8">
        <h1><?php echo $username ?>'s Benutzerprofil</h1>
      </div>
      <!-- Button to save changes made to the profile and exit edit mode.-->
      <div class="ml-auto">
        <input type="submit" name="save" class="btn btn-success mt-2" value="Speichern">
      </div>
    </div>
    <br/>
      <div class="row">
        <div class="col-4">
          <div class="row">
            <div class="col">
              <img src="/Kegeln/media/user_empty.png" class="img-fluid"/>
            </div>
          </div>
        </div>
        <!-- Listing of all user information. New values can be entered which will be used to update the profile.-->
        <div class="col-7">
          <h3 align="left" hspace="500">Biernutzername</h3>
          <input type="text" name="username" class="form-control" size="25" value="<?php echo $username ?>"/>
          <h3 align="left" class="mt-3" >Vorname</h3>
          <?php echo $firstname ?><br/>
          <h3 align="left" class="mt-3">Nachname</h3>
          <?php echo $lastname ?><br/>
          <h3 align="left" class="mt-3">E-Mail</h3>
          <input type="text" name="email" class="form-control" size="25" value="<?php echo $email ?>"/>
        </div>
      </div>
    </form>
    <?php
    }

    $open_bills_user = Bill::getOpenBillsByUser($db, $userid);
    $all_games = Game::getGamesByUser($db, $userid);
    $all_bills = Bill:: getAllBillsByUser($db, $userid);
    $sum_bills = Bill::getSumByUser($db, $userid);
    ?>
    <br/>
    <br/>

    <!-- content for larger devices -->
    <div class="d-none d-sm-block">
      <div class="row">
        <div class="col-4">

          <?php include $_SERVER["DOCUMENT_ROOT"] . '/Kegeln/user/ausgelagert/openbills.php'; ?>

        </div>
        <div class="col-4">

          <?php include $_SERVER["DOCUMENT_ROOT"] . '/Kegeln/user/ausgelagert/allgames.php'; ?>

        </div>
        <div class="col-4">

          <?php include $_SERVER["DOCUMENT_ROOT"] . '/Kegeln/user/ausgelagert/allbills.php'; ?>

        </div>
      </div>
    </div>

    <!-- content for mobile devices -->
    <div class="d-sm-none px-2">
      <hr/>
      <?php include $_SERVER["DOCUMENT_ROOT"] . '/Kegeln/user/ausgelagert/openbills.php'; ?>
      <hr/>
      <?php include $_SERVER["DOCUMENT_ROOT"] . '/Kegeln/user/ausgelagert/allgames.php'; ?>
      <hr/>
      <?php include $_SERVER["DOCUMENT_ROOT"] . '/Kegeln/user/ausgelagert/allbills.php'; ?>
    </div>

</div>

<?php
include_once $_SERVER["DOCUMENT_ROOT"] . '/Kegeln/footer.php';
?>
