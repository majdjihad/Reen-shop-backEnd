<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Reen | add-brand</title>
        <?php include '../components/librarys.php' ?>
    </head>
    <body>
        <!-- Start Header -->
        <?php
            require '../components/nav-admin.php';
            if(isset($_POST['AddBrand'])) {
                $idBrand = create_unique_id();
                date_default_timezone_set("Asia/Gaza");
                $date = date("Y/m/d h:i:sA");
                $fName = htmlspecialchars($_POST['fName']);
                if(isset($_FILES['image']) && $_FILES['image']['name'] != '') {
                    $name = $_FILES['image']['name'];
                    $tmp_name = $_FILES['image']['tmp_name'];
                    $type_img = explode('.',$name);
                    $type_img = end($type_img);
                    $image_path = "../images/brands_images/".$fName.$idBrand[mt_rand(0,strlen($idBrand) -1)].".".$type_img;
                    move_uploaded_file($tmp_name,$image_path);
                } else {
                    $image_path = "../images/brands_images/clothes.png";
                }
                $queryInsert = "INSERT INTO brands set id= ?, name= ?, image= ?, date = ?";
                $resultQueryInsert =  $database->prepare($queryInsert);
                $resultQueryInsert->bind_param("ssss", $idBrand, $fName, $image_path, $date);
                $resultQueryInsert->execute();
                if($resultQueryInsert) {
                    get_session_success("addBrandStatus","Successfully as Brand Added");
                    header("location:manage-brands.php");
                } else {                
                    get_session_danger("addBrandStatus","Brand Added failed");
                    header("location:manage-brands.php");
                }
            }
        ?>
        <!-- End Header -->
        <div class="container">
        <form class="col-12 col-lg-6 mt-4" method="POST" enctype="multipart/form-data">
            <h4 class="mb-3">Add brand</h4>
            <div class="clo-12 mt-4">
                <label for="fName" class="form-label">brand name</label>
                <input type="text" class="form-control" name="fName" id="fName" placeholder="" required>
            </div>
            <div class="col-12 mt-4">
                <label for="formFileLg" class="form-label">image brand</label>
                <input type="file" class="form-control" name="image" id="formFileLg">
            </div>
            <button class="btn btn-success col-12 col-md-auto fs-4 my-4" type="submit" name="AddBrand">Add brand</button>
        </form>
    </div>
        <?php
        require '../components/footer-admin.php'
    ?>
    </body>
</html>