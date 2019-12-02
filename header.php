<?php
include_once $_SERVER["DOCUMENT_ROOT"] . '/Kegeln/database/db.php';
include_once $_SERVER["DOCUMENT_ROOT"] . '/Kegeln/objects/user.php';
include_once $_SERVER["DOCUMENT_ROOT"] . '/Kegeln/objects/game.php';
include_once $_SERVER["DOCUMENT_ROOT"] . '/Kegeln/objects/pun.php';
include_once $_SERVER["DOCUMENT_ROOT"] . '/Kegeln/objects/bill.php';

$loggedin = false;
$isNew = false;
$isAdmin = false;

// Instantiate database
$database = new Database();
$db = $database->getConnection();

// Instantiate User object if a user is logged in
$userid = ""; // TODO: wird das genutzt?
$username = ""; // TODO: wird das genutzt?
if (isset($_SESSION['session_id'])) {
  $loggedin_user = new User($db);
  $loggedin_user->setId($_SESSION['session_id']);
  $loggedin_user->readOne($db);
  $loggedin = true;
  $userid = $loggedin_user->getId();
  $username = $loggedin_user->getUsername();
  $nextGame = NULL;
  if($loggedin_user->getIsNew()==1){
    $isNew = true;
  } else {
    $game = Game::readLast($db); // TODO: ???
    $nextGame = $game->getNextGame(); // TODO: ???
  }
  if($loggedin_user->getIsAdmin()==1){
    $isAdmin = true;
    $open_bills = Bill::getOpenBills($db);
  }
}

// Redirects to the set redirect_page so people can not visit sites they are not supposed to
if(($redirect_when_loggedin == true) && ($loggedin == true)){
  header("Location: $redirect_page?errorcode=2");
  exit();
} elseif (($redirect_when_loggedout == true) && ($loggedin == false)){
  header("Location: $redirect_page?errorcode=1");
  exit();
} elseif (($redirect_when_new == true) && ($isNew == true)){
  header("Location: $redirect_page?errorcode=3");
  exit();
} elseif (($redirect_when_no_admin == true) && ($isAdmin == false)){
  header("Location: $redirect_page?errorcode=4");
  exit();
} elseif (isset($redirect_when_other_profile) && $redirect_when_other_profile == true) {
  header("Location: $redirect_page?errorcode=8");
  exit();
}

$users = User::readNew($db);

?>

<!DOCTYPE html>
<html lang="de">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bierpumpen</title>

    <!-- Bootstrap -->
    <link href="/Kegeln/css/bootstrap.min.css" rel="stylesheet">
    <link href="/Kegeln/css/style.css" rel="stylesheet">
    <link rel="shortcut icon" type="image/x-icon" href="/Kegeln/media/beer.jpg">
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"><link href="https://use.fontawesome.com/releases/v5.0.1/css/all.css" rel="stylesheet"> -->
    <link href="https://use.fontawesome.com/releases/v5.11.1/css/all.css" rel="stylesheet">
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>

  </head>
  <body>

  	<header>
	    <nav class="navbar sticky-top navbar-expand-md navbar-dark" style="background-color: #353535;">
			  <a class="navbar-brand" href="/Kegeln/index.php"><img src="/Kegeln/media/beer.jpg" width="40" height="40" alt=""></a>
			  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
			    <span class="navbar-toggler-icon"></span>
			  </button>

			  <div class="collapse navbar-collapse" id="navbarSupportedContent">
			    <ul class="navbar-nav mr-auto">
			      <li class="nav-item <?php if (strpos($_SERVER['PHP_SELF'], "index.php")){echo "active";} ?>">
			        <a class="nav-link" href="/Kegeln/index.php">Home</a>
			      </li>
			      <li class="nav-item <?php if (strpos($_SERVER['PHP_SELF'], "membersarea.php")){echo "active";} ?>">
			        <a class="nav-link" href="/Kegeln/intern.php">Intern</a>
			      </li>
            <?php
            if ($isAdmin){
              if(!empty($users)){
                ?>
                <li class="nav-item <?php if (strpos($_SERVER['PHP_SELF'], "index.php")){echo "active";} ?>">
                  <a class="nav-link" href="/Kegeln/user/accept.php">Neue Nutzer</a>
                </li>
                <?php
              }
              ?>
              <li class="nav-item <?php if (strpos($_SERVER['PHP_SELF'], "insert_game.php")){echo "active";} ?>">
                <a class="nav-link" href="/Kegeln/game/insert_game.php">Spiel erfassen</a>
              </li>
              <?php
              if($nextGame==NULL){
                ?>
                <li class="nav-item <?php if (strpos($_SERVER['PHP_SELF'], "update_game.php")){echo "active";} ?>">
                  <a class="nav-link" href="/Kegeln/game/update_game.php">Nächstes Spiel erfassen</a>
                </li>
                <?php
              } else {
                ?>
                <li class="nav-item <?php if (strpos($_SERVER['PHP_SELF'], "update_game.php")){echo "active";} ?>">
                  <a class="nav-link" href="/Kegeln/game/update_game.php">Nächstes Spiel ändern</a>
                </li>
                <?php
              }
              ?>
              <li class="nav-item <?php if (strpos($_SERVER['PHP_SELF'], "payment.php")){echo "active";} ?>">
                <a class="nav-link" href="/Kegeln/payment.php">Strafe erfassen</a>
              </li>
              <?php
              if (isset($open_bills)) {
                ?>
                <li class="nav-item <?php if (strpos($_SERVER['PHP_SELF'], "open_payments.php")){echo "active";} ?>">
                  <a class="nav-link" href="/Kegeln/open_payments.php">Offene Rechnungen</a>
                </li>
                <?php
              }
            }
            ?>
            <form action="" method="POST">
              <li class="nav-item">
                <button type="submit" name="displayPun" class="btn btn-link nav-link">Bierspruch</button>
              </li>
            </form>
          </ul>
            <?php if ($loggedin){ ?>
              <ul class="navbar-nav">
                <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                    <img src="/Kegeln/media/user_empty.png" class="mr-1" style="height:25px;"/>
                    <?php echo $loggedin_user->getUsername(); ?>
                  </a>
                  <div class="dropdown-menu dropdown-menu-right">
                    <a class="dropdown-item" href="/Kegeln/User/profile.php?id=<?php echo $loggedin_user->getId(); ?>">Mein Profil</a>
                    <!-- Separation line -->
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#">Passwort ändern</a> <!-- /Kegeln/User/changepw.php -->
                    <a class="dropdown-item" href="/Kegeln/includes/logout_inc.php?logout=true">Abmelden</a>
                  </div>
                </li>
              </ul>
            <?php } ?>
          </ul>
			  </div>
			</nav>
		</header>

