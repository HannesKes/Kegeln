<?php
  if (isset($_GET['logout'])) {
    session_start();
    setcookie("identifier", "", time()-3600, "/");
    setcookie("token", "", time()-3600, "/");
    session_destroy();
    header('Location: /Kegeln/index.php');
    exit();
  }
?>
