<?php
include_once $_SERVER["DOCUMENT_ROOT"] . '/Kegeln/objects/session.php';
  $page_title = "Bierpumpen";

  //You may always be on this page.
  //Redirect to profile page
  $redirect_when_loggedin = false;
  $redirect_when_loggedout = false;
  $redirect_page = 'index.php';

  include_once $_SERVER["DOCUMENT_ROOT"] . '/Kegeln/header.php';


  //  style="background-image: url('Kegeln/media/kegeln.jpg'); background-color: 'CCCCCC'"

?>


  <!-- Background? Funzt nicht, ist schon im style.css -->

<?php
include_once $_SERVER["DOCUMENT_ROOT"] . '/Kegeln/footer.php';
?>
