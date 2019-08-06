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
      //TODO: Meldung: Registierung erfolgreich. Warten auf Bestätigung durch authorisierte Personen.
    // login user
    $user_ID = $user->getId();
    $_SESSION['session_id'] = $user_ID;
    header("Location: ../index.php");
    exit();
  } else {
    throw new Exception('Die Registrierung war leider nicht erfolgreich. Bitte probiere es erneut.');
  }
}
?>
