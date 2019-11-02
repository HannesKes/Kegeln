<?php
include_once $_SERVER["DOCUMENT_ROOT"] . '/Kegeln/objects/session.php';
  $page_title = "Neue Nutzer";

  //You may not be on this page when you are logged out or new or no admin.
  //Redirect to profile page
  $redirect_when_loggedin = false;
  $redirect_when_loggedout = true;
  $redirect_when_new = true;
  $redirect_when_no_admin = true;
  $redirect_page = '/Kegeln/index.php';

  include_once $_SERVER["DOCUMENT_ROOT"] . '/Kegeln/header.php';

  if(empty($users)){
    header("Location: /Kegeln/index.php?errorcode=5");
    exit();
  }

?>

<center><h1>Neu registrierte Nutzer</h1></center>
<br/><br/>

<?php

foreach($users as $user)
{

  ?>
  <!-- <div class="justify-content-center"> -->
    <table class="table table-bordered">
      <tr>
        <td colspan="2"><?php echo $user->getUsername(); ?></td>
        <td>
          <form action="" method="post">
            <input type="hidden" name="user_id" value="<?php echo $user->getId(); ?>">
            <input type="submit" name="accept" class="float-right btn btn-success" value="Annehmen">
          </form>
        </td>
      </tr>
      <tr>
        <td><?php echo $user->getFirstname(); ?></td>
        <td><?php echo $user->getLastname(); ?></td>
        <td>
          <form action="" method="post">
            <input type="hidden" name="user_id" value="<?php echo $user->getId(); ?>">
            <input type="submit" name="delete" class="float-right btn btn-danger" value="Ablehnen">
          </form>
        </td>
      </tr>
    <table>
  <!-- </div> -->

  <?php

  }

include_once $_SERVER["DOCUMENT_ROOT"] . '/Kegeln/footer.php';
?>
