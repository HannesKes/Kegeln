<h3>Alle Rechnungen</h3>
<b>Summe:</b> <u><?php echo $sum_bills; ?> €</u><br/><br/>

<?php
if (!empty($all_bills)) {

  $old_payment = new Payment($db);
  $old_payment->setId($all_bills[array_key_first($all_bills)]->getPayment());
  $old_payment->readOne();
  echo "<h5>" . $old_payment->getDescription() . " (" . $old_payment->getAmount() . " €)</h5>";
  foreach ($all_bills as $bill) {
    if ($bill->getPayment() != $old_payment->getId()) {
      $old_payment->setId($bill->getPayment());
      $old_payment->readOne();
      echo "<br/><h5>" . $old_payment->getDescription() . " (" . $old_payment->getAmount() . " €)</h5>";
    }
    $game = new Game($db);
    $game->setDate($bill->getDate());
    $game->readOne();
    ?>
      <a href="/Kegeln/game/game.php?id=<?php echo $game->getId(); ?>"><?php echo $bill->getDate(); ?></a><br/>
    <?php
  }

} else {
  ?>
  Geil! Sie haben alle Rechnungen bezahlt!!! <i class='pl-2 far fa-grin-hearts fa-2x'></i>
  <?php
}
?>
