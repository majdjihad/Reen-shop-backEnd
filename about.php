<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reen | About</title>
    <!-- Link Main CSS -->
    <link rel="stylesheet" href="./css/main.css">
    <!-- Link Icon Title -->
    <link rel="icon" type="video/x-icon" href="./images/logo.png">
    <?php require './components/librarys.php' ?>
</head>
<body>
  <!-- Start About page  -->
    <!-- Start Header -->
    <?php
      $active = "about";
      require "./components/header.php";
    ?>
    <!-- Start Header -->
      <!-- Start About Section  -->
      <section class="about">
          <div class="container py-5">
              <div class="row align-items-center py-5">
                  <div class="col-12 col-md-8 text-white mb-4">
                      <p class="h1 mb-3">About Us</p>
                      <p class="fs-5 fw-light">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                    </div>
                    <div class="col-12 col-md-4">
                        <img src="./images/about-hero.svg" alt="...">
                    </div>
                </div>
            </div>
        </section>
        <!-- End About Section  -->
        <!-- Start Services Section -->
        <section class="services">
            <div class="container py-5">
                <div class="title-section col-lg-6 m-auto pt-5 text-center">
                    <p class="fw-light fs-1">Our Services</p>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod Lorem ipsum dolor sit amet</p>
                </div>
                <div class="row mt-5">
                    <div class="col-md-6 col-lg-3 pb-3 px-md-2">
                        <div class="shadow text-center h-100 py-5 box-services">
                            <div class="icon-services">
                                <i class="fa-solid fa-truck"></i>
                            </div>
                            <p class="fw-bold fs-4">Delivery Services</p>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3 pb-3 px-md-2">
                        <div class="shadow text-center h-100 py-5 box-services">
                            <div class="icon-services">
                                <i class="fa-solid fa-arrow-right-arrow-left"></i>
                            </div>
                            <p class="fw-bold fs-4">Shipping & Return</p>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3 pb-3 px-md-2">
                        <div class="shadow text-center h-100 py-5 box-services">
                            <div class="icon-services">
                                <i class="fa-solid fa-percent"></i>
                            </div>
                            <p class="fw-bold fs-4">Promotion</p>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3 pb-3 px-md-2">
                        <div class="shadow text-center h-100 py-5 box-services">
                            <div class="icon-services">
                                <i class="fa-solid fa-plug"></i>
                            </div>
                            <p class="fw-bold fs-4">24 Hours Services</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- End Services Section -->
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