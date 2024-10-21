<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>product</title>
    <!-- Link Swiper's CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.css"/>
    <!-- Swiper JS -->
    <script src="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.js"></script>
    <!-- Link Main CSS -->
    <link rel="stylesheet" href="./css/main.css">
    <!-- Link Icon Title -->
    <link rel="icon" type="video/x-icon" href="./images/logo.png">
    <?php require './components/librarys.php' ?>
</head>
<body>
    <!-- Start Product Page  -->
        <!-- Start Header -->
    <?php
        require "./components/header.php";
        require './config/session.php';
        if(isset($_GET['product'])) {
            $productId = $_GET['product'];
            $querySelect = "SELECT * FROM products WHERE id = ?";
            $resultQueryExecute = $database->prepare($querySelect);
            $resultQueryExecute->bind_param("s",$productId);
            $resultQueryExecute->execute();
            $resultQuerySelect = $resultQueryExecute->get_result();
            if($resultQuerySelect->num_rows == 1) {
                $product = $resultQuerySelect->fetch_assoc();
                $productId = $product['id'];
                $idBrand = $product['brand_id'];
                $title = $product['title'];
                $description = $product['description'];
                $previousPrice = $product['price'] + 20;
                $productPrice = $product['price'];
                $productTitle = $product['title'];
                $size = $product['size'];
                $arraySize = explode(',',str_replace(['[', '"', ']'],'',$size));
                $typeModel = $product['gender'];
                $productImagePath = $product['image_main'];
                $sub_images_paths = $product['images_sub'];
                // find brand name
                $querySelectBrand = "SELECT * FROM brands WHERE id = '$idBrand'";
                $resultQuerySelectBrand = $database->query($querySelectBrand);
                if($resultQuerySelectBrand->num_rows == 1) {
                    $brand = $resultQuerySelectBrand->fetch_assoc();
                    $brandName = $brand['name'];
                } else {
                    $brandName = "no Brand";
                }
            } else {
                echo '<p class="text-center h2 mt-5">Product Not Found</p>';
                exit();
            }
        } else {                      
            echo '<p class="text-center h2 mt-5">Product Not Found</p>';
            exit();
            header('location:index.php');
        }
    ?>
    <!-- Start Header -->
    <!-- Start product details -->
    <section class="product_details">
        <div class="container py-5">
            <div class="details row">
                <div class="images col-lg-6 pb-3">
                    <div class="card mb-3">
                        <img class="card-img-fluid rounded cover-img" src="<?php echo substr($productImagePath, 1, strlen($productImagePath)); ?>" alt="Main Image Product" id="product-detail">
                    </div>
                    <div class="row">
                        <div class="col-1 align-self-center d-none d-md-block">
                            <a href="#multi-item-example" role="button" data-bs-slide="prev">
                                <i class="text-dark fas fa-chevron-left"></i>
                                <span class="sr-only">Previous</span>
                            </a>
                        </div>
                        <div id="multi-item-example" class="col-10 carousel slide carousel-multi-item" data-bs-ride="carousel">
                            <!--Start Slides-->
                            <div class="carousel-inner product-links-wap" role="listbox">
                                <?php
                                    $arrayImage = explode(',',$sub_images_paths);
                                    ?>
                                    <div class="carousel-item active">
                                        <div class="row">
                                            <?php
                                                foreach($arrayImage as $key=>$path) {
                                                    if($key < 3) {
                                                        echo '
                                                        <div class="col-4">
                                                        <img src="'.substr($arrayImage[$key], 1, strlen($arrayImage[$key])).'" class="card-img img-fluid rounded child-img" alt="Product Image '.$key++.'">
                                                        </div>';
                                                    }
                                                }
                                            ?>
                                        </div>
                                    </div>
                                <div class="carousel-item">
                                    <div class="row">
                                        <?php
                                            foreach($arrayImage as $key=>$path) {
                                                if($key >= 3) {
                                                    echo '
                                                    <div class="col-4">
                                                    <img src="'.substr($arrayImage[$key], 1, strlen($arrayImage[$key])).'" class="card-img img-fluid rounded child-img" alt="Product Image '.$key++.'">
                                                    </div>';
                                                }
                                            }
                                        ?>
                                    </div>
                                </div>
                                <!--Second slide-->
                            </div>
                            <!--End Slides-->
                        </div>
                        <div class="col-1 align-self-center d-none d-md-block">
                            <a href="#multi-item-example" role="button" data-bs-slide="next">
                                <i class="text-dark fas fa-chevron-right"></i>
                                <span class="sr-only">Next</span>
                            </a>
                        </div>
                    </div>
                    </div>
                    <div class="col-lg-6 height-auto bg-light p-4 rounded shadow">
                        <p class="h1"><?php echo $title; ?></p>
                        <span class="fs-2 text-success price-product"><?php echo $productPrice; ?>.99</span>
                        <span class="fs-3 text-secondary">instead</span>
                        <span class="fs-2 text-secondary price-original text-decoration-line-through"><?php echo $previousPrice; ?>.99</span>    
                    <ul class="list-unstyled">
                        <li class="fa-solid fa-star fs-5 li-start text-warning"></li>
                        <li class="fa-solid fa-star fs-5 li-start text-warning"></li>
                        <li class="fa-solid fa-star fs-5 li-start text-warning"></li>
                        <li class="fa-regular fa-star fs-5 li-start text-dark"></li>
                        <li class="fa-regular fa-star fs-5 li-start text-dark"></li>
                    </ul>
                    <span class="py-2">Rating 4.8 | 36 Comments</span>
                    <p class="h2 py-2">Brand: <span class="text-muted"><?php echo strtoupper($brandName); ?></span></p>
                    <p class="h2 py-2">Description:</p>
                    <p class="h5 py-2 text-muted fw-light lh-base"><?php echo ucfirst($description); ?>.</p>
                    <p class="h2 py-2">Order details:</p>
                    <form action="" method="POST">
                    <div class="col-12 row m-0 py-2 px-5 d-flex justify-content-between align-items-center flex-wrap">
                        <p class="col-4 h3 m-0 py-2">Colors</p>
                        <ul class="col-8 list-unstyle colors m-0 p-0 py-2">
                            <li class="list-inline-item">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="color" id="red" value="red" required>
                                    <label class="form-check-label text-capitalize h5" for="red">
                                    red
                                    </label>
                                </div>
                            </li>
                            <li class="list-inline-item">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="color" id="greed" value="greed" required>
                                    <label class="form-check-label text-capitalize h5" for="greed">
                                    greed
                                    </label>
                                </div>
                            </li>
                            <li class="list-inline-item">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="color" id="white" value="white" required>
                                    <label class="form-check-label text-capitalize h5" for="white">
                                    white
                                    </label>
                                </div>
                            </li>
                            <li class="list-inline-item">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="color" id="black" value="black" required>
                                    <label class="form-check-label text-capitalize h5" for="black">
                                    black
                                    </label>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="col-12 row m-0 py-2 px-5 d-flex justify-content-between align-items-center flex-wrap">
                        <p class="col-4 h3 m-0 py-2">Size</p>
                        <ul class="col-8 list-unstyle colors m-0 p-0 py-2">
                            <?php
                                foreach($arraySize as $key=>$value) {
                                    echo '
                                        <li class="list-inline-item">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="size" id="'.$value.'" value="'.$value.'" required>
                                                <label class="form-check-label text-capitalize h5" for="'.$value.'">
                                                '.$value.'
                                                </label>
                                            </div>
                                        </li>
                                    ';
                                }
                            ?>
                        </ul>
                    </div>
                    <input type="submit" class="btn-addCart col-12 h2 btn btn-success fs-4 my-4" name="addCart" value="Add To Cart"></input>
                </div>
            </form>
            </div>
        </div>
    </section>
    <!-- End Product Section -->
    <!-- Start Slides Section -->
    <section class="Related_Products my-5">
        <div class="container swiper py-5 mySwiper">
            <p class="h1 mb-5">Related Products</p>
            <div class="swiper-wrapper">
            <?php
                $querySelect = "SELECT * FROM products WHERE gender = '$typeModel' and active = 'yes' LIMIT 0,9";
                $resultQuerySelect = $database->query($querySelect);
                if($resultQuerySelect->num_rows > 0) {
                    $counter = 1;
                    while($row = $resultQuerySelect->fetch_assoc()) {
                        $productId = $row['id'];
                        $title = $row['title'];
                        $description = $row['description'];
                        $image_path = $row['image_main'];
                        $price = $row['price'];
                        $size = $row['size'];
                        $type_model = $row['gender'];
                        echo '
                            <div class="product-item rounded shadow swiper-slide text-decoration-none text-black swiper-slide-next" role="group" aria-label="'.$counter.' / 12" data-swiper-slide-index="'.$counter.'">
                                <div class="p-0 mb-3">
                                    <img class="card-img-top product-item-img rounded-top" src="'.substr($image_path, 1, strlen($image_path)).'" alt="'.$title.'">
                                    <div class="card-body p-3">
                                        <p class="card-title fs-5 fw-light my-3 text-muted">'.$title.'</p>
                                        <ul class="list-unstyled text-center m-0">
                                            <li>
                                                <i class="fa-solid fa-star fs-4 text-warning"></i>
                                                <i class="fa-solid fa-star fs-4 text-warning"></i>
                                                <i class="fa-solid fa-star fs-4 text-warning"></i>
                                                <i class="fa-regular fa-star fs-4 text-dark"></i>
                                                <i class="fa-regular fa-star fs-4 text-dark"></i>
                                            </li>
                                        </ul>
                                        <p class="card-text fw-light h3 my-3">$'.$price.'.99</p>
                                        <a class="btn btn-success w-100" href="product.php?product='.$productId.'">Product Details</a>
                                    </div>
                                </div>
                            </div>';
                    }
                }
            ?>
            </div>
            <div class="swiper-button swiper-button-next d-none d-md-block"></div>
            <div class="swiper-button swiper-button-prev d-none d-md-block"></div>
            <div class="swiper-pagination"></div>
        </div>
    </section>
    <!-- End Slides Section  -->
    <?php
        if(isset($_POST['addCart'])) {
            $cartItemsId = create_unique_id();
            $productId = $_GET['product'];
            $choose_color = $_POST['color'];
            $choose_size = $_POST['size'];
            date_default_timezone_set("Asia/Gaza");
            $dateTime = date("Y/m/d h:i:sA");
            $queryInsert = "INSERT INTO orders SET order_id = '$cartItemsId', image_path= '$productImagePath', product_id = '$productId', product_title = '$productTitle', product_price = $productPrice, product_color = '$choose_color', product_size= '$choose_size', date = '$dateTime'";
            $resultQueryInsert = $database->query($queryInsert);
            if($resultQueryInsert) {
                get_session_success("addProductOfCartStatus","Successfully as add product to cart");
            } else {
                get_session_danger("addProductOfCartStatus","error as add product to cart,please try again!");
            }
        }
    ?>
    <?php
        //Start Brand
        require "./components/brand.php";
        //End Brand
    ?>
    <?php
        //Start Footer
        require "./components/footer.php";
        //End Footer
    ?>
    <!-- End Product Page  -->
    <script src="./js/product.js"></script>
</body>
</html>