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
    }
  }
?>

<div class="container w-login">
  <div id="signupbox" style="margin-top:50px" class="mainbox justify-content-center">
    <div class="panel panel-info">
      <div class="panel-heading">
          <div class="panel-title font-weight-bold">Registrieren</div>
          <div style="float:right; font-size: 85%; position: relative; top:-10px"><a id="signinlink" href="/Kegeln/login.php">Login</a></div>
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
                  <!-- Button -->
                <div class="col-md-offset-3 col-md-9">
                    <button id="btn-signup" type="submit" name="submit" class="btn btn-info"><i class="icon-hand-right"></i> &nbsp Registrieren</button>
                </div>
              </div>
            </form>
         </div>
      </div>
   </div>
</div>


<script>
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
</script>

<?php
include_once $_SERVER["DOCUMENT_ROOT"] . '/Kegeln/footer.php';
?>