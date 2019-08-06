<?php
session_start();
include_once $_SERVER["DOCUMENT_ROOT"] . '/Kegeln/database/db.php';
include_once $_SERVER["DOCUMENT_ROOT"] . '/Kegeln/objects/securitytoken.php';
$database = new Database();
$db = $database->getConnection();

//Check for stay_logged_in-Cookie
if(!isset($_SESSION['session_id']) && isset($_COOKIE['identifier']) && isset($_COOKIE['token'])) {
  $securitytoken = new Securitytoken($db);

  $identifier = $_COOKIE['identifier'];
  $token = $_COOKIE['token'];

  $securitytoken->setIdentifier($identifier);
  $securitytoken->readOne();

  if($token == $securitytoken->getToken()){
    //Token was correct
    //Set new token
    $bytes = random_bytes(16);
    $securitytoken->setToken = bin2hex($bytes);
    $securitytoken->updateToken();
    setcookie("identifier",$identifier,time()+(3600*24*365),"/"); //1 year
    setcookie("token",$securitytoken->getToken(),time()+(3600*24*365),"/"); //1 year

    //Log in user
    $_SESSION['session_id'] = $securitytoken->getUser_id();
  }
}
?>
