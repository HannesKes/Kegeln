<h3>Offene Rechnungen</h3>

<?php
if (!empty($open_bills_user)) {

  $old_payment = new Payment($db);
  $old_payment->setId($open_bills_user[array_key_first($open_bills_user)]->getPayment());
  $old_payment->readOne();
  echo "<h5>" . $old_payment->getDescription() . " (" . $old_payment->getAmount() . " €)</h5>";
  foreach ($open_bills_user as $bill) {
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
