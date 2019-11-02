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


<ul class="list-group">

<?php

foreach($users as $user)
{

  ?>
  <!-- <div class="justify-content-center"> -->

    <!-- <table class="table table-bordered">
      <tr>
        <td colspan="2"><?php //echo $user->getUsername(); ?></td>
        <td>
          <form action="" method="post">
            <input type="hidden" name="user_id" value="<?php //echo $user->getId(); ?>">
            <input type="submit" name="accept" class="float-right btn btn-success" value="Annehmen">
          </form>
        </td>
      </tr>
      <tr>
        <td><?php //echo $user->getFirstname(); ?></td>
        <td><?php //echo $user->getLastname(); ?></td>
        <td>
          <form action="" method="post">
            <input type="hidden" name="user_id" value="<?php //echo $user->getId(); ?>">
            <input type="submit" name="delete" class="float-right btn btn-danger" value="Ablehnen">
          </form>
        </td>
      </tr>
    <table> -->

  <!-- </div> -->


  <li class="list-group-item">
    <form action="" method="post">
      <div class="row">
        <div class="col-7">
          <?php echo "<b>" . $user->getFirstname() . " " . $user->getLastname() . "</b> (" . $user->getUsername() . ")"; ?><br/>
          <?php echo $user->getEmail(); ?>
        </div>
        <div class="col-5">
          <input type="hidden" name="user_id" value="<?php echo $user->getId(); ?>">
          <!-- <input type="submit" name="delete" class="float-right btn btn-danger" value="Ablehnen">
          <input type="submit" name="accept" class="float-right btn btn-success" value="Annehmen"> -->
          <button class="btn float-right"><span class="fas fa-hand-middle-finger fa-2x" style="color: red; size: 9x"></span></button>
          <button class="btn float-right"><span class="fa fa-check-circle fa-2x" style="color: green; size: 9x"></span></button>
        </div>
      </div>
    </form>
    <!-- <button class="btn pull-right">
      <span class="fa fa-search-plus"></span>
    </button> -->
  </li>

  <?php
  }
  ?>

</ul>

<?php
include_once $_SERVER["DOCUMENT_ROOT"] . '/Kegeln/footer.php';
?>
