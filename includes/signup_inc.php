<?php
include_once $_SERVER["DOCUMENT_ROOT"] . '/Kegeln/database/db.php';
include_once $_SERVER["DOCUMENT_ROOT"] . '/Kegeln/objects/user.php';

function signupUser() {

  $database = new Database();
  $db = $database->getConnection();

  $user = new User($db);

  //Set attributes of the new user object
  $user->setFirstname($_POST['firstname']);
  $user->setLastname($_POST['lastname']);
  $user->setEmail($_POST['email']);
  $user->setIsNew('1');

  //calls isUsernameValid function. This throws an Exception when the Username for some reason isn't valid.
  User::isUsernameValid($db, $_POST['username']);
  $user->setUsername($_POST['username']);

  //Encode Password for safer handling
  $password = password_hash($_POST['password'],PASSWORD_DEFAULT);
  $user->setpassword($password);

  if ($user->create()) {
    //registration successful message

    // login user
    $user_ID = $user->getId();
    $_SESSION['session_id'] = $user_ID;
    // TODO: diese Meldung muss noch woanders eingebaut werden
    ?> <div class="alert alert-success alert-dismissible">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
    <strong>Erfolg!</strong> Registrierung erfolgreich. Warten auf Bestätigung durch autorisierte Person.
    </div> <?php
    header("Location: /Kegeln/index.php");
    exit();
  } else {
    throw new Exception('Die Registrierung war leider nicht erfolgreich. Bitte probiere es erneut.');
  }
}
?>
