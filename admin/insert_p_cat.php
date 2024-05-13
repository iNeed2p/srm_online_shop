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

      <li>

        <i class="fa fa-dashboard"></i> Dashboard / Insert Products Category

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

          Insert Product Category

        </h3><!-- panel-title ends -->


      </div><!-- panel-heading ends -->


      <div class="panel-body">
        <!-- panel-body Starts -->

        <form class="form-horizontal" action="" method="post" enctype="multipart/form-data">
          <!-- form-horizontal Starts -->

          <div class="form-group">
            <!-- form-group Starts -->

            <label class="col-md-3 control-label">Product Category Title</label>

            <div class="col-md-6">

              <input type="text" name="p_cat_title" class="form-control">

            </div>

          </div><!-- form-group ends -->

          <div class="form-group">
            <!-- form-group Starts -->

            <label class="col-md-3 control-label">Show as Top Product Category</label>

            <div class="col-md-6">

              <input type="radio" name="p_cat_top" value="yes">

              <label> Yes </label>

              <input type="radio" name="p_cat_top" value="no">

              <label> No </label>

            </div>

          </div><!-- form-group ends -->

          <!-- <div class="form-group">


            <label class="col-md-3 control-label"> Select Product Category Image</label>

            <div class="col-md-6">

              <input type="file" name="p_cat_image" class="form-control">

            </div>

          </div> -->

          <div class="form-group">
            <!-- form-group Starts -->

            <label class="col-md-3 control-label"></label>

            <div class="col-md-6">

              <input type="submit" name="submit" value="Submit Now" class="btn btn-primary form-control">

            </div>

          </div><!-- form-group ends -->

        </form><!-- form-horizontal ends -->

      </div><!-- panel-body ends -->


    </div><!-- panel panel-default ends -->

  </div><!-- col-lg-12 ends -->

</div><!-- 2 row ends -->

<?php

if(isset($_POST['submit'])){

$p_cat_title = $_POST['p_cat_title'];

$p_cat_top = $_POST['p_cat_top'];

$insert_p_cat = "insert into product_categories (p_cat_title,p_cat_top) values ('$p_cat_title','$p_cat_top')";

$run_p_cat = mysqli_query($con,$insert_p_cat);

if($run_p_cat){

echo "<script>alert('New Product Category Has been Inserted')</script>";

echo "<script>window.open('index.php?view_p_cats','_self')</script>";

}



}



?>


<?php } ?>