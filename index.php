<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Reen | Home</title>
    <!-- Link Main CSS -->
    <link rel="stylesheet" href="./css/main.css">
    <!-- Link Icon Title -->
    <link rel="icon" type="video/x-icon" href="./images/logo.png">
    <?php require './components/librarys.php' ?>
  </head>
  <body>
    <!-- Start Home Page -->
    <!-- Start Header -->
    <?php
      $active = "home";
      require "./components/header.php";
      if(isset($_SESSION['addUserStatus'])) {
        echo $_SESSION['addUserStatus'];
        unset($_SESSION['addUserStatus']);
      }    
    ?>
    <!-- Start Header -->
    <!-- Start slides -->
    <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="false">
        <div class="carousel-indicators">
          <button class="bg-success active" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" aria-current="true" aria-label="Slide 1"></button>
          <button class="bg-success" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
          <button class="bg-success" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
          <div class="carousel-item active hight-slide">
            <div class="container">
                <div class="row p-5 d-flex justify-content-between align-items-center">
                    <div class="d-none d-md-block col-lg-6 col-md-6 text-carousel">
                      <h1 class="text-success"><b>Reen</b> ECommerce</h1>
                      <p>Tiny and Perfect eCommerce Template</p>
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <img src="./images/banner_img_01.jpg" class="d-block w-100" alt="...">
                    </div>
                </div>
            </div>          
        </div>
          <div class="carousel-item hight-slide">
            <div class="container">
                <div class="row p-5 d-flex justify-content-between align-items-center">
                    <div class="d-none d-md-block col-lg-6 col-md-6 text-carousel">
                      <h1>Aliquip ex ea commodo consequat</h1>
                      <p class="fs-4">Aliquip ex ea commodo consequat</p>
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <img src="./images/banner_img_02.jpg" class="d-block w-100" alt="...">
                    </div>
                </div>
            </div>
          </div>
          <div class="carousel-item hight-slide">
            <div class="container">
                <div class="row p-5 d-flex justify-content-between align-items-center">
                    <div class="d-none d-md-block col-lg-6 col-md-6 text-carousel">
                      <h1>Repr in voluptate</h1>
                      <p>Ullamco laboris nisi ut</p>
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <img src="./images/banner_img_03.jpg" class="d-block w-100" alt="...">
                    </div>
                </div>
            </div>
          </div>
        <button class="carousel-control-prev d-none d-md-block" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
          <span class="text-success" aria-hidden="true"><i class="fa-solid fa-angle-left"></i></span>
          <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next move-slide d-none d-md-block" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
          <span class="text-success" aria-hidden="true"><i class="fa-solid fa-angle-right"></i></span>
          <span class="visually-hidden">Next</span>
        </button>
      </div>
    </div>
    <!-- End slides -->
    <!-- Start categories -->
    <section class="container py-5">
      <div class="title-section text-center col-lg-6 m-auto pt-4">
        <p class="fw-light fs-1">Categories of The Month</p>
        <p>Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>    
      </div>
      <div class="row mt-3">
        <?php
          $querySelect = "SELECT * FROM brands LIMIT 3";
          $resultQuerySelect = $database->query($querySelect);
            if($resultQuerySelect->num_rows > 0) {
              while($row = $resultQuerySelect->fetch_assoc()) {
                $idBrand = $row['id'];
                $title = $row['name'];
                $image_path = $row['image'];
                echo '
                <div class="col-12 col-lg-4 col-md-4 p-5">
                <a href="brand-products.php?brand='.$idBrand.'">
                  <img src="'.substr($image_path, 1, strlen($image_path)).'" alt="'.$title.'" class="rounded-circle border img-fluid">
                </a>
                <p class="h2 text-center mt-4 mb-4">'.$title.'</p>
                <p class="text-center">
                  <a href="brand-products.php?brand='.$idBrand.'" class="btn btn-success fs-4">Go Shop</a>
                </p>
              </div>';
              }
              echo '<a href="brand.php" class="h3 text-dark w-auto m-auto mt-4 text-decoration-none">read more</a>';
            } else {
              echo '<p class="text-center h3">No Found Brands</p>';
            }
        ?>
      </div>
    </section>
    <!-- End categories -->
    <section class="featured bg-light">
<div class="container py-5">
    <div class="title-section text-center col-lg-6 m-auto pt-4">
      <p class="fw-light fs-1">Featured Product</p>
      <p>Reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident.</p>
    </div>
    <div class="row">
      <?php 
          $querySelect = "SELECT * FROM products LIMIT 3";
          $resultQuerySelect = $database->query($querySelect);
          if($resultQuerySelect->num_rows > 0) {
            while($row = $resultQuerySelect->fetch_assoc()) {
              $idProduct = $row['id'];
              $title = $row['title'];
              $description = $row['description'];
              $image = $row['image_main'];
              $price = $row['price'];
              $size = $row['size'];
              $type_model = $row['gender'];
              echo '
              <div class="col-md-6 col-lg-4 m-auto mb-5">
                <div class="card my-4 p-0 shadow h-100">
                <a href="product.php?product='.$idProduct.'">
                  <img src="'.substr($image, 1, strlen($image)).'" alt="'.$title.'" class="card-img-top">
                </a>
                <div class="card-body p-3">
                  <div class="d-flex justify-content-between align-items-baseline">
                    <div>
                      <i class="fa-solid fa-star text-warning fs-5"></i>
                      <i class="fa-solid fa-star text-warning fs-5"></i>
                      <i class="fa-solid fa-star text-warning fs-5"></i>
                      <i class="fa-solid fa-star text-muted fs-5"></i>
                      <i class="fa-solid fa-star text-muted fs-5"></i>
                    </div>
                    <p class="text-muted fs-4 fw-lighter">$'.$price.'00</p>
                  </div>
                  <a href="product.php?product='.$idProduct.'" class="text-decoration-none">
                    <p class="card-title fs-3 text-dark fs-4">'.$title.'</p>
                  </a>
                  <p class="card-text fs-5 text-secondary fs-5">'.substr(trim($description), 0, 80).'</p>
                  <p class="text-muted fs-4">Reviews (24)</p>
                </div>
              </div>
              </div>
                ';
              }
              echo '<a href="shop.php" class="h3 text-dark w-auto m-auto mt-4 text-decoration-none">read more</a>';
            } else {
              echo '<p class="text-center h3">No Found Brands</p>';
            }
        ?>
  </div>
</section>
    <!-- Start Brand -->
    <?php
    require "./components/brand.php";
  ?>
  <!-- End Brand -->
  <!-- Start Footer -->
  <?php
    require "./components/footer.php";
  ?>
  <!-- End Footer -->
    <script src="./js/main.js"></script>
  </body>
</html>