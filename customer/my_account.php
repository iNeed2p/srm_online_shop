<?php

session_start();

if(!isset($_SESSION['customer_email'])){
    echo "<script>window.open('../checkout.php','_self')</script>";
} else {
    include("includes/db.php");
    include("../includes/header.php");
    include("functions/functions.php");
    include("includes/main.php");
?>

<main>
  <div class="header user_header">
    <h1 class="heading">My Account</h1>
  </div>
  <div id="content" class="account_container">
    <!-- content Starts -->
    <div class="account">
      <!-- container Starts -->

      <div class="warning_header">
        <?php
                $c_email = $_SESSION['customer_email'];
                $get_customer = "select * from customers where customer_email='$c_email'";
                $run_customer = mysqli_query($con,$get_customer);
                $row_customer = mysqli_fetch_array($run_customer);
                $customer_confirm_code = $row_customer['customer_confirm_code'];
                $c_name = $row_customer['customer_name'];
                if(!empty($customer_confirm_code)){
        ?>
        <div class="alert alert-danger">
          <!-- alert alert-danger Starts -->
          <strong> Warning! </strong> Please Confirm Your Email and if you have not received your confirmation email
          <a href="my_account.php?send_email" class="alert-link">Send Email Again</a>
        </div><!-- alert alert-danger ends -->
        <?php } ?>
      </div>

      <div class="group">

        <div class="sidebar">
          <?php include("includes/sidebar.php"); ?>
        </div>

        <div class="orders">
          <div class="box">
            <!-- box Starts -->
            <?php
                    if(isset($_GET[$customer_confirm_code])){
                        $update_customer = "update customers set customer_confirm_code='' where customer_confirm_code='$customer_confirm_code'";
                        $run_confirm = mysqli_query($con,$update_customer);
                        echo "<script>alert('Your Email Has Been Confirmed')</script>";
                        echo "<script>window.open('my_account.php?my_orders','_self')</script>";
                    }
                    if(isset($_GET['send_email'])){
                        $subject = "Email Confirmation Message";
                        $from = "sad.ahmed22224@gmail.com";
                        $message = "
                            <h2>Email Confirmation By Computerfever.com $c_name</h2>
                            <a href='localhost/srm_store/customer/my_account.php?$customer_confirm_code'>Click Here To Confirm Email</a>
                        ";
                        $headers = "From: $from \r\n";
                        $headers .= "Content-type: text/html\r\n";
                        mail($c_email,$subject,$message,$headers);
                        echo "<script>alert('Your Confirmation Email Has Been sent to you, check your inbox')</script>";
                        echo "<script>window.open('my_account.php?my_orders','_self')</script>";
                    }
                    if(isset($_GET['my_orders'])){
                        include("my_orders.php");
                    }
                    if(isset($_GET['pay_offline'])) {
                        include("pay_offline.php");
                    }
                    if(isset($_GET['edit_account'])) {
                        include("edit_account.php");
                    }
                    if(isset($_GET['change_pass'])){
                        include("change_pass.php");
                    }
                    if(isset($_GET['delete_account'])){
                        include("delete_account.php");
                    }
                    if(isset($_GET['my_wishlist'])){
                        include("my_wishlist.php");
                    }
                    if(isset($_GET['delete_wishlist'])){
                        include("delete_wishlist.php");
                    }
                    ?>
          </div><!-- box ends -->
        </div>
      </div>

    </div><!-- container ends -->
  </div><!-- content ends -->
</main>

<script src="js/jquery.min.js"> </script>
<script src="js/bootstrap.min.js"></script>

</body>

</html>

<?php } ?>