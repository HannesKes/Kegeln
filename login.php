<?php
include_once $_SERVER["DOCUMENT_ROOT"] . '/Kegeln/objects/session.php';
  $page_title = "Login";

  //You may always be on this page.
  //Redirect to profile page
  $redirect_when_loggedin = false;
  $redirect_when_loggedout = false;
  $redirect_page = 'index.php';

  include_once $_SERVER["DOCUMENT_ROOT"] . '/Kegeln/header.php';
?>

<main role="main" class="container">



      <div class="container">
          <div id="loginbox" style="margin-top:50px;" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
              <div class="panel panel-info" >
                      <div class="panel-heading">
                          <div class="panel-title">Login</div>
                          <div style="float:right; font-size: 80%; position: relative; top:-10px"><a href="#">Passwort vergessen?</a></div>
                      </div>

                      <div style="padding-top:30px" class="panel-body" >

                          <div style="display:none" id="login-alert" class="alert alert-danger col-sm-12"></div>

                          <form id="loginform" class="form-horizontal" role="form">

                              <div style="margin-bottom: 25px" class="input-group">
                                          <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                          <input id="login-username" type="text" class="form-control" name="username" value="" placeholder="Username">
                                      </div>

                              <div style="margin-bottom: 25px" class="input-group">
                                          <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                                          <input id="login-password" type="password" class="form-control" name="password" placeholder="Passwort">
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
                                        <a id="btn-login" href="#" class="btn btn-success">Login  </a>

                                      </div>
                                  </div>


                                  <div class="form-group">
                                      <div class="col-md-12 control">
                                          <div style="border-top: 1px solid#888; padding-top:15px; font-size:85%" >
                                              Du hast noch kein Account!?
                                          <a href="#" onClick="$('#loginbox').hide(); $('#signupbox').show()">
                                              Hier registrieren (Nur für Bierpumpen!)
                                          </a>
                                          </div>
                                      </div>
                                  </div>
                              </form>



                          </div>
                      </div>
          </div>
          <div id="signupbox" style="display:none; margin-top:50px" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
                      <div class="panel panel-info">
                          <div class="panel-heading">
                              <div class="panel-title">Registrieren</div>
                              <div style="float:right; font-size: 85%; position: relative; top:-10px"><a id="signinlink" href="#" onclick="$('#signupbox').hide(); $('#loginbox').show()">Login</a></div>
                          </div>
                          <div class="panel-body" >
                              <form id="signupform" class="form-horizontal" role="form">

                                  <div id="signupalert" style="display:none" class="alert alert-danger">
                                      <p>Error:</p>
                                      <span></span>
                                  </div>



                                  <div class="form-group">
                                      <label for="email" class="col-md-3 control-label">E-Mail</label>
                                      <div class="col-md-9">
                                          <input type="text" class="form-control" name="email" placeholder="E-Mail Addresse">
                                      </div>
                                  </div>

                                  <div class="form-group">
                                      <label for="firstname" class="col-md-3 control-label">Vorname</label>
                                      <div class="col-md-9">
                                          <input type="text" class="form-control" name="firstname" placeholder="Max">
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label for="lastname" class="col-md-3 control-label">Nachname</label>
                                      <div class="col-md-9">
                                          <input type="text" class="form-control" name="lastname" placeholder="Mustermann">
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label for="lastname" class="col-md-3 control-label">Username</label>
                                      <div class="col-md-9">
                                          <input type="text" class="form-control" name="username" placeholder="z. B.: maxmuster123">
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label for="password" class="col-md-3 control-label">Passwort</label>
                                      <div class="col-md-9">
                                          <input type="password" class="form-control" name="passwd" placeholder="sicheres Passwort">
                                      </div>
                                  </div>

                                  <div class="form-group">
                                      <!-- Button -->
                                      <div class="col-md-offset-3 col-md-9">
                                          <button id="btn-signup" type="button" class="btn btn-info"><i class="icon-hand-right"></i> &nbsp Registrieren</button>

                                      </div>
                                  </div>


                              </form>
                           </div>
                      </div>




           </div>
      </div>


</main>

<?php
include_once $_SERVER["DOCUMENT_ROOT"] . '/Kegeln/footer.php';
?>
