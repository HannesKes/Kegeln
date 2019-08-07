<?php
include_once $_SERVER["DOCUMENT_ROOT"] . '/Kegeln/database/db.php';
include_once $_SERVER["DOCUMENT_ROOT"] . '/Kegeln/objects/user.php';
include_once $_SERVER["DOCUMENT_ROOT"] . '/Kegeln/Objects/securitytoken.php';

//instantiate database
$database = new Database();
$db = $database->getConnection();
$user = new User($db);

//function to check the user credentials if they are correct. Throws Exceptions if username or
//password is incorrect
function loginUser ($db, User $user) {
  $username = $_POST['username'];
  $password = $_POST['password'];

  $user->setUsername($username);
  if ($user->readOne($username)) {
    // password_verify($password, $user->getpassword()) returns true or false
    $hashedPassword = password_verify($password, $user->getpassword());
    if ($hashedPassword == false) {
      throw new Exception('Passwort inkorrekt. Bitte versuche es erneut.');
    } elseif ($hashedPassword == true){
      // login user
      $user_ID = $user->getId();
      $_SESSION['session_id'] = $user_ID;

      //Does the user want to stay logged in?
      if(isset($_POST['remember'])) {
        $securitytoken = new Securitytoken($db);
        $securitytoken->setUser_id($user_ID);
        $bytes = random_bytes(16);
        $securitytoken->setIdentifier(bin2hex($bytes));
        $bytes = random_bytes(16);
        $securitytoken->setToken(bin2hex($bytes));
        $securitytoken->create();
        setcookie("identifier",$securitytoken->getIdentifier(),time()+(3600*24*365),'/'); //1 year
        setcookie("token",$securitytoken->getToken(),time()+(3600*24*365),'/'); //1 year
      }
      header("Location: /Kegeln/index.php");
      exit();
    }
  } else {
      throw new Exception('Es konnte kein Benutzer mit dem angegebenen Namen gefunden werden. Bitte überprüfe deine Eingabe und versuche es erneut.');
  }

}
