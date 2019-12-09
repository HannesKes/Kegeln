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
$page_title = "Passwort zurücksetzen";
include_once $_SERVER["DOCUMENT_ROOT"] . '/Kegeln/header.php';

include_once $_SERVER["DOCUMENT_ROOT"] . '/Kegeln/includes/newpw_inc.php';
?>
<h1>Neues Passwort vergeben</h1>
<form action="" method="post">
 <div class="form-group">
   <input type="hidden" name="user_id" value="<?php echo $_GET['userid']; ?>">
   <input type="hidden" name="code" value="<?php echo htmlentities($_GET['code']); ?>">
   <label for="password">Passwort</label><br/>
   <input type="password" class="form-control" placeholder="Passwort" name="password" required><br/>
   <label for="password2">Passwort erneut eingeben</label><br/>
   <input type="password" class="form-control" placeholder="Passwort" name="password2" required><br/>
   <button type="submit" name="submit" class="btn btn-primary">Passwort speichern</button><br/>
 </div>
</form>
<br/>
 <?php include_once $_SERVER["DOCUMENT_ROOT"] . '/Kegeln/footer.php'; ?>
