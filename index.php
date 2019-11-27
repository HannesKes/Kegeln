<?php
include_once $_SERVER["DOCUMENT_ROOT"] . '/Kegeln/includes/session.php';
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
  echo "<br/><br/>";
  echo "<div style='display: flex; justify-content: center; align-items: center'>";
    echo "<img src='$gif_array[0]' style='max-width: 100%; height: auto' />";
  echo "</div>";

  echo "</br>";

  $text_array[] = "<h4><b>1. Anzeichen, dass auf der Kegelbahn zu viel geraucht wird: </br>Während des Kegelns sind Nebelscheinwerfer an...</b></h4>";
  $text_array[] = "<h4><b>2. Anzeichen, dass auf der Kegelbahn zu viel geraucht wird: </br>Die Zigarettenindustrie ist Hauptsponsor des Vereins...</b></h4>";
  $text_array[] = "<h4><b>3. Anzeichen, dass auf der Kegelbahn zu viel geraucht wird: </br>Jeder Tisch hat seinen eigenen Zigarettenautomaten...</b></h4>";
  $text_array[] = "<h4><b>4. Anzeichen, dass auf der Kegelbahn zu viel geraucht wird: </br>Dem Kegler schmerzt es nicht, wenn wenn ihm die Kugel auf den Fuß fällt...</b></h4>";
  $text_array[] = "<h4><b>5. Anzeichen, dass auf der Kegelbahn zu viel geraucht wird: </br>Die Kegelkasse wird ausschließlich für Ersatzlungen und Beinprothesen verwendet...</b></h4>";
  $text_array[] = "<h4><b>6. Anzeichen, dass auf der Kegelbahn zu viel geraucht wird: </br>Nichtraucher kegeln mit Sauerstoffmasken...</b></h4>";
  $text_array[] = "<h4><b>1. Ausrede für schlechte Würfe: </br>Die Anderen waren zu laut...</b></h4>";
  $text_array[] = "<h4><b>2. Ausrede für schlechte Würfe: </br>Die Bahn ist schief...</b></h4>";
  $text_array[] = "<h4><b>3. Ausrede für schlechte Würfe: </br>Hier ziehts...</b></h4>";
  $text_array[] = "<h4><b>4. Ausrede für schlechte Würfe: </br>Heute Morgen ist mein Hamster gestorben...</b></h4>";
  $text_array[] = "<h4><b>5. Ausrede für schlechte Würfe: </br>Hab gestern schon 5 Stunden gespielt...</b></h4>";
  $text_array[] = "<h4><b>6. Ausrede für schlechte Würfe: </br>Mein T-Shirt passt nicht richtig...</b></h4>";

  shuffle($text_array);
  shuffle($text_array);
  shuffle($text_array);

  echo "<div style='display: flex; justify-content: center; align-items: center'>";
    echo $text_array[0];
  echo "</div>";

  //  style="background-image: url('Kegeln/media/kegeln.jpg'); background-color: 'CCCCCC'"

?>

<?php
include_once $_SERVER["DOCUMENT_ROOT"] . '/Kegeln/footer.php';
?>
