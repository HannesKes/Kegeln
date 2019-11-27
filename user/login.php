<?php
include_once $_SERVER["DOCUMENT_ROOT"] . '/Kegeln/includes/session.php';
  $page_title = "Login";

  //You may not be on this page when you are logged in.
  //Redirect to profile page
  $redirect_when_loggedin = true;
  $redirect_when_loggedout = false;
  $redirect_when_new = false;
  $redirect_when_no_admin = false;
  $redirect_page = '/Kegeln/index.php';

  include_once $_SERVER["DOCUMENT_ROOT"] . '/Kegeln/header.php';
  include_once $_SERVER["DOCUMENT_ROOT"] . '/Kegeln/includes/login_inc.php';

  //calls loginUser function when the login button is pressed. Displays error message if an
  //Exception is thrown during function call
  if (isset($_POST['submit'])) {
    try {
      loginUser($db, $user);
    } catch (Exception $e) { ?>
      <br/>
      <div class="alert alert-danger alert-dismissible">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <strong>Fehler!</strong> <?php echo $e->getMessage(); ?>
      </div>
    <?php
    }
  }
?>

<div class="container">
    <div class="row">
      <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
        <div class="card card-signin my-5">
          <div class="card-body">
            <h5 class="card-title text-center">Login</h5>
            <form id="loginform" class="form-signin needs-validation" method="POST" role="form" novalidate>
              <div class="form-label-group">
                <input type="text" id="login-username" name="username" value="" class="form-control" placeholder="Username" maxlength="32" required autofocus>
                <label for="login-username">Benutzername</label>
              </div>
              <div class="form-label-group">
                <input type="password" id="login-password" name="password" value="" class="form-control" placeholder="Password" maxlength="32" required>
                <label for="login-password">Passwort</label>
              </div>
              <div class="custom-control custom-checkbox mb-3">
                <input type="checkbox" class="custom-control-input" id="login-remember" name="remember" value="1">
                <label class="custom-control-label" style="border-color:#ccc;color:#333" for="login-remember"><i class="fas fa-cookie"></i><i class="fas fa-cookie-bite"></i> nutzen und eingeloggt bleiben</label>
              </div>
              <button class="btn btn-lg btn-primary btn-block text-uppercase" type="submit" name="submit">Einloggen</button>
            </form>
            <hr class="my-4">
            <center><h5 style="color: #757575">Noch nicht registriert?</h5></center>
            <a class="btn btn-secondary btn-block text-uppercase" href="/Kegeln/user/signup.php">Stattdessen Registrieren</a>
            <hr class="my-4">
            <center><a href="#">Passwort vergessen?</a></center>
          </div>
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
