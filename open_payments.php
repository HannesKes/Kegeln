<?php
include_once $_SERVER["DOCUMENT_ROOT"] . '/Kegeln/includes/session.php';
  $page_title = "Offene Rechnungen";

  //You may not be on this page when you are logged out or new or no admin.
  //Redirect to profile page
  $redirect_when_loggedin = false;
  $redirect_when_loggedout = true;
  $redirect_when_new = true;
  $redirect_when_no_admin = true;
  $redirect_page = '/Kegeln/index.php';

  include_once $_SERVER["DOCUMENT_ROOT"] . '/Kegeln/header.php';

  if (isset($_POST["pay"])) {
    Bill::pay($db, $_POST["bill_id"]);
    $open_bills = User::readNew($db);
  }

  if (!isset($open_bills) || empty($open_bills)) {
    header("/Kegeln/index.php?errorcode=8");
  }

  include_once $_SERVER["DOCUMENT_ROOT"] . '/Kegeln/objects/payment.php';
  $open_payments = Bill::getOpenPayments($db);

?>

<div class="container justify-content-center">

<center><h1 class="my-2">Offene Rechnungen</h1></center>
<br/>

<div id="accordion">
<?php
foreach ($open_payments as $payment) {
  $current_payment = new Payment($db);
  $current_payment->setId($payment->getId());
  $current_payment->readOne();
  ?>

  <div class="card">
    <div class="card-header" id="heading<?php echo $payment->getId(); ?>">
      <h5 class="mb-0">
        <button class="btn btn-link" style="color: black" data-toggle="collapse" data-target="#collapse<?php echo $payment->getId(); ?>" aria-expanded="false" aria-controls="collapse<?php echo $payment->getId(); ?>">
          <?php echo "<i><u>" . $payment->getDescription() . " (" . $payment->getAmount() . " €)</u></i>"; ?>
        </button>
      </h5>
    </div>

    <div id="collapse<?php echo $payment->getId(); ?>" class="collapse" aria-labelledby="heading<?php echo $payment->getId(); ?>" data-parent="#accordion">
      <div class="card-body">

    <?php

        $open_bills_by_payment = Bill::getOpenBillsByPayment($db, $payment->getId());

        echo '<ul class="list-group">';

        foreach($open_bills_by_payment as $bill)
        {

          $user = new User($db);
          $user->setId($bill->getUser());
          $user->readOne();

          ?>

          <li class="list-group-item">
            <div class="row">
              <div class="col-9">
                <?php echo "<b>" . $user->getFirstname() . " " . $user->getLastname() . "</b> " . $user->getUsername() . " (" . $bill->getDate() . ")"; ?><br/>
              </div>
              <div class="col-3">
                <form action="" method="POST">
                  <input type="hidden" name="bill_id" value="<?php echo $bill->getId(); ?>">
                  <button type="submit" name="pay" class="btn float-right px-2 fas fa-hand-holding-usd" value="" style="color: green; size: 9x"></button>
                </form>
              </div>
            </div>
          </li>

          <?php
          }
          ?>

        </ul>
      </div>
    </div>

  </div>

<?php
}
echo "</div>";
echo "</div>";

include_once $_SERVER["DOCUMENT_ROOT"] . '/Kegeln/footer.php';
?>
