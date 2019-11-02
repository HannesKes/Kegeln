<?php
include_once $_SERVER["DOCUMENT_ROOT"] . '/Kegeln/objects/session.php';
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
      <div class="alert alert-danger alert-dismissible">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <strong>Fehler!</strong> <?php echo $e->getMessage(); ?>
      </div>
    <?php
    }
  }
?>

<div class="container w-login">
  <div id="loginbox" style="margin-top:50px;" class="mainbox justify-content-center">
    <div class="panel panel-info" >
      <div class="panel-heading">
        <div class="panel-title font-weight-bold">Login</div>
        <div style="float:right; font-size: 80%; position: relative; top:-10px"><a href="#">Passwort vergessen?</a></div>
      </div>

      <div style="padding-top:30px" class="panel-body" >

        <form id="loginform" class="form-horizontal needs-validation" method="POST" role="form" novalidate>

          <div style="margin-bottom: 25px" class="input-group">
            <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
            <input id="login-username" type="text" class="form-control" name="username" value="" placeholder="Username" maxlength="32" required>
          </div>

          <div style="margin-bottom: 25px" class="input-group">
            <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
            <input id="login-password" type="password" class="form-control" name="password" placeholder="Passwort" maxlength="32" required>
          </div>

          <div class="input-group">
            <div class="checkbox">
              <label>
                <input id="login-remember" type="checkbox" name="remember" value="1"> Cookies nutzen und eingeloggt bleiben
              </label>
            </div>
          </div>

          <div style="margin-top:10px" class="form-group">
              <!-- Button -->
            <div class="col-sm-12 controls">
              <button id="login-btn" type="submit" name="submit" class="btn btn-success">Login</button>
            </div>
          </div>

          <div class="form-group">
            <div class="col-md-12 control">
              <div style="border-top: 1px solid#888; padding-top:15px; font-size:85%" >
                Du hast noch keinen Account?
                <a href="/Kegeln/user/signup.php">
                Hier registrieren! (Nur für Bierpumpen...)
                </a>
              </div>
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
