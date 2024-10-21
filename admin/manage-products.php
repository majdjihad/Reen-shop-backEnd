<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="video/x-icon" href="../images/logo.png">
    <title>Reen | Manage-Products</title>
    <?php require '../components/librarys.php' ?>
</head>
<body>
    <!-- Start Header -->
    <?php
        $active = "products";
        require '../components/nav-admin.php';
    ?>
    <!-- End Header -->
    <div class="container mt-3">
    <h4 class="text-center fs-1 mt-4">Manage Products</h4>
    <a href="../admin/add-product.php" class="btn btn-success col-12 col-md-auto fs-4 my-4">Add Product</a>
    <?php
        if(isset($_SESSION['addProductStatus'])) {
            echo $_SESSION['addProductStatus'];
            unset($_SESSION['addProductStatus']);
        } else if(isset($_SESSION['updateProductStatus'])) {
            echo $_SESSION['updateProductStatus'];
            unset($_SESSION['updateProductStatus']);
        } else if(isset($_SESSION['updatePasswordStatus'])) {
            echo $_SESSION['updatePasswordStatus'];
            unset($_SESSION['updatePasswordStatus']);
        } else if(isset($_SESSION['deleteProductStatus'])) {
            echo $_SESSION['deleteProductStatus'];
            unset($_SESSION['deleteProductStatus']);
        }
        $querySelect = "SELECT * FROM products";
        $resultSelect = $database->query($querySelect);
        if($resultSelect->num_rows > 0) {
            echo '
            <div class="table-control">
            <table class="table table-striped table-hover">
            <thead>
                <tr class="thead-light text-center">
                    <th>#</th>
                    <th>Main Image</th>
                    <th>Title</th>
                    <th>Price</th>
                    <th>Gender</th>
                    <th>Numbers of Product</th>
                    <th>Brand</th>
                    <th>Active</th>
                    <th>Featured</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>'; // Added tbody opening tag here
            $count = 1;
            while($row = $resultSelect->fetch_assoc()) {
                $id = $row['id'];
                $mainImage = $row['image_main'];
                $title = $row['title'];
                $description = $row['description'];
                $price = $row['price'];
                $gender = $row['gender'];
                $quantity = $row['quantity'];
                $idBrand = $row['brand_id'];
                $active = $row['active'];
                $featured = $row['featured'];
                $subImages = $row['images_sub'];
                $querySelectBrand = "SELECT * FROM brands WHERE id = ?"; // Fixed the query
                $resultQuerySelectBrand = $database->prepare($querySelectBrand);
                $resultQuerySelectBrand->bind_param("s",$idBrand);
                $resultQuerySelectBrand->execute();
                $result = $resultQuerySelectBrand->get_result();
                if($result->num_rows > 0) {
                    $rowBrand = $result->fetch_assoc();
                    $brandName = $rowBrand['name'];    
                }  else {
                    $brandName = "no Brand";
                }
                echo '
                    <tr class="text-center">
                        <td class="center-table">'.$count.'</td>
                        <td class="center-table">
                            <img class="img-fluid rounded" width="64px" height="64px" src="'.$mainImage.'" alt="" loading="lazy"/>
                        </td>
                        <td class="center-table" class="text-center">'.$title.'</td>
                        <td class="center-table">'.$price.'</td>
                        <td class="center-table">'.$gender.'</td>
                        <td class="center-table">'.$quantity.'</td> <!-- Changed $count to $quantity -->
                        <td class="center-table">'.$brandName.'</td> <!-- Displayed the brand name -->
                        <td class="center-table">'.$active.'</td> <!-- Displayed the brand name -->
                        <td class="center-table">'.$featured.'</td> <!-- Displayed the brand name -->
                        <td class="center-table">
                            <a class="btn btn-sm btn-outline-success" href="../admin/update-product.php?id='.$id.'">Update</a>
                            <a class="btn btn-sm btn-outline-danger" href="../admin/delete.php?id='.$id.'&pos=product">Delete Product</a>
                        </td>
                    </tr>';
                $count++;
            }
            echo '</tbody>'; // Added tbody closing tag here
            echo '</table>'; // Added table closing tag here
            echo '</div>'; // Added div closing tag here
        } else {
            echo '<h1 class="alert alert-danger fs-4 text-center w-auto">No Found Products</h1>';
        }
        require '../components/footer-admin.php'
    ?>
    </div>
</body>
</html>
