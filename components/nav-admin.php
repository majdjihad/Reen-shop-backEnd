<!-- require constants -->
<?php
  require '../config/constants.php';
  require '../config/checkSignIn-admin.php';
  require '../config/session.php';
?>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
  <a href="../admin/index.php" class="nav-brand nav-link mx-4 text-decoration-none d-flex justify-content-center align-items-center logo">
                    <img src="../images/logo.png" alt="">
                    <p class="m-0 ms-2 fs-4 text-dark">Reen-Shop</p>
                </a>
        </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon">
      </span>
    </button>
    <div class="collapse navbar-collapse justify-content-center" id="navbarNavAltMarkup">
      <div class="navbar-nav align-items-center">
        <a class="nav-link mx-4 <?php echo $active == 'admins'? 'active': '' ?>" href="../admin/manage-admins.php">Admins</a>
        <a class="nav-link mx-4 <?php echo $active == 'brands'? 'active': '' ?>" href="../admin/manage-brands.php">Brands</a>
        <a class="nav-link mx-4 <?php echo $active == 'products'? 'active': '' ?>" href="../admin/manage-products.php">Products</a>
        <a class="nav-link mx-4 <?php echo $active == 'orders'? 'active': '' ?>" href="../admin/manage-orders.php">Orders</a>
        <a class="nav-link mx-4 <?php echo $active == 'massages'? 'active': '' ?>" href="../admin/manage-massages.php">Massages</a>
      </div>
    </div>
    <a class="nav-link mx-4" aria-current="page" href="../admin/logout-admin.php">
      <i class="fa-solid fa-arrow-right-from-bracket fs-3" title="Logout"></i>
    </a>
  </div>
</nav>
