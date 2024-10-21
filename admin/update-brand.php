<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="icon" type="video/x-icon" href="../images/logo.png">
        <title>Reen | add-admin</title>
        <?php require '../components/librarys.php' ?>
    </head>
    <body>
        <?php
            require '../components/nav-admin.php';
            if(isset($_GET['id'])) {
                $idBrand = $_GET['id'];
                $selectBrand = "SELECT * FROM brands where id = ?";
                $resultSelectBrand = $database->prepare($selectBrand);
                $resultSelectBrand->bind_param("s", $idBrand);
                $resultSelectBrand->execute();
                $rowBrand = $resultSelectBrand->get_result();
                $brand = $rowBrand->fetch_assoc();
                if($rowBrand->num_rows == 1) {
                    $current_name = $brand['name'];
                    $current_image_path = $brand['image'];
                    if(isset($_POST['updateBrand'])) {
                        $new_name = htmlspecialchars($_POST['name']);
                        if(isset($_FILES['image']) && $_FILES['image']['name'] != '') {
                            $name = $_FILES['image']['name'];
                            $tmp_name = $_FILES['image']['tmp_name'];
                            $type_img = explode('.',$name);
                            $type_img = end($type_img);
                            $image_path = "../images/brands_images/".$new_name.$idBrand[mt_rand(0,strlen($idBrand) -1)].".".$type_img;
                            move_uploaded_file($tmp_name,$image_path);
                        } else {
                            $image_path = $current_image_path;
                        }
                        $queryInsert = "UPDATE brands set name= ? ,image= ? where id = ?";
                        $resultQueryInsert =  $database->prepare($queryInsert);
                        $resultQueryInsert->bind_param("sss", $new_name, $image_path, $idBrand);
                        $resultQueryInsert->execute();
                        if($resultQueryInsert) {
                            get_session_success("updateBrandStatus","The Brand updated successfully");
                            header("location:manage-brands.php");
                        } else {
                            get_session_danger("updateBrandStatus","Brand Update failed");
                            header("location:manage-brands.php");
                        }
                    }
                } else {
                    header("location:manage-brands.php");
                }
            } else {
                header("location:manage-brands.php");
            }
        ?>
        <div class="container">
        <form class="col-12 col-lg-6 mt-4" method="POST" enctype="multipart/form-data">
            <h4 class="mb-3">Add brand</h4>
            <div class="clo-12 mt-4">
                <label for="fName" class="form-label">brand name</label>
                <input type="text" class="form-control" name="name" value="<?php echo $current_name ?>" id="fName" placeholder="" required>
            </div>
            <div class="clo-12 mt-4 d-flex algin-items-center">
                <p class="d-flex align-items-center">Current Image</p>
                <img class="img-fluid rounded" width="70px" height="70px" src="<?php echo $current_image_path ?>" alt="">
            </div>
            <div class="col-12 mt-4">
                <label for="formFileLg" class="form-label">image brand</label>
                <input type="file" class="form-control" name="image" id="formFileLg">
            </div>
            <button class="btn btn-success col-12 col-md-auto fs-4 my-4" type="submit" name="updateBrand">Update brand</button>
        </form>        
        <?php
        require '../components/footer-admin.php'
        ?>
    </div>
    </body>
</html>