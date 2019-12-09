<?php
include_once $_SERVER["DOCUMENT_ROOT"] . '/Kegeln/objects/user.php';

// Instanciate the user
$user = new User($db);

// If showForm is true, the input fields to receive the input are shown
$showForm = true;

if(isset($_POST['submit']) ) {
  if(!isset($_POST['email']) || empty($_POST['email'])) { // If no email was submitted, set error variable
    $error = "<b>Bitte eine E-Mail-Adresse eintragen</b>";
  } else {
    $email = $_POST['email'];

    // Get the user
    $user->setEmail($email);

    // Check if user is in database
    if(!$user->readOne()) {
      $error = "<b>Kein Benutzer zu dieser E-Mail gefunden</b>";
    } else {
      // Generate a passwordcode for the user
      $passwordcode = generate_random_string();

      $user->setPasswordcode($passwordcode);

      $user->update();

      // Generate the e-mail data
      $empfaenger = $user->getEmail();
      $betreff = "Neues Passwort für deinen Account bei den Bierpumpen";
      $from = "From: Bier Bierensen <Bier@Bier.Bier>";
      $url_passwordcode = 'http://localhost/Kegeln/user/newpw.php?userid='.$user->getId().'&code='.$passwordcode;

      $page_title = "Passwort zurücksetzen";
      include_once $_SERVER["DOCUMENT_ROOT"] . '/Kegeln/header.php';

      // Show email text
      ?>
      <h1>Neues Passwort für deinen Account auf dem Hopfenspeicher</h1><br/><br/>
      <b>An: <?php echo $empfaenger; ?></b><br/><br/>
      Hallo <?php echo $user->getUsername(); ?><br/><br/>
      für deinen Account bei den Bierpumpen wurde nach einem neuen Passwort gefragt.
      Um ein neues Passwort zu vergeben, klicke innerhalb der nächsten 24 Stunden auf den folgenden Link: <br/>

      <a href="<?php echo $url_passwordcode; ?>">Passwort zurücksetzen</a><br/>
      Sollte dir dein Passwort wieder eingefallen sein oder solltest du diese E-Mail nicht angefordert haben, so ignoriere diese E-Mail bitte.<br/><br/>

      Viele Grüße<br/><br/>
      Dein Bierpumpen-Team

      <?php
      include_once $_SERVER["DOCUMENT_ROOT"] . '/Kegeln/footer.php';

      // If showForm is false, the e-mail for the user is shown
      $showForm = false;
    }
  }
}

// Used to generate the passwordcode
function generate_random_string() {
 if(function_exists('random_bytes')) {
   $bytes = random_bytes(16);
   $str = bin2hex($bytes);
 }
 return $str;
}
?>
