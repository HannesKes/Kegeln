<?php
include_once $_SERVER["DOCUMENT_ROOT"] . '/Kegeln/objects/user.php';

//Includes for PHPMailer - should not work on localhost... but on netcup! :-)
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require $_SERVER["DOCUMENT_ROOT"] . '/Kegeln/includes/PHPMailer-master/src/Exception.php';
require $_SERVER["DOCUMENT_ROOT"] . '/Kegeln/includes/PHPMailer-master/src/PHPMailer.php';
require $_SERVER["DOCUMENT_ROOT"] . '/Kegeln/includes/PHPMailer-master/src/SMTP.php';

function signupUser() {

  // checks the two passwords
  if ($_POST['password1'] != $_POST['password2']) {
    throw new Exception("Die beiden Passwörter stimmen nicht überein.", 1);
  }

  $database = new Database();
  $db = $database->getConnection();

  $user = new User($db);

  //Set attributes of the new user object
  $user->setFirstname($_POST['firstname']);
  $user->setLastname($_POST['lastname']);
  $user->setIsNew('1');
  $user->setIsAdmin('0');

  // validates the input. Throws an Exception when the Username or Email for some reason isn't valid.
  User::isUsernameValid($db, $_POST['username']);
  $user->setUsername($_POST['username']);

  User::isEmailValid($db, $_POST['email']);
  $user->setEmail($_POST['email']);

  //Encode Password for safer handling
  $password = password_hash($_POST['password1'],PASSWORD_DEFAULT);
  $user->setpassword($password);

  if ($user->create()) {
    // Hier Mails versenden...

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

        //Recipients
        $mail->setFrom('info@bierpumpen.de', 'Bierpumpen.de'); //FROM
        $mail->addAddress($_POST['email'],);     // TO
        $mail->addBCC('niko@theders.de', 'hannes.kessling@gmail.com');

        // Content
        $mail->isHTML(true);                                  // Set email format to HTML
        $mail->Subject = 'Deine Registrierung auf Bierpumpen.de';
        $mail->Body    = 'Moin moin, <br> deine Registrierung ist eingegangen und du wirst sehr bald vom Admin aktiviert... <br> Wenn dir das nicht schnell genug geht, meld dich einfach beim Admin, du kennst ihn ja ;-)';
        $mail->AltBody = 'Moin moin,
        deine Registrierung ist eingegangen und du wirst sehr bald vom Admin aktiviert...
        Wenn dir das nicht schnell genug geht, meld dich einfach beim Admin, du kennst ihn ja ;-)';

        $mail->SMTPDebug = 0;
        $mail->send();
        // echo 'Message has been sent';
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }

    //registration successful message
    header("Location: /Kegeln/index.php?message=1");
    exit();
  } else {
    throw new Exception('Die Registrierung war leider nicht erfolgreich. Bitte versuchen Sie es erneut.', 4);
  }
}
?>
