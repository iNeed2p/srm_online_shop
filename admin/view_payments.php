<?php


if(!isset($_SESSION['admin_email'])){

echo "<script>window.open('login.php','_self')</script>";

}

else {


?>


<div class="row">
  <!-- 1 row Starts -->

  <div class="col-lg-12">
    <!-- col-lg-12 Starts -->

    <ol class="breadcrumb">
      <!-- breadcrumb Starts -->

      <li class="active">

        <i class="fa fa-dashboard"></i> Dashboard / View Payments

      </li>

    </ol><!-- breadcrumb ends -->

  </div><!-- col-lg-12 ends -->

</div><!-- 1 row ends -->


<div class="row">
  <!-- 2 row Starts -->

  <div class="col-lg-12">
    <!-- col-lg-12 Starts -->

    <div class="panel panel-default">
      <!-- panel panel-default Starts -->

      <div class="panel-heading">
        <!-- panel-heading Starts -->

        <h3 class="panel-title">
          <!-- panel-title Starts -->

           View Payments

        </h3><!-- panel-title ends -->

      </div><!-- panel-heading ends -->

      <div class="panel-body">
        <!-- panel-body Starts -->

        <div class="table-responsive">
          <!-- table-responsive Starts -->

          <table class="table table-hover table-bordered table-striped">
            <!-- table table-hover table-bordered table-striped Starts -->

            <thead>
              <!-- thead Starts -->

              <tr>

                <th>#</th>
                <th>Invoice No</th>
                <th>Amount Paid</th>
                <th>Payment Method</th>
                <th>Reference #</th>
                <th>Payment Code</th>
                <th>Payment Date</th>
                <th>Action</th>

              </tr>

            </thead><!-- thead ends -->

            <tbody>
              <!-- tbody Starts -->

              <?php

$i = 0;

$get_payments = "select * from payments";

$run_payments = mysqli_query($con,$get_payments);

while($row_payments = mysqli_fetch_array($run_payments)){

$payment_id = $row_payments['payment_id'];

$invoice_no = $row_payments['invoice_no'];

$amount = $row_payments['amount'];

$payment_mode = $row_payments['payment_mode'];

$ref_no = $row_payments['ref_no'];

$code = $row_payments['code'];

$payment_date = $row_payments['payment_date'];

$i++;


?>


              <tr>

                <td><?php echo $i; ?></td>

                <td style="color: white; font-weight: bold; background-color: #088178">
                  <?php echo $invoice_no; ?></td>

                <td>$<?php echo $amount; ?></td>

                <td><?php echo $payment_mode; ?></td>

                <td><?php echo $ref_no; ?></td>

                <td><?php echo $code; ?></td>

                <td><?php echo $payment_date; ?></td>

                <td class="button delete">

                  <a href="index.php?payment_delete=<?php echo $payment_id; ?>">

                    <i class="fa fa-trash-o"></i>

                  </a>

                </td>


              </tr>


              <?php } ?>

            </tbody><!-- tbody ends -->

          </table><!-- table table-hover table-bordered table-striped ends -->

        </div><!-- table-responsive ends -->

      </div><!-- panel-body ends -->

    </div><!-- panel panel-default ends -->

  </div><!-- col-lg-12 ends -->

</div><!-- 2 row ends -->


<?php } ?>