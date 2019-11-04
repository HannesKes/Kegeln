<?php
include_once $_SERVER["DOCUMENT_ROOT"] . '/Kegeln/objects/session.php';
  $page_title = "Registrieren";

  //You may not be on this page when you are logged in.
  //Redirect to profile page
  $redirect_when_loggedin = true;
  $redirect_when_loggedout = false;
  $redirect_when_new = false;
  $redirect_when_no_admin = false;
  $redirect_page = '/Kegeln/index.php';

  $errorcode = 0;

  include_once $_SERVER["DOCUMENT_ROOT"] . '/Kegeln/header.php';
  include_once $_SERVER["DOCUMENT_ROOT"] . '/Kegeln/includes/signup_inc.php';

  if (isset($_POST['submit'])) {
    try {
      signupUser();
    } catch (Exception $e) { ?>
      <div class="alert alert-danger alert-dismissible">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <strong>Fehler!</strong> <?php echo $e->getMessage(); ?>
      </div>
      <?php
      $form_username = $_POST['username'];
      $form_email = $_POST['email'];
      $form_firstname = $_POST['firstname'];
      $form_lastname = $_POST['lastname'];
      $form_password1 = $_POST['password1'];
      $form_password2 = $_POST['password2'];

      $errorcode = $e->getCode();
    }
  }
?>

<div class="container">
    <div class="row">
      <div class="col-lg-10 col-xl-9 mx-auto">
        <div class="card card-signin flex-row my-5">
          <div class="card-body">
            <h5 class="card-title text-center">Registrieren</h5>
            <form id="signinform" class="form-signin" method="POST" role="form">
              <div class="form-label-group">
                <input type="text" id="username" class="form-control" name="username" placeholder="Benutzername" <?php if($errorcode != 2 && $errorcode != 0){echo "value=\"$form_username\"";} if($errorcode == 0 || $errorcode == 2){echo "autofocus";} ?> required>
                <label for="username">Benutzername</label>
              </div>

              <div class="form-label-group">
                <input type="email" id="email" class="form-control" name="email" placeholder="E-Mail-Addresse" <?php if($errorcode != 3 && $errorcode != 0){echo "value=\"$form_email\"";} if($errorcode == 3){echo "autofocus";} ?> required>
                <label for="email">E-Mail-Addresse</label>
              </div>

              <div class="form-label-group">
                <input type="text" id="firstname" class="form-control" name="firstname" placeholder="Vorname" <?php if($errorcode != 0){echo "value=\"$form_firstname\"";} ?> required>
                <label for="firstname">Vorname</label>
              </div>

              <div class="form-label-group">
                <input type="text" id="lastname" class="form-control" name="lastname" placeholder="Nachname" <?php if($errorcode != 0){echo "value=\"$form_lastname\"";} ?> required>
                <label for="lastname">Nachname</label>
              </div>

              <hr>

              <div class="form-label-group">
                <input type="password" id="password1" name="password1" class="form-control" placeholder="Passwort" <?php if($errorcode != 1 && $errorcode != 0){echo "value=\"$form_password1\"";} if($errorcode == 1){echo "autofocus";} ?> required>
                <label for="password1">Sicheres Passwort</label>
              </div>

              <div class="form-label-group">
                <input type="password" id="password2" name="password2" class="form-control" placeholder="Passwort" <?php if($errorcode != 1 && $errorcode != 0){echo "value=\"$form_password1\"";} ?> required>
                <label for="password2">Passwort bestätigen</label>
              </div>

              <button class="btn btn-lg btn-primary btn-block text-uppercase" name="submit" type="submit">Registrieren</button>
            </form>
            <a class="d-block text-center mt-2 small" href="/Kegeln/user/login.php">Login</a>
            <hr>
            <div class="text-sm-center small" style="color: #757575">(Nur für echte Bierpumpen)</div>
          </div>
        </div>
      </div>
    </div>
  </div>

<?php
include_once $_SERVER["DOCUMENT_ROOT"] . '/Kegeln/footer.php';
?>