<div class="d-none d-lg-block">
<img src="/Kegeln/media/kegel links.png" align="left">
<img src="/Kegeln/media/kegel rechts.png" align="right">
</div>

<main role="main" class="container">

<?php

// Waits for the Bierspruch Button to be pressed and displays a random Pun.
  if(isset($_POST['displayPun'])) {
    $pun = Pun::randomPun($db); ?>
      <br/>
      <div class="alert alert-secondary alert-dismissible">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <strong><?php echo $pun->getContent(); ?></strong>
      </div>
    <?php
  }

// Waits for an errorcode to be sent and displays the correspondig message.
if(isset($_GET['errorcode'])) {

  $message = "";

  switch ($_GET['errorcode']) {
    case "1":
        // nur für eingeloggte Nutzer (Beispiel: Interner Bereich)
        $message = "Sie haben keine Berechtigung, auf diese Seite zuzugreifen. Sie müssen sich zuerst anmelden.";
        break;
    case "2":
        // nur ausgeloggte Nutzer dürfen auf diese Seite (Beispiel: SignUp)
        $message = "Sie haben keine Berechtigung, auf diese Seite zuzugreifen.";
        break;
    case "3":
        // registriert aber noch nicht bestätigt -> isNew = true
        $message = "Sie müssen warten, bis ihre Registrierung bestätigt wurde, bevor Sie auf diese Seite zugreifen dürfen.";
        break;
    case "4":
        // der angemeldete Nutzer ist kein Admin -> isAdmin = false
        $message = "Sie müssen warten, bis ihre Registrierung bestätigt wurde, bevor Sie auf diese Seite zugreifen dürfen.";
        break;
    case "5":
        // die Seite accept.php wurde aufgerufen, obwohl keine neuen Nutzer vorhanden sind
        $message = "Es sind keine neuen Nutzer zum Aktzeptieren vorhanden.";
        break;
    case "6":
        // die Seite game/game.php wurde ohne "?id=123" angegeben
        $message = "Sie müssen die ID des Spiels mitgeben, um sich das Spiel anzeigen zu lassen.";
        break;
    case "7":
        // die ID ist nicht in der DB vorhanden
        $message = "Für dieses Spiel sind keine Daten vorhanden.";
        break;
    case "7":
        // ein User versucht auf das Profil eines anderen Nutzers zuzugreifen
        $message = "Sie dürfen nur auf ihr eigenes Profil zugreifen.";
        break;
    case "7":
        // auf der Seite open_payments sind keine offenen Rechnungen vorhanden
        $message = "Alle Rechnungen sind bezahlt. Es sind keine offenen Rechnungen vorhanden.";
        break;
    default:
        $message = "Für diesen Code existiert keine Fehlermeldung.";
  }

  ?>
  <br/>
  <div class="alert alert-danger alert-dismissible">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
    <?php echo $message; ?>
  </div>
  <?php

} elseif (isset($_GET['message'])){
  $message = "";

  switch ($_GET['message']) {
    case "1":
      // der Nuter hat sich registriert
      $message = "Ihre Registrierung war erfolgreich. Bevor Sie jedoch auf den internen Bereich zugreifen dürfen, muss Ihre Registrierung durch einen autorisierten Nutzer bestätigt werden. Bitte haben Sie etwas Geduld. Wir kontaktieren Sie in Kürze.";
      break;
    case "2":
      // ein Admin hat ein neues Spiel erfasst
      $message = "Das Spiel wurde erfolgreich erstellt.";
      break;
    case "3":
      // neues Spiel ohne ANgabe des Datums des nächsten Spiels
      $message = "Das Spiel wurde erfolgreich erstellt. Sie können das Datum für das nächste Spiel <a href='/Kegeln/game/update_game.php'>hier</a> nachtragen.";
      break;
    case "4":
      // ein Admin hat ein neues Spiel erfasst
      $message = "Es sind keine neuen Nutzer mehr zum Aktzeptieren vorhanden.";
      break;
    case "5":
      // ein Admin hat ein neues Spiel erfasst
      $message = "Das Datum wurde erfolgreich ergänzt.";
      break;
    default:
      $message = "Für diesen Code existiert keine Meldung.";
  }

  ?>
  <br/>
  <div class="alert alert-success alert-dismissible">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
    <?php echo $message; ?>
  </div>
  <?php

}

 ?>
