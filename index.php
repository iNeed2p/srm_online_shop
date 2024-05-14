<?php

session_start();

include("includes/db.php");
include("includes/header.php");
include("functions/functions.php");
include("includes/main.php");

?>


<!-- Cover -->
<main>
  <div class="hero">
    <div class="heading">
      <div class="headers">
        <h4>Trade-in-Offers</h4>
        <h2>Super <br> <span>Value Deals</span></h2>
        <h1>On All Products</h1>
      </div>
      <a href="shop.php" class="btn1">View all products</a>
    </div>
  </div>
  <!-- Main -->
  <div class="wrapper featured_collection">
    <h1>Featured Collection</h1>
    <div id="content" class="container product_container">
      <!-- container Starts -->
      <?php getPro();?>
    </div>
  </div><!-- container ends -->
  <!-- FOOTER -->
  <footer class="footer_container">
    <div class="footer">

      <p class="copyright">
        &copy; <?php echo date("Y");?> SRM Online Shop&trade;
      </p>

      <p class="group">Group Project</p>

    </div>
  </footer>
  </body>

  </html>