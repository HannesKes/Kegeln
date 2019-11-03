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

<!-- <div class="container w-login">
  <div id="signupbox" class="mainbox justify-content-center">
    <div class="panel panel-info">
      <div class="panel-heading">
        <a id="signinlink" class="btn btn-sm btn-info float-right" href="/Kegeln/user/login.php">Login</a>
        <div class="panel-title font-weight-bold">Registrieren</div>
      </div>

      <div style="padding-top:30px" class="panel-body" >
          <form id="signupform" class="form-horizontal needs-validation" role="form" method="post" novalidate>

              <div class="form-group row">
                <div class="col-md-3">
                    <label for="email" class="col-md-3 control-label">E-Mail</label>
                </div>
                <div class="col-md-9">
                    <input type="text" class="form-control" name="email" placeholder="E-Mail Addresse" maxlength="64" required>
                </div>
                <div class="valid-feedback">Korrekt.</div>
                <div class="invalid-feedback">Bitte fülle dieses Feld aus.</div>
              </div>

              <div class="form-group row">
                <div class="col-md-3">
                    <label for="firstname" class="col-md-3 control-label">Vorname</label>
                </div>
                <div class="col-md-9">
                    <input type="text" class="form-control" name="firstname" placeholder="Max" maxlength="64" required>
                </div>
                <div class="valid-feedback">Korrekt.</div>
                <div class="invalid-feedback">Bitte fülle dieses Feld aus.</div>
              </div>
              <div class="form-group row">
                <div class="col-md-3">
                    <label for="lastname" class="col-md-3 control-label">Nachname</label>
                </div>
                <div class="col-md-9">
                    <input type="text" class="form-control" name="lastname" placeholder="Mustermann" maxlength="64" required>
                </div>
                <div class="valid-feedback">Korrekt.</div>
                <div class="invalid-feedback">Bitte fülle dieses Feld aus.</div>
              </div>
              <div class="form-group row">
                <div class="col-md-3">
                    <label for="lastname" class="col-md-3 control-label">Username</label>
                </div>
                <div class="col-md-9">
                    <input type="text" class="form-control" name="username" placeholder="z. B.: maxmuster123" maxlength="32" required>
                </div>
                <div class="valid-feedback">Korrekt.</div>
                <div class="invalid-feedback">Bitte fülle dieses Feld aus.</div>
              </div>
              <div class="form-group row">
                <div class="col-md-3">
                    <label for="password" class="col-md-3 control-label">Passwort</label>
                </div>
                <div class="col-md-9">
                    <input type="password" class="form-control" name="password" placeholder="sicheres Passwort" maxlength="32" required>
                </div>
                <div class="valid-feedback">Korrekt.</div>
                <div class="invalid-feedback">Bitte fülle dieses Feld aus.</div>
              </div>

              <div class="form-group">
                <div class="col-md-offset-3 col-md-9">
                  <button id="btn-signup" type="submit" name="submit" class="btn btn-success"><i class="far fa-hand-point-right"></i>&nbsp Registrieren</button>
                </div>
              </div>
            </form>
         </div>
      </div>
   </div>
</div> -->

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
              <a class="d-block text-center mt-2 small" href="/Kegeln/user/login.php">Login</a>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>


<!-- <script>
// Example starter JavaScript for disabling form submissions if there are invalid fields
(function() {
  'use strict';
  window.addEventListener('load', function() {
    // Fetch all the forms we want to apply custom Bootstrap validation styles to
    var forms = document.getElementsByClassName('needs-validation');
    // Loop over them and prevent submission
    var validation = Array.prototype.filter.call(forms, function(form) {
      form.addEventListener('submit', function(event) {
        if (form.checkValidity() === false) {
          event.preventDefault();
          event.stopPropagation();
        }
        form.classList.add('was-validated');
      }, false);
    });
  }, false);
})();
</script> -->

<?php
include_once $_SERVER["DOCUMENT_ROOT"] . '/Kegeln/footer.php';
?>
