<?php

session_start();

if(!isset($_SESSION['customer_email'])){
    echo "<script>window.open('../checkout.php','_self')</script>";
} else {
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
          <option>Cebuana</option>
          <option>Palawan</option>
        </select><!-- select ends -->
      </div><!-- form-group ends -->

      <div class="form-group">
        <!-- form-group Starts -->
        <label>Transaction/Reference Id (Same as Invoice No):</label>
        <input type="text" class="form-control" name="ref_no" required>
      </div><!-- form-group ends -->

      <div class="form-group">
        <!-- form-group Starts -->
        <label>Payment Date:</label>
        <input type="date" class="form-control" name="date" id="payment_date" required>
        <small id="due_date_info" class="form-text text-muted"></small>
      </div><!-- form-group ends -->

      <div class="text-center">
        <!-- text-center Starts -->
        <button type="submit" name="confirm_payment" class="btn btn-primary btn-lg">
          <i class="fa fa-user-md"></i> Confirm Payment
        </button>
      </div><!-- text-center ends -->

    </form>
    <!--- form ends -->

  </div><!-- container ends -->
</div><!-- content ends -->

<?php
// Calculate the due date (7 days from the current date)
$due_date = date('Y-m-d', strtotime('+7 days'));
?>

<?php include("includes/footer.php"); ?>

<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script>
$(function() {
  // Get today's date
  var today = new Date();
  // Calculate the maximum allowed date (7 days from today)
  var maxDate = new Date(today);
  maxDate.setDate(today.getDate() + 7);
  // Initialize Datepicker
  $("#payment_date").attr("min", today.toISOString().split('T')[0]); // Start from today
  $("#payment_date").attr("max", maxDate.toISOString().split('T')[0]); // Allow selection up to 7 days in the future
  $("#payment_date").change(function() {
    // Calculate and display due date information
    var selectedDate = new Date($(this).val());
    var dueDate = new Date(selectedDate);
    dueDate.setDate(selectedDate.getDate() + 7); // Add 7 days
    var dueDateString = dueDate.toISOString().split('T')[0];
    $("#due_date_info").text("Due date: " + dueDateString);
  });
});
</script>

</body>

</html>

<?php } ?>

<?php

if (isset($_POST['confirm_payment'])) {
    $update_id = $_GET['update_id'];
    $invoice_no = $_POST['invoice_no'];
    $amount = $_POST['amount_sent'];
    $payment_mode = $_POST['payment_mode'];
    $ref_no = $_POST['ref_no'];
    $payment_date = $_POST['date'];
    $complete = "Complete";
    $insert_payment = "INSERT INTO payments (invoice_no, amount, payment_mode, ref_no, payment_date) VALUES ('$invoice_no','$amount','$payment_mode','$ref_no','$payment_date')";
    $run_payment = mysqli_query($con, $insert_payment);
    $update_customer_order = "UPDATE customer_orders SET order_status='$complete' WHERE order_id='$update_id'";
    $run_customer_order = mysqli_query($con, $update_customer_order);
    $update_pending_order = "UPDATE pending_orders SET order_status='$complete' WHERE order_id='$update_id'";
    $run_pending_order = mysqli_query($con, $update_pending_order);
    if ($run_pending_order) {
        echo "<script>alert('Your payment has been received. Your order will be completed within 24 hours.')</script>";
        echo "<script>window.open('my_account.php?my_orders','_self')</script>";
    }
}

?>