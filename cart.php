<?php

session_start();

include("includes/db.php");
include("includes/header.php");
include("functions/functions.php");
include("includes/main.php");

?>


<!-- MAIN -->
<main>
  <div class="header" style="width:100%; text-alignment: center;">
    <h1>Your Cart</h1>
  </div>
</main>



<div id="content">
  <!-- content Starts -->
  <div class="container cart_container">
    <!-- container Starts -->



    <div class="cart" id="cart">
      <!-- col-md-9 Starts -->
      <form action="cart.php" method="post" enctype="multipart-form-data">
        <!-- form Starts -->

        <h1> Shopping Cart </h1>

        <?php

              $ip_add = getRealUserIp();

              $select_cart = "select * from cart where ip_add='$ip_add'";

              $run_cart = mysqli_query($con,$select_cart);

              $count = mysqli_num_rows($run_cart);

              ?>
        <!-- <div class="table-responsive"> -->
        <!-- table-responsive Starts -->

        <table class="table">
          <!-- table Starts -->

          <thead>
            <!-- thead Starts -->

            <tr>

              <th colspan="2">Product</th>

              <th>Quantity</th>

              <th>Unit Price</th>

              <th>Size</th>

              <th colspan="1">Delete</th>

              <th colspan="2"> Sub Total </th>


            </tr>

          </thead><!-- thead ends -->

          <tbody>
            <!-- tbody Starts -->

            <?php

                  $total = 0;

                  while($row_cart = mysqli_fetch_array($run_cart)){

                  $pro_id = $row_cart['p_id'];

                  $pro_size = $row_cart['size'];

                  $pro_qty = $row_cart['qty'];

                  $only_price = $row_cart['p_price'];

                  $get_products = "select * from products where product_id='$pro_id'";

                  $run_products = mysqli_query($con,$get_products);

                  while($row_products = mysqli_fetch_array($run_products)){

                  $product_title = $row_products['product_title'];

                  $product_img1 = $row_products['product_img1'];

                  $sub_total = $only_price*$pro_qty;

                  $_SESSION['pro_qty'] = $pro_qty;

                  $total += $sub_total;

                  ?>

            <tr>
              <!-- tr Starts -->

              <td>

                <img src="product_images/<?php echo $product_img1; ?>">

              </td>

              <td>

                <a href="#" class='product_title'> <?php echo $product_title; ?> </a>

              </td>

              <td>
                <input type="text" name="quantity" value="<?php echo $_SESSION['pro_qty']; ?>"
                  data-product_id="<?php echo $pro_id; ?>" class="quantity form-control">
              </td>

              <td>

                ₱<?php echo $only_price; ?>.00

              </td>

              <td>

                <?php echo $pro_size; ?>

              </td>

              <td>
                <input type="checkbox" name="remove[]" value="<?php echo $pro_id; ?>">
              </td>

              <td>

                ₱<?php echo $sub_total; ?>.00

              </td>

            </tr><!-- tr ends -->

            <?php } } ?>

          </tbody><!-- tbody ends -->

          <tfoot>
            <!-- tfoot Starts -->

            <tr>

              <th colspan="5"> Total </th>

              <th colspan="2"> ₱<?php echo $total; ?>.00 </th>

            </tr>

          </tfoot><!-- tfoot ends -->

        </table><!-- table ends -->

        <div class="box-footer">
          <!-- box-footer Starts -->

          <div class="pull-left">
            <!-- pull-left Starts -->

            <a href="index.php" class="btn btn-default continue_btn">
              Continue Shopping
            </a>

          </div><!-- pull-left ends -->

          <div class="pull-right">
            <!-- pull-right Starts -->

            <button class="btn btn-info updata_btn" type="submit" name="update" value="Update Cart">
              Update Cart

            </button>

            <a href="checkout.php" class="btn btn-success checkout_btn">

              Proceed to Checkout

            </a>

          </div><!-- pull-right ends -->

        </div><!-- box-footer ends -->

      </form><!-- form ends -->
      <?php

