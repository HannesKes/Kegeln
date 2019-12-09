<?php
include_once $_SERVER["DOCUMENT_ROOT"] . '/Kegeln/objects/user.php';

// Instanciate user
$user = new User($db);

// If the button was pressed, the password is changed
if(isset($_POST['submit'])) {
 $password = $_POST['password'];
 $password2 = $_POST['password2'];

  // Calls isPasswordValid function. This throws an Exception when the password for some reason isn't valid.
  //User::isPasswordValid($password); TODO: brauch ich das auch?

  // Show error if the passwords are not similar
  if($password != $password2) {
   ?>
   <br/>
   <div class="alert alert-danger alert-dismissible">
     <button type="button" class="close" data-dismiss="alert">&times;</button>
     <strong>Fehler!</strong> Bitte identische Passwörter eingeben
   </div>
   <?php
  } else { // Save new password and delete passwordcode
    $password = password_hash($password,PASSWORD_DEFAULT);

    $user = new User($db);
    $user->setId($_POST['user_id']);
    // Show error message if no user or passwordcode was found
    if(!$user->readOne() || $user->getPasswordcode() == null) {
      ?>
      <br/>
      <div class="alert alert-danger alert-dismissible">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <strong>Fehler!</strong> Es wurde kein passender Benutzer gefunden
      </div>
      <?php
    } else { // Check passwordcode. Error message if code is invalid
      if($_POST['code'] != $user->getPasswordcode()) {
        ?>
        <br/>
        <div class="alert alert-danger alert-dismissible">
          <button type="button" class="close" data-dismiss="alert">&times;</button>
          <strong>Fehler!</strong> Der übergebene Code war ungültig. Stell sicher, dass du den genauen Link in der URL aufgerufen hast.
        </div>
        <?php
      } else { // Try to update the password in the database
        $user->setpassword($password);
        $user->setPasswordcode(NULL);
        if(!$user->update()) {
          // Show error message if password could not be chanced
          ?>
          <br/>
          <div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong>Fehler!</strong> Dein Passwort konnte nicht geändert werden
          </div>
          <?php
        } else { // If there are no possible error show success message
          header('Location: /Kegeln/index.php?message=6');
          exit;
        }
      }
    }
  }
} elseif(!isset($_GET['userid']) || !isset($_GET['code'])) {
  // Show error message if no user or no passwortcode was submitted
  ?>
  <div class="alert alert-danger alert-dismissible">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
    <strong>Fehler!</strong> Leider wurde beim Aufruf dieser Website kein Code zum Zurücksetzen deines Passworts übermittelt
  </div>
  <?php
} ?>
