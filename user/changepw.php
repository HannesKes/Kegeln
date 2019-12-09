<?php
include_once $_SERVER["DOCUMENT_ROOT"] . '/Kegeln/includes/session.php';

// You may not be on this page when you are logged out.
// Redirect to index page
$redirect_when_loggedin = false;
$redirect_when_loggedout = true;
$redirect_when_new = false;
$redirect_when_no_admin = false;
$redirect_page = '/Kegeln/index.php';

include_once $_SERVER["DOCUMENT_ROOT"] . '/Kegeln/includes/changepw_inc.php';

// Set page title
$page_title = "Passwort ändern";

include_once $_SERVER["DOCUMENT_ROOT"] . '/Kegeln/header.php';

// Called when a new password is submitted
if(isset($_POST['submit'])){
  try {
    // When no error is thrown, a new password is set and a success massage is shown
    updatePassword($db);
    header('Location: /Kegeln/index.php?message=6');
    exit;
  // When there occured an error when changing the password
  } catch (Exception $e) { ?>
    <br/>
    <div class="alert alert-danger alert-dismissible">
      <button type="button" class="close" data-dismiss="alert">&times;</button>
      <strong>Fehler!</strong> <?php echo $e->getMessage(); ?>
    </div>
  <?php
  }

// Show input fields for new and old password
}?>
<h3>Passwort ändern</h3><br/>
<form action="" method="post">
  <input type="hidden" name="user_id" value="<?php echo $_SESSION['session_id']; ?>">
  <div class="form-group">
    <label for="newPassword">Neues Passwort:</label><br/>
    <input type="password" class="form-control" id="newPassword" placeholder="Neues Passwort" name="newPassword" required>
  </div>
  <div class="form-group">
    <label for="newPassword2">Neues Passwort wiederholen:</label><br/>
    <input type="password" class="form-control" id="newPassword2" placeholder="Neues Passwort wiederholen" name="newPassword2" required>
  </div>
  <div class="form-group">
    <label for="password">Aktuelles Passwort:</label><br/>
    <input type="password" class="form-control" id="password" placeholder="Passwort" name="password" required>
  </div>
  <button type="submit" name="submit" class="btn btn-primary">Passwort ändern</button><br/>
</form>

<?php
include_once $_SERVER["DOCUMENT_ROOT"] . '/Kegeln/footer.php';
?>
