<?php
include_once $_SERVER["DOCUMENT_ROOT"] . '/Kegeln/objects/session.php';
  $page_title = "Bierpumpen";

  //You may always be on this page.
  //Redirect to profile page
  $redirect_when_loggedin = false;
  $redirect_when_loggedout = false;
  $redirect_when_new = false;
  $redirect_when_no_admin = false;
  $redirect_page = '/Kegeln/index.php';

  include_once $_SERVER["DOCUMENT_ROOT"] . '/Kegeln/header.php';

  // put gifs in array to shuffle an pick a random
  $gif_array[] = "https://media.giphy.com/media/KoE4dzVStw9RS/giphy.gif";
  $gif_array[] = "https://media.giphy.com/media/xldwLDL59sBWg/giphy.gif";
  $gif_array[] = "http://giphygifs.s3.amazonaws.com/media/3utCNx5N58Gnm/giphy.gif";
  $gif_array[] = "https://media.giphy.com/media/yoJC2ElACT9uejhvYk/giphy.gif";
  $gif_array[] = "https://media.giphy.com/media/FYMc9CFlptI8o/giphy.gif";
  $gif_array[] = "http://giphygifs.s3.amazonaws.com/media/1flAwtHCYosL6LWnHr/giphy.gif";

  shuffle($gif_array);

  // show random gif
  echo "<div style='display: flex; justify-content: center; align-items: center'>";
    echo "<img src='$gif_array[0]' />";
  echo "</div>";

  //  style="background-image: url('Kegeln/media/kegeln.jpg'); background-color: 'CCCCCC'"

?>

  <!-- Background? Funzt nicht, ist schon im style.css -->

<?php
include_once $_SERVER["DOCUMENT_ROOT"] . '/Kegeln/footer.php';
?>
