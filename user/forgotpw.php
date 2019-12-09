<?php
include_once $_SERVER["DOCUMENT_ROOT"] . '/Kegeln/includes/session.php';

//You may not be on this page when you are logged in.
//Redirect to profile page
$redirect_when_loggedin = true;
$redirect_when_loggedout = false;
$redirect_when_new = false;
$redirect_when_no_admin = false;
$redirect_page = '/Kegeln/index.php';

// Set page title
$page_title = "Passwort vergessen";

include_once $_SERVER["DOCUMENT_ROOT"] . '/Kegeln/header.php';
include_once $_SERVER["DOCUMENT_ROOT"] . '/Kegeln/includes/forgotpw_inc.php';
if($showForm){
?>
  <h1>Passwort vergessen</h1>
  Gib hier deine E-Mail-Adresse ein, um ein neues Passwort anzufordern.<br/><br/>
  <?php
  // If no user for this email exists, an error message is shown
  if(isset($error) && !empty($error)) {
   echo $error;
  }
  ?>
  <form action="" method="post">
    <div class="form-group">
      <label for="email">E-Mail:</label><br/>
      <input type="email" class="form-control" id="email" placeholder="E-Mail" name="email" required><br/>
      <button type="submit" name="submit" class="btn btn-primary">Passwortcode generieren</button><br/>
    </div>
  </form>
<?php
};
?>
<?php include_once $_SERVER["DOCUMENT_ROOT"] . '/Kegeln/footer.php';?>
