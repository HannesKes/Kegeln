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

  if(isset($_POST["accept"])){
    User::accept($db, $_POST["user_id"]);
  } elseif(isset($_POST["delete"])){
    User::delete($db, $_POST["user_id"]);
  }

  $users = User::readNew($db);

  if(empty($users)){
    header("Location: /Kegeln/index.php?errorcode=4");
  }

?>

<main role="main" class="container w-50">

<div class="table-responsive table-bordered">
  <table class="table">
    <tr>
      <td>John</td>
      <td>Doe</td>
      <td>john@example.com</td>
    <tr>
    <tr>
      <td>Mary</td>
      <td>Moe</td>
      <td>mary@example.com</td>
    </tr>
    <tr>
      <td>July</td>
      <td>Dooley</td>
      <td>july@example.com</td>
    </tr>
  <table>
</div>





  <br/>
  <center><h1>Neu registrierte Nutzer</h1></center>
  <br/><br/>

  <?php

  foreach($users as $user)
  {

    ?>
    <div class="justify-content-center">
      <table class="table table-responsive table-bordered">
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
    </div>

  <?php

  }

  ?>

</main>

<?php
include_once $_SERVER["DOCUMENT_ROOT"] . '/Kegeln/footer.php';
?>
