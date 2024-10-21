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
      $active = 'cart';
      require './components/header.php';
      ?>
    <!-- Start products Shop section -->
    <section class="products-shop bg-light">
      <div class="container py-5">
              <!-- End Categories -->
              <div class="col-12">
                  <div class="row products">
                    <?php
                      $startLimitProducts = 0;
                      $querySelect = "SELECT * FROM orders";
                      $resultQuerySelect = $database->query($querySelect);
                        if($resultQuerySelect->num_rows > 0) {
                          while($row = $resultQuerySelect->fetch_assoc()) {
                            $idOrder = $row['order_id'];
                            $idProduct = $row['product_id'];
                            $title = $row['product_title'];
                            $image_path = $row['image_path'];
                            $price = $row['product_price'];
                            $color = $row['product_color'];
                            $size = $row['product_size'];
                            echo '
                            <div class="col-lg-3 col-md-4 col-sm-6 col-12 mt-4 product-item text-decoration-none text-black active">
                              <div class="card p-0 mb-3 shadow">
                              <a href = "./product.php?product='.$idProduct.'">
                              <img src="'.substr($image_path, 1, strlen($image_path)).'" class="card-img-top product-item-img ">
                            </a>
                          <div class="card-body p-4 px-3">
                            <div class="col-12 row m-0 d-flex align-items-center">
                              <h4 class="w-100 text-center m-0 fs-5 fw-bold">'.$title.'</h4>
                              <h4 class="w-100 text-center m-0 fs-5 text-success fw-bold price">$'.$price.'.99</h4>
                            </div>
                            <div class="col-12 row m-0 d-flex align-items-center">
                              <h4 class="col-8 card-title p-0 m-0 fw-light">'.$size.'</h4>
                              <h4 class="col-4 text-center fs-5 m-0 text-danger fw-bold">$'.$color.'</h4>
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