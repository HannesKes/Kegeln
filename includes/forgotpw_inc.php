<?php
include_once $_SERVER["DOCUMENT_ROOT"] . '/Kegeln/objects/user.php';

//Includes for PHPMailer - should not work on localhost... but on netcup! :-)
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require $_SERVER["DOCUMENT_ROOT"] . '/Kegeln/includes/PHPMailer-master/src/Exception.php';
require $_SERVER["DOCUMENT_ROOT"] . '/Kegeln/includes/PHPMailer-master/src/PHPMailer.php';
require $_SERVER["DOCUMENT_ROOT"] . '/Kegeln/includes/PHPMailer-master/src/SMTP.php';

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

      // send mail
      $mail = new PHPMailer(true);

      try {
          //Server settings
          $mail->SMTPDebug = 2;                                       // Enable verbose debug output
          $mail->isSMTP();                                            // Set mailer to use SMTP
          $mail->Host       = 'mxf9ba.netcup.net';                    // Netcup SMTP-Server
          $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
          $mail->Username   = 'info@bierpumpen.de';                   // SMTP username
          $mail->Password   = '';                                     // SMTP password
          $mail->SMTPSecure = 'tls';                                  // Enable TLS encryption, `ssl` also accepted
          $mail->Port       = 587;                                    // TCP port to connect to

          $url_passwordcode = 'http://localhost/Kegeln/user/newpw.php?userid='.$user->getId().'&code='.$passwordcode;

          //Recipients
          $mail->setFrom('info@bierpumpen.de', 'Bierpumpen.de'); //FROM
          $mail->addAddress($user->getEmail(),);                 // TO
          $mail->addBCC('niko@theders.de', 'hannes.kessling@gmail.com');

          // Content
          $mail->isHTML(true);                                  // Set email format to HTML
          $mail->Subject = 'Neues Passwort für deinen Account bei den Bierpumpen';
          $mail->Body    = "Hallo " .  $user->getUsername() . "<br/><br/>für deinen Account bei den Bierpumpen wurde nach einem neuen Passwort gefragt. Um ein neues Passwort zu vergeben, klicke innerhalb der nächsten 24 Stunden auf den folgenden Link: <br/><a href='$url_passwordcode'>Passwort zurücksetzen</a><br/>Sollte dir dein Passwort wieder eingefallen sein oder solltest du diese E-Mail nicht angefordert haben, so ignoriere diese E-Mail bitte.<br/><br/>Viele Grüße<br/><br/>Dein Bierpumpen-Team";
          $mail->AltBody = "Hallo " .  $user->getUsername() . "<br/><br/>
          für deinen Account bei den Bierpumpen wurde nach einem neuen Passwort gefragt.
          Um ein neues Passwort zu vergeben, klicke innerhalb der nächsten 24 Stunden auf den folgenden Link: <br/>

          <a href='$url_passwordcode'>Passwort zurücksetzen</a><br/>
          Sollte dir dein Passwort wieder eingefallen sein oder solltest du diese E-Mail nicht angefordert haben, so ignoriere diese E-Mail bitte.<br/><br/>

          Viele Grüße<br/><br/>
          Dein Bierpumpen-Team";

          $mail->SMTPDebug = 0;
          $mail->send();

          header('Location: /Kegeln/index.php?message=7');
          exit;
      } catch (Exception $e) {
          echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
      }
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