if(isset($_POST['apply_coupon'])){

$code = $_POST['code'];

if($code == ""){


}
else{

$get_coupons = "select * from coupons where coupon_code='$code'";

$run_coupons = mysqli_query($con,$get_coupons);

$check_coupons = mysqli_num_rows($run_coupons);

if($check_coupons == 1){

$row_coupons = mysqli_fetch_array($run_coupons);

$coupon_pro = $row_coupons['product_id'];

$coupon_price = $row_coupons['coupon_price'];

$coupon_limit = $row_coupons['coupon_limit'];

$coupon_used = $row_coupons['coupon_used'];


if($coupon_limit == $coupon_used){

echo "<script>alert('Your Coupon Code Has Been Expired')</script>";

}
else{

$get_cart = "select * from cart where p_id='$coupon_pro' AND ip_add='$ip_add'";

$run_cart = mysqli_query($con,$get_cart);

$check_cart = mysqli_num_rows($run_cart);


if($check_cart == 1){

$add_used = "update coupons set coupon_used=coupon_used+1 where coupon_code='$code'";

$run_used = mysqli_query($con,$add_used);

$update_cart = "update cart set p_price='$coupon_price' where p_id='$coupon_pro' AND ip_add='$ip_add'";

$run_update = mysqli_query($con,$update_cart);

echo "<script>alert('Your Coupon Code Has Been Applied')</script>";

echo "<script>window.open('cart.php','_self')</script>";

}
else{

echo "<script>alert('Product Does Not Exist In Cart')</script>";

}

}

}
else{

echo "<script> alert('Your Coupon Code Is Not Valid') </script>";

}

}


}


?>

      <?php

function update_cart(){

global $con;

if(isset($_POST['update'])){

foreach($_POST['remove'] as $remove_id){


$delete_product = "delete from cart where p_id='$remove_id'";

$run_delete = mysqli_query($con,$delete_product);

if($run_delete){
echo "<script>window.open('cart.php','_self')</script>";
}
}
}
}

echo @$up_cart = update_cart();



?>

      <!-- </div> -->
      <!-- row same-height-row ends -->


    </div><!-- col-md-9 ends -->

    <div class="order_summary_container">
      <!-- col-md-3 Starts -->

      <div class="box-header">
        <!-- box-header Starts -->

        <h3>Order Summary</h3>

      </div><!-- box-header ends -->

      <p class="text-muted">
        Shipping and additional costs are calculated based on the values you have entered.
      </p>

      <div class="table-responsive">
        <!-- table-responsive Starts -->

        <table class="table">
          <!-- table Starts -->

          <tbody>
            <!-- tbody Starts -->

            <tr>

              <td> Order Subtotal </td>

              <th> ₱<?php echo $total; ?>.00 </th>

            </tr>

            <tr>

              <td> Shipping and handling </td>

              <th>₱0.00</th>

            </tr>

            <tr>

              <td>Tax</td>

              <th>₱0.00</th>

            </tr>

            <tr class="total">

              <td>Total</td>

              <th>₱<?php echo $total; ?>.00</th>

            </tr>

          </tbody><!-- tbody ends -->

        </table><!-- table ends -->

      </div><!-- table-responsive ends -->
    </div><!-- col-md-3 ends -->

  </div><!-- container ends -->
</div><!-- content ends -->



<?php

include("includes/footer.php");

?>

<script src="js/jquery.min.js"> </script>

<script src="js/bootstrap.min.js"></script>

<script>
$(document).ready(function(data) {

  $(document).on('keyup', '.quantity', function() {

    var id = $(this).data("product_id");

    var quantity = $(this).val();

    if (quantity != '') {

      $.ajax({

        url: "change.php",

        method: "POST",

        data: {
          id: id,
          quantity: quantity
        },

        success: function(data) {

          $("body").load('cart_body.php');

        }




      });


    }




  });




});
</script>

</body>

</html>