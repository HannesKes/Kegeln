<?php
include_once $_SERVER["DOCUMENT_ROOT"] . '/Kegeln/objects/session.php';
  $page_title = "Interner Bereich";

  //You may always be on this page.
  //Redirect to profile page
  $redirect_when_loggedin = false;
  $redirect_when_loggedout = false;
  $redirect_when_new = false;
  $redirect_when_no_admin = false;
  $redirect_page = 'index.php';

  include_once $_SERVER["DOCUMENT_ROOT"] . '/Kegeln/header.php';
?>

<main role="main" class="container">

  <?php
  if (!$loggedin) {
    header("Location: /Kegeln/login.php");
  } elseif ($isNew) {
  ?>
    <div class="alert alert-danger mt-5">
      Du musst leider noch warten, bis dich ein autorisierter Nutzer akzptiert hat.
    </div>
  <?php
  } else {
    header("Location: membersarea.php");
  }
  ?>

</main>

<?php
include_once $_SERVER["DOCUMENT_ROOT"] . '/Kegeln/footer.php';
?>
