<?php
include_once $_SERVER["DOCUMENT_ROOT"] . '/Kegeln/database/db.php';
include_once $_SERVER["DOCUMENT_ROOT"] . '/Kegeln/objects/user.php';

$loggedin = false;

// Instantiate database
$database = new Database();
$db = $database->getConnection();

// Instantiate User object if a user is logged in
if (isset($_SESSION['session_id'])) {
  $loggedin_user = new User($db);
  $loggedin_user->setId($_SESSION['session_id']);
  $loggedin = true;
}

// Redirects to the set redirect_page so people can not visit sites they are not supposed to
if(($redirect_when_loggedin == true) && ($loggedin == true)){
  header("Location: $redirect_page?errorcode=2");
  exit();
} elseif (($redirect_when_loggedout == true) && ($loggedin == false)){
  header("Location: $redirect_page?errorcode=1");
  exit();
}

?>

<!DOCTYPE html>
<html lang="de">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bierpumpen</title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <link rel="shortcut icon" type="image/x-icon" href="media/beer.jpg">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>

    <style>
    body{
      /* The image used */
      background-image: url("/media/kegeln.jpg");

      /* Full height */
      height: 100%;

      /* Center and scale the image nicely */
      background-position: center;
      background-repeat: no-repeat;
      background-size: cover;
    }
    </style>
    
  </head>
  <body>

  	<header>
	    <nav class="navbar sticky-top navbar-expand-lg navbar-dark" style="background-color: #353535;">
			  <a class="navbar-brand" href="index.php"><img src="media/beer.jpg" width="40" height="40" alt=""></a>
			  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
			    <span class="navbar-toggler-icon"></span>
			  </button>

			  <div class="collapse navbar-collapse" id="navbarSupportedContent">
			    <ul class="navbar-nav mr-auto">
			      <li class="nav-item active">
			        <a class="nav-link" href="index.php">Home<span class="sr-only">(current)</span></a>
			      </li>
			      <li class="nav-item">
			        <a class="nav-link" href="#">Kontakt</a>
			      </li>
			      <li class="nav-item">
			        <a class="nav-link" href="login.php">Intern</a>
			      </li>
			      <li class="nav-item">
			        <a class="nav-link" href="impressum.php">Impressum</a>
			      </li>
			    </ul>
			  </div>
			</nav>
		</header>
