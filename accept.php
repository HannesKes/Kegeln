<?php
include_once $_SERVER["DOCUMENT_ROOT"] . '/Kegeln/objects/session.php';
  $page_title = "Neue Nutzer";

  //You may not be on this page when you are logged out.
  //Redirect to profile page
  $redirect_when_loggedin = false;
  $redirect_when_loggedout = true;
  $redirect_page = 'index.php';

  include_once $_SERVER["DOCUMENT_ROOT"] . '/Kegeln/header.php';

  if($isNew){
    header("Location: /Kegeln/index.php?errorcode=3");
  }

  $users = User::readNew($db);

  if(empty($users)){
    header("Location: /Kegeln/index.php?errorcode=4");
  }

?>

<main role="main" class="container w-50">

  <?php

  foreach($users as $user)
  {

    ?>
    <div class="table-responsive justify-content-center">
      <table class="table">
        <tr>
          <td colspan="2"><?php echo $user->getUsername(); ?></td>
          <td>
            <form action="" method="post">
              <input type="hidden" name="user_id" value="<?php echo $user->getId(); ?>">
              <input type="submit" name="accept" class="float-right btn btn-secondary" value="Annehmen">
            </form>
          </td>
        </tr>
        <tr>
          <td><?php echo $user->getFirstname(); ?></td>
          <td><?php echo $user->getLastname(); ?></td>
          <td>
            <form action="" method="post">
              <input type="hidden" name="user_id" value="<?php echo $user->getId(); ?>">
              <input type="submit" name="delete" class="float-right btn btn-secondary" value="Ablehnen">
            </form>
          </td>
        </tr>
      <table>
      </div>
    <br/>

  <?php

  }

  ?>

</main>

<?php
include_once $_SERVER["DOCUMENT_ROOT"] . '/Kegeln/footer.php';
?>
