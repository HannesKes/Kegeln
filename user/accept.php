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

  if(isset($_POST["accept"])){
    echo "Annehmen";
    User::accept($db, $_POST["user_id"]);
    $users = User::readNew($db);
  } elseif(isset($_POST["delete"])){
    echo "Ablehnen";
    User::delete($db, $_POST["user_id"]);
    $users = User::readNew($db);
  }
  if(empty($users)){
    header("Location: /Kegeln/index.php?message=4");
  }

  if(empty($users)){
    header("Location: /Kegeln/index.php?errorcode=5");
    exit();
  }

?>

<center><h1 class="my-2">Neu registrierte Nutzer</h1></center>
<br/>


<ul class="list-group">

<?php

foreach($users as $user)
{

  ?>

  <li class="list-group-item">
    <div class="row">
      <div class="col-7">
        <?php echo "<b>" . $user->getFirstname() . " " . $user->getLastname() . "</b> (" . $user->getUsername() . ")"; ?><br/>
        <?php echo $user->getEmail(); ?>
      </div>
      <div class="col-5">
        <form action="" method="POST">
          <input type="hidden" name="user_id" value="<?php echo $user->getId(); ?>">
          <button type="submit" name="delete" class="btn float-right px-2 fa fa-hand-middle-finger fa-2x" value="" style="color: red; size: 9x"></button>
        </form>
        <form action="" method="POST">
          <input type="hidden" name="user_id" value="<?php echo $user->getId(); ?>">
          <button type="submit" name="accept" class="btn float-right px-2 mr-2 fa fa-check-circle fa-2x" style="color: green; size: 9x"></button>
        </form>
      </div>
    </div>
  </li>

  <?php
  }
  ?>

</ul>

<?php
include_once $_SERVER["DOCUMENT_ROOT"] . '/Kegeln/footer.php';
?>
