<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="icon" type="video/x-icon" href="../images/logo.png">
        <title>Reen | Update-Product</title>
        <?php

use function PHPSTORM_META\type;

 require '../components/librarys.php' ?>
    </head>
    <body>
    <?php
            require '../components/nav-admin.php';
            if(isset($_GET['id'])) {
                $idProduct = $_GET['id'];
                $selectProduct = "SELECT * FROM products where id = ?";
                $resultSelectProduct = $database->prepare($selectProduct);
                $resultSelectProduct->bind_param("s", $idProduct);
                $resultSelectProduct->execute();
                $rowProduct = $resultSelectProduct->get_result();
                $product = $rowProduct->fetch_assoc();
                if($rowProduct->num_rows == 1) {
                    $current_title = $product['title'];
                    $current_description = $product['description'];
                    $current_price = $product['price'];
                    $current_quantity = $product['quantity'];
                    $current_size = $product['size'];
                    $arraySize = explode(',',str_replace(['[', '"', ']'],'',$current_size));
                    $current_active = $product['active'];
                    $current_featured = $product['featured'];
                    $current_idBrand = $product['brand_id'];
                    $current_gender = $product['gender'];
                    $current_image_path = $product['image_main'];
                    $current_sub_images_paths = $product['images_sub'];
                    if(isset($_POST['updateProduct'])) {
                        $new_title = htmlspecialchars($_POST['title']);
                        $new_description = htmlspecialchars($_POST['description']);
                        $new_price = htmlspecialchars($_POST['price']);
                        $new_quantity = htmlspecialchars($_POST['quantity']);
                        $new_active = htmlspecialchars($_POST['active']);
                        $new_featured = htmlspecialchars($_POST['featured']);
                        $new_brand_id = htmlspecialchars($_POST['brand']);
                        $new_gender = htmlspecialchars($_POST['gender']);
                        $random = $idProduct[mt_rand(0,strlen($idProduct) -1)];
                        
                        if (isset($_FILES['image']) && $_FILES['image']['name'] != '') {
                            $name = $_FILES['image']['name'];
                            $tmp_name = $_FILES['image']['tmp_name'];
                            $type_img = explode('.', $name);
                            $type_img = end($type_img);
                            $main_image_path =  "../images/products_images/".$new_title . $random . "." . $type_img;
                            move_uploaded_file($tmp_name, $main_image_path);
                        } else {
                            $main_image_path = $current_image_path;
                        }
                        $imagesSub = [];
                        if(isset($_FILES['images']) && !empty(array_filter($_FILES['images']['name']))) {
                            $count = 1;
                            foreach($_FILES['images']['name'] as $key=>$value) {
                                $path = $new_title.'-subImage'.$count;
                                $name = $_FILES['images']['name'][$key];
                                $tmp_name = $_FILES['images']['tmp_name'][$key];
                                $type_img = explode('.',$name);
                                $type_img = end($type_img);
                                $sub_image_path = '../images/products_images/'.$new_title.$random.$key.".".$type_img;
                                $sub_image_path = strval($sub_image_path);
                                array_push($imagesSub,$sub_image_path);
                                move_uploaded_file($tmp_name,$sub_image_path);
                                $jsonSubImages = str_replace(['[', '"', '\\', ']'], "",json_encode($imagesSub));
                                $count++;
                            }
                        } else {
                            $jsonSubImages = $current_sub_images_paths;
                        }
                        $selectedOptions = isset($_POST['size']) ? $_POST['size'] : array();
                        $jsonStringSelectedOptions = json_encode($selectedOptions);
                        if($jsonStringSelectedOptions == "[]") {
                            $jsonStringSelectedOptions = $current_size;
                        }
                        if($new_price > 0 && $new_quantity > 0) {
                            $insertQuery = "UPDATE products SET title = ?, description = ?, price = ?, quantity = ?, image_main = ?, brand_id = ?, gender = ?, images_sub = ?, size = ?, active = ?, featured = ? where id = ?";
                            $insertStmt = $database->prepare($insertQuery);
                            $insertStmt->bind_param("ssiissssssss", $new_title, $new_description, $new_price, $new_quantity, $main_image_path, $new_brand_id, $new_gender, $jsonSubImages, $jsonStringSelectedOptions, $new_active, $new_featured, $idProduct);
                            $insertStmt->execute();
                            if($insertStmt) {
                                get_session_success("updateProductStatus","Successfully as Product Update");
                                header("location:manage-products.php");
                            } else {                
                                get_session_danger("updateProductStatus","Product Updated failed");
                                header("location:manage-products.php");
                            }  
                          } else {
                            echo '<h1 class="alert alert-danger fs-4 text-center w-auto">No Found Prices or Quantity</h1>';
                          }
                    }
                } else {
                    header("location:manage-products");
                }
            }
        ?>
        <div class="container">
        <h4 class="mt-3 text-center fs-1">Update product</h4>
        <div id="carouselExampleDark" class="carousel carousel-dark slide mt-4 w-75 m-auto" data-bs-ride="carousel">
                <div class="carousel-indicators">
                <?php
                    $arrayImage = explode(',',$current_sub_images_paths);
                    foreach($arrayImage as $key=>$path) {
                        if($key == 0) {
                            echo '
                                <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="0" class="active bg-white" aria-current="true" aria-label="Slide 1"></button>';
                        } else {
                            echo '
                            <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="'.$key.'" class="bg-white" aria-label="Slide '.($key+1).'"></button>';
                        }
                    }?>
                </div>
                <div class="carousel-inner">
        <?php
        foreach($arrayImage as $key=>$path) {
            if($key == 0) {
                echo '
                    <div class="carousel-item active" data-bs-interval="10000">
                        <img src="'.$arrayImage[$key].'" class="d-block w-100" alt="...">
                        <div class="carousel-caption">
                            <h5 class="text-muted fs-1">main Cover</h5>
                        </div>
                    </div>
                ';
            } else {
                echo '
                <div class="carousel-item" data-bs-interval="2000">
                    <img src="'.$arrayImage[$key].'" class="d-block w-100" alt="...">
                </div>
                ';
            }
        }
    ?>
  </div>
  <button class="carousel-control-prev d-none d-md-block" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next d-none d-md-block" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>
        <form class="col-12 col-lg-6 mt-4" method="POST" enctype="multipart/form-data">
                    <div class="col-12 mt-4">
                        <label for="title" class="form-label">title</label>
                        <input type="text" class="form-control" id="title" name="title"  value="<?php echo $current_title; ?>" required>
                    </div>
                    <div class="col-12 mt-4">
                        <label for="description" class="form-label">description</label>
                        <textarea class="form-control" name="description" id="description" cols="20" rows="5">
                            <?php echo trim($current_description); ?>
                        </textarea>
                    </div>
                    <div class="col-12 row g-3 mt-4">
                    <div class="col-12 col-sm-6">
                    <label for="brand" class="form-label">Select Brand</label>
                      <select class="form-select" an aria-label="Default select example" id="brand" name="brand" required>
                        <?php
                          $querySelect = "SELECT * FROM brands";
                          $resultQuerySelect = $database->query($querySelect);
                          if($resultQuerySelect->num_rows > 0) {
                              while($row = $resultQuerySelect->fetch_assoc()) {
                                $idBrand = $row['id'];
                                $nameBrand = $row['name'];
                                if($current_idBrand == $idBrand) {
                                    echo '
                                    <option value='.$idBrand.' selected>'.$nameBrand.'</option>';                            
                                } else {
                                    echo '
                                    <option value='.$idBrand.'>'.$nameBrand.'</option>';                            
                                }
                              }
                          }
                        ?>
                        </select>
                    </div>
                    <div class="col-12 col-sm-6">
                        <label for="gender" class="form-label">gender</label>
                        <select class="form-select" name="gender" id="gender" aria-label="Default select example">
                            <option value="Male" <?php echo $current_gender == "Male"? "selected": "";  ?>>Male</option>
                            <option value="Female" <?php echo $current_gender == "Female"? "selected": "";  ?>>Female</option>
                        </select>
                      </div>

                    </div>
                    <div class="col-12 row g-3 mt-4">
                      <div class="col-12 col-sm-6">
                          <label for="price" class="form-label">price</label>
                          <input type="number" class="form-control" name="price" id="price" value="<?php echo $current_price; ?>" required>
                      </div>
                      <div class="col-12 col-sm-6">
                        <label for="quantity" class="form-label">quantity</label>
                        <input type="number" class="form-control" name="quantity" id="quantity" value="<?php echo $current_quantity; ?>" required>
                      </div>
                    </div>
            <div class="col-12 mt-4">
              <p>
                <button class="btn border-secondary col-12" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                  Select Products size
                </button>
              </p>
              <div class="collapse" id="collapseExample">
                <div class="card card-body border-0">
                    <select name="size[]" class="form-select" id="size" aria-label="Default select example" multiple>
                      <option  <?php echo in_array("s",$arraySize)? "selected":""; ?> value="s">S</option>
                      <option  <?php echo in_array("m", $arraySize)? "selected":""; ?> value="m">M</option>
                      <option  <?php echo in_array("l", $arraySize)? "selected":""; ?> value="l">L</option>
                      <option  <?php echo in_array("xl", $arraySize)? "selected":""; ?> value="xl">XL</option>
                      <option  <?php echo in_array("xll", $arraySize)? "selected":""; ?> value="xll">XLL</option>
                      <option  <?php echo in_array('xlll', $arraySize)? "selected":""; ?> value="xlll">XLLL</option>
                    </select>
                </div>
              </div>
            </div>
            <div class="col-12 row g-3 mt-4">
                <div class="col-12 col-sm-6">
                    <label for="formFileLg" class="form-label">New main image</label>
                    <input type="file" class="form-control" name="image"  id="formFileLg" >
                </div>
                <div class="col-12 col-sm-6">
                    <label class="form-label" for="subImages">New sub Images</label>
                    <input type="file" class="form-control" id="subImages" name="images[]" accept="image/*" multiple >
                </div>
            </div>
            <div class="col-12 row g-3 m-auto mt-4">
                  <div class="form-check p-0 col-12 row d-flex">
                    <div class="col-4">Active:</div>
                    <div class="col-4">
                      <label class="form-check-label">
                      <input class="form-check-input" type="radio" name="active" <?php echo $current_active == "yes"? "checked":""; ?> value="yes">
                        YES
                      </label>
                    </div>
                    <div class="col-4">
                      <label class="form-check-label">
                        <input class="form-check-input" type="radio" name="active" <?php echo $current_active == "no"? "checked":""; ?> value="no">
                        NO
                      </label>
                    </div>
                  </div>
                </div>
              <div class="col-12 row g-3 m-auto mt-4">
                <div class="form-check p-0 col-12 row d-flex">
                  <div class="col-4">Featured:</div>
                  <div class="col-4">
                    <label class="form-check-label">
                    <input class="form-check-input" type="radio" name="featured" <?php echo $current_featured == "yes"? "checked":""; ?> value="yes">
                      YES
                    </label>
                  </div>
                  <div class="col-4">
                    <label class="form-check-label">
                    <input class="form-check-input" type="radio" name="featured" <?php echo $current_featured == "no"? "checked":""; ?> value="no">
                      NO
                    </label>
                  </div>
                </div>
              </div>
                <button class="btn btn-success col-12 col-md-auto fs-4 my-4" type="submit" name="updateProduct">Update Product</button>
            </form>
            <?php
        require '../components/footer-admin.php'
    ?>

        </div>
    </body>
</html>