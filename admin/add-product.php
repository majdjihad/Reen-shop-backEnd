<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="icon" type="video/x-icon" href="../images/logo.png">
        <title>Reen | add-admin</title>
        /<?php require '../components/librarys.php' ?>
    </head>
    <body>
        <?php
            require '../components/nav-admin.php';
            if(isset($_POST['AddProduct'])) {
              $idProduct = create_unique_id();
              $title = htmlspecialchars(trim($_POST['title']));
              $description = htmlspecialchars(trim($_POST['description']));
              $price = htmlspecialchars($_POST['price']);
              $quantity = htmlspecialchars($_POST['quantity']);
              $idBrand = htmlspecialchars($_POST['brand']);
              $gender = htmlspecialchars($_POST['gender']);
              $active = htmlspecialchars($_POST['active']);
              $featured = htmlspecialchars($_POST['featured']);
              $random = $idProduct[mt_rand(0,strlen($idProduct) -1)];
              if (isset($_FILES['image']) && $_FILES['image']['name'] != '') {
                $name = $_FILES['image']['name'];
                $tmp_name = $_FILES['image']['tmp_name'];
                $type_img = explode('.', $name);
                $type_img = end($type_img);
                $main_image_path =  "../images/products_images/".$title . $random . "." . $type_img;
                move_uploaded_file($tmp_name, $main_image_path);
              }
              $imagesSub = [];
              if(isset($_FILES['images']) && !empty(array_filter($_FILES['images']['name']))) {
                $count = 1;
                foreach($_FILES['images']['name'] as $key=>$value) {
                  $path = $title.'-subImage'.$count;
                  $name = $_FILES['images']['name'][$key];
                  $tmp_name = $_FILES['images']['tmp_name'][$key];
                  $type_img = explode('.',$name);
                  $type_img = end($type_img);
                  $sub_image_path = '../images/products_images/'.$title.$random.$key.".".$type_img;
                  $sub_image_path = strval($sub_image_path);
                  array_push($imagesSub,$sub_image_path);
                  move_uploaded_file($tmp_name,$sub_image_path);
                  $jsonSubImages = str_replace(['[', '"', '\\', ']'], "",json_encode($imagesSub));
                  $count++;
                }
              }
              if($price > 0 && $quantity > 0) {
                $selectedOptions = isset($_POST['size']) ? $_POST['size'] : array();
                $jsonStringSelectedOptions = json_encode($selectedOptions);
                $insertQuery = "INSERT INTO products (id, title, description, price, quantity, image_main, brand_id, gender, images_sub, size, active, featured) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
                $insertStmt = $database->prepare($insertQuery);
                $insertStmt->bind_param("sssiisssssss", $idProduct, $title, $description, $price, $quantity, $main_image_path, $idBrand, $gender, $jsonSubImages, $jsonStringSelectedOptions, $active, $featured);
                $insertStmt->execute();
                if($insertStmt) {
                    get_session_success("addProductStatus","Successfully as Product Added");
                    header("location:manage-products.php");
                } else {                
                    get_session_danger("addProductStatus","Product Added failed");
                    header("location:manage-products.php");
                }  
              } else {
                echo '<h1 class="alert alert-danger fs-4 text-center w-auto">No Found Prices or Quantity</h1>';
              }
            }   
        ?>
        <div class="container">
        <form class="col-12 col-lg-7 mt-4" method="POST" enctype="multipart/form-data">
            <h4 class="mb-3">Add product</h4>
                    <div class="col-12 mt-4">
                        <label for="title" class="form-label">title</label>
                        <input type="text" class="form-control" id="title" name="title" placeholder="" required>
                    </div>
                    <div class="col-12 mt-4">
                        <label for="description" class="form-label">description</label>
                        <textarea class="form-control" name="description" id="description" cols="20" rows="5"></textarea>
                    </div>
                    <div class="col-12 row mt-4">
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
                                echo '
                                <option value='.$idBrand.'>'.$nameBrand.'</option>';                            
                              }
                          }
                        ?>
                        </select>
                      </div>
                      <div class="col-12 col-sm-6">
                        <label for="gender" class="form-label">gender</label>
                        <select class="form-select" name="gender" id="gender" aria-label="Default select example">
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-12 row g-3 mt-4">
                      <div class="col-12 col-sm-6">
                          <label for="price" class="form-label">price</label>
                          <input type="number" class="form-control" name="price" id="price" required>
                      </div>
                      <div class="col-12 col-sm-6">
                        <label for="quantity" class="form-label">quantity</label>
                        <input type="number" class="form-control" name="quantity" id="quantity" required>
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
                      <option value="s">S</option>
                      <option value="m">M</option>
                      <option value="l">L</option>
                      <option value="xl">XL</option>
                      <option value="xll">XLL</option>
                      <option value="xlll">XLLL</option>
                    </select>
                </div>
              </div>
            </div>
            <div class="col-12 row g-3 mt-4">
                <div class="col-12 col-sm-6">
                    <label for="formFileLg" class="form-label">main image</label>
                    <input type="file" class="form-control" name="image"  id="formFileLg" required>
                </div>
                <div class="col-12 col-sm-6">
                    <label class="form-label" for="subImages">sub Images</label>
                    <input type="file" class="form-control" id="subImages" name="images[]" accept="image/*" multiple required>
                </div>
              </div>
                <div class="col-12 row g-3 m-auto mt-4">
                  <div class="form-check p-0 col-12 row d-flex">
                    <div class="col-4">Active:</div>
                    <div class="col-4">
                      <label class="form-check-label">
                      <input class="form-check-input" type="radio" name="active" value="yes">
                        YES
                      </label>
                    </div>
                    <div class="col-4">
                      <label class="form-check-label">
                        <input class="form-check-input" type="radio" name="active" value="no">
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
                    <input class="form-check-input" type="radio" name="featured" value="yes">
                      YES
                    </label>
                  </div>
                  <div class="col-4">
                    <label class="form-check-label">
                    <input class="form-check-input" type="radio" name="featured" value="no">
                      NO
                    </label>
                  </div>
                </div>
              </div>
            <button class="btn btn-success col-12 col-md-auto fs-4 my-4" type="submit" name="AddProduct">Add Product</button>
          </form>
          <?php
        require '../components/footer-admin.php'
    ?>

        </div>
    </body>
</html>