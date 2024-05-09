<?php

  session_start();

  if(!isset($_SESSION['customer_email'])){

  echo "<script>window.open('../checkout.php','_self')</script>";


  }else {

  include("includes/db.php");
  include("includes/header.php");
  include("functions/functions.php");
  include("includes/main.php");

  if(isset($_GET['order_id'])){

  $order_id = $_GET['order_id'];

  }

?>
<div class="confirm_payment_container">
  <!-- content Starts -->
  <div class="confirm_container">
    <!-- container Starts -->

    <h1> Please Confirm Your Payment </h1>


    <form action="confirm.php?update_id=<?php echo $order_id; ?>" method="post" enctype="multipart/form-data">
      <!--- form Starts -->

      <div class="form-group">
        <!-- form-group Starts -->

        <label>Invoice No:</label>

        <input type="text" class="form-control" name="invoice_no" required>

      </div><!-- form-group ends -->


      <div class="form-group">
        <!-- form-group Starts -->

        <label>Amount Sent:</label>

        <input type="text" class="form-control" name="amount_sent" required>

      </div><!-- form-group ends -->

      <div class="form-group">
        <!-- form-group Starts -->

        <label>Select Payment Mode:</label>

        <select name="payment_mode" class="form-control">
          <!-- select Starts -->

          <option>Select Payment Mode</option>
          <option>Western Union</option>

        </select><!-- select ends -->

      </div><!-- form-group ends -->

      <div class="form-group">
        <!-- form-group Starts -->

        <label>Transaction/Reference Id:</label>

        <input type="text" class="form-control" name="ref_no" required>

      </div><!-- form-group ends -->


      <div class="form-group">
        <!-- form-group Starts -->

        <label>Omni Code:</label>

        <input type="text" class="form-control" name="code" required>

      </div><!-- form-group ends -->


      <div class="form-group">
        <!-- form-group Starts -->

        <label>Payment Date:</label>

        <input type="text" class="form-control" name="date" required>

      </div><!-- form-group ends -->

      <div class="text-center">
        <!-- text-center Starts -->

        <button type="submit" name="confirm_payment" class="btn btn-primary btn-lg">

          <i class="fa fa-user-md"></i> Confirm Payment

        </button>

      </div><!-- text-center ends -->

    </form>
    <!--- form ends -->

    <?php

          if(isset($_POST['confirm_payment'])){

          $update_id = $_GET['update_id'];

          $invoice_no = $_POST['invoice_no'];

          $amount = $_POST['amount_sent'];

          $payment_mode = $_POST['payment_mode'];

          $ref_no = $_POST['ref_no'];

          $code = $_POST['code'];

          $payment_date = $_POST['date'];

          $complete = "Complete";

          $insert_payment = "insert into payments (invoice_no,amount,payment_mode,ref_no,code,payment_date) values ('$invoice_no','$amount','$payment_mode','$ref_no','$code','$payment_date')";

          $run_payment = mysqli_query($con,$insert_payment);

          $update_customer_order = "update customer_orders set order_status='$complete' where order_id='$update_id'";

          $run_customer_order = mysqli_query($con,$update_customer_order);

          $update_pending_order = "update pending_orders set order_status='$complete' where order_id='$update_id'";

          $run_pending_order = mysqli_query($con,$update_pending_order);

          if($run_pending_order){

          echo "<script>alert('your Payment has been received,order will be completed within 24 hours')</script>";

          echo "<script>window.open('my_account.php?my_orders','_self')</script>";

          }
          }
      ?>

  </div><!-- container ends -->
</div><!-- content ends -->



<?php

include("includes/footer.php");

?>

<script src="js/jquery.min.js"> </script>

<script src="js/bootstrap.min.js"></script>

</body>

</html>

<?php } ?>