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
    ?>
    <!-- Start categories -->
    <section class="container py-5">
      <div class="title-section text-center col-lg-6 m-auto pt-4">
        <p class="fw-light fs-1">Categories of The Month</p>
        <p>Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>    
      </div>
      <div class="row mt-3">
        <?php
          $querySelect = "SELECT * FROM brands";
          $resultQuerySelect = $database->query($querySelect);
            if($resultQuerySelect->num_rows > 0) {
              while($row = $resultQuerySelect->fetch_assoc()) {
                $idBrand = $row['id'];
                $title = $row['name'];
                $image_path = $row['image'];
                echo '
                <div class="col-12 col-lg-4 col-md-4 p-5">
                <a href="shop.php?brand='.$idBrand.'">
                  <img src="'.substr($image_path, 1, strlen($image_path)).'" alt="'.$title.'" class="rounded-circle border img-fluid">
                </a>
                <p class="h2 text-center mt-4 mb-4">'.$title.'</p>
                <p class="text-center">
                  <a href="shop.php?brand='.$idBrand.'" class="btn btn-success fs-4">Go Shop</a>
                </p>
              </div>';
              }
            } else {
              echo '<p class="text-center h3">No Found Brands</p>';
            }
        ?>
      </div>
    </section>
    <!-- End categories -->
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