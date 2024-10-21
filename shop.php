<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reen | Shop</title>
    <!-- Link Main CSS -->
    <link rel="stylesheet" href="./css/main.css">
    <!-- Link Icon Title -->
    <link rel="icon" type="video/x-icon" href="./images/logo.png">
    <?php require './components/librarys.php' ?>
</head>
<body>
    <!-- Start shop page -->
    <!-- Start Header -->
    <?php
      $active = 'shop';
      require './components/header.php';
      ?>
    <!-- Start products Shop section -->
    <section class="products-shop bg-light">
      <div class="container-fluid py-5">
              <!-- End Categories -->
              <div class="col-12">
                  <div class="row products justify-content-center">
                    <?php
                      $startLimitProducts = 0;
                      $querySelect = "SELECT * FROM products WHERE active = 'yes'";
                      $resultQuerySelect = $database->query($querySelect);
                        if($resultQuerySelect->num_rows > 0) {
                          while($row = $resultQuerySelect->fetch_assoc()) {
                            $idProduct = $row['id'];
                            $title = $row['title'];
                            $description = $row['description'];
                            $image_path = $row['image_main'];
                            $price = $row['price'];
                            $size = $row['size'];
                            $type_model = $row['gender'];
                            echo '
                            <div class="col-lg-3 col-md-4 col-sm-6 col-12 mt-4 product-item text-decoration-none text-black active" gender="'.$type_model.'">
                              <div class="card p-0 mb-3 shadow">
                              <a href = "./product.php?product='.$idProduct.'">
                              <img src="'.substr($image_path, 1, strlen($image_path)).'" class="card-img-top product-item-img ">
                            </a>
                          <div class="card-body p-4 px-3">
                            <div class="col-12 row m-0 d-flex align-items-center">
                              <h4 class="col-8 card-title p-0 fw-light">'.$title.'</h4>
                              <h4 class="col-4 text-center m-0 text-danger fw-bold price">$'.$price.'.99</h4>
                            </div>
                          <p class="col-12 card-text text-muted my-2">'.substr(trim($description), 0, 80).'...</p>
                          <div class="col-12 row justify-content-between align-items-center m-0">
                            <ul class="w-auto list-unstyled text-center m-0 mt-3 p-0 d-flex justify-content-start align-items-center">
                              <li class="fa-regular fa-star li-start ms-1 evaluation-start"></li>
                              <li class="fa-regular fa-star li-start ms-1 evaluation-start"></li>
                              <li class="fa-regular fa-star li-start ms-1 evaluation-start"></li>
                              <li class="fa-regular fa-star li-start ms-1 evaluation-start"></li>
                              <li class="fa-regular fa-star li-start ms-1 evaluation-start"></li>
                            </ul>
                            <a href="./product.php?product='.$idProduct.'" class="w-auto mt-3 btn btn-dark w-auto">Buy Now</a>
                          </div>
                          </div>
                              </div>
                            </div>
                            ';
                          }
                        } else {
                          echo '<h1 class="fs-1 text-center">No Found Products</h1>';
                        }
                    ?>
                    <a href="#" class="text-center text-dark mt-4 h3">Read More</a>
                  </div>
              </div>
            </div>
        </div>
      </section>
    <!-- End products Shop section -->
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
    <!-- End shop page -->
    <script src="./js/shop.js"></script>
</body>
</html>