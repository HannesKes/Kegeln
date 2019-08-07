<?php
include_once $_SERVER["DOCUMENT_ROOT"] . '/Kegeln/objects/session.php';
  $page_title = "Kontakt";

  //You may always be on this page.
  //Redirect to profile page
  $redirect_when_loggedin = false;
  $redirect_when_loggedout = false;
  $redirect_page = 'index.php';

  include_once $_SERVER["DOCUMENT_ROOT"] . '/Kegeln/header.php';
?>

<main role="main" class="container">

  <?php
  if (!$loggedin){
    header("Location: login.php");
    exit();
  } elseif ($isNew){
  ?>
    <div class="alert alert-danger mt-5">
      Du musst leider noch warten, bis dich ein autorisierter Nutzer akzptiert hat.
    </div>
  <?php
  } else {
    echo "Hier ensteht der interne Bereich.";
  }
  ?>

</main>

<?php
include_once $_SERVER["DOCUMENT_ROOT"] . '/Kegeln/footer.php';
?>
