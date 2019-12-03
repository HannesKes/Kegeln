<h3>Teilgenommene Spiele</h3>

<?php
if (!empty($all_games)) {
  foreach ($all_games as $game) {
    ?>
      <a href="/Kegeln/game/game.php?id=<?php echo $game->getId(); ?>"><?php echo $bill->getDate(); ?></a><br/>
    <?php
  }
} else {
  ?>
  Sie waren wohl scheinbar noch nie dabei... <i class="far fa-sad-tear ml-1"></i><br/>
  Das sollten Sie unbedingt nachholen! <br/>
  <?php
}
?>
