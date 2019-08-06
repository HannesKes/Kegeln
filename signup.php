<?php
include_once $_SERVER["DOCUMENT_ROOT"] . '/Hopfenspeicher/extras/session.php';
  $page_title = "Registrieren";

  //You may not be on this page when you are logged in.
  //Redirect to profile page
  $redirect_when_loggedin = true;
  $redirect_when_loggedout = false;
  $redirect_page = 'profile.php';

  include_once $_SERVER["DOCUMENT_ROOT"] . '/Kegeln/header.php';
  include_once $_SERVER["DOCUMENT_ROOT"] . '/Kegeln/includes/signup_inc.php';

  if (isset($_POST['submit'])) {
    try {
      signupUser();
    } catch (Exception $e) { ?>
      <div class="alert alert-danger alert-dismissible">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <strong>Fehler!</strong> <?php echo $e->getMessage(); ?>
      </div>
    <?php
    }
  }
?>

<main role="main" class="container">



</main>

<?php
include_once $_SERVER["DOCUMENT_ROOT"] . '/Kegeln/footer.php';
?>
