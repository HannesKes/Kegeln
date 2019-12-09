<?php
include_once $_SERVER["DOCUMENT_ROOT"] . '/Kegeln/objects/user.php';

// The function updatePassword checks if the given values are correct and sets the new password
function updatePassword($db){
  $user = new User($db);

  $user_id = $_POST['user_id'];
  $password = $_POST['password'];

  // Calls isPasswordValid function. This throws an Exception when the password for some reason isn't valid.
  // User::isPasswordValid($password); TODO: brauch ich das auch?

  $user->setId($user_id);
  // Gets an user object for the current user
  if ($user->readOne($user_id)) {
    // checks if the given password is correct
    $rightPassword = password_verify($password, $user->getpassword());
    if ($rightPassword == false) {
      throw new Exception('Passwort inkorrekt.');
    }

    // Both new passwords need to be the same
    $newPassword1 = $_POST['newPassword'];
    $newPassword2 = $_POST['newPassword2'];
    if($newPassword1 !== $newPassword2){
      throw new Exception('Die neuen Passwörter müssen identisch sein.');
    }

    if ($newPassword1 == $password) {
      throw new Exception('Ihr neues Passwort sollte nicht das gleich wie das alte Passwort sein.');
    }

    // Encode new password
    $password = password_hash($newPassword1,PASSWORD_DEFAULT);
    // Sets the new password and updates the database
    $user->setpassword($password);
    if (!$user->update()) {
      throw new Exception('Das Passwort konnte nicht verändert werden.');
    }
  } else {
    // When the user_id was not in the database. This should never occur
    throw new Exception('Es ist ein unerwarteter Fehler aufgetreten. Bitte versuche es erneut.');
  }
  return true;
}
?>
