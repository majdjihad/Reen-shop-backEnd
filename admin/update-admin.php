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
                $idAdmin = $_GET['id'];
                $selectAdmin = "SELECT * FROM admins where id = ?";
                $resultSelectAdmin = $database->prepare($selectAdmin);
                $resultSelectAdmin->bind_param("s", $idAdmin);
                $resultSelectAdmin->execute();
                $rowAdmin = $resultSelectAdmin->get_result();
                $admin = $rowAdmin->fetch_assoc();
                if($rowAdmin->num_rows == 1) {
                    $current_fName = $admin['first_name'];
                    $current_lName = $admin['last_name'];
                    $current_email = $admin['email'];
                    $current_password = $admin['password'];
                    $current_gender = $admin['gender'];
                    $current_image_path = $admin['image'];
                    if(isset($_POST['updateAdmin'])) {
                        $new_fName = htmlspecialchars($_POST['fName']);
                        $new_lName = htmlspecialchars($_POST['lName']);
                        $new_email = htmlspecialchars($_POST['email']);
                        $new_gender = htmlspecialchars($_POST['gender']);
                        
                        if(isset($_FILES['image']) && $_FILES['image']['name'] != '') {
                            $name = $_FILES['image']['name'];
                            $tmp_name = $_FILES['image']['tmp_name'];
                            $type_img = explode('.',$name);
                            $type_img = end($type_img);
                            $image_path = "../images/admins_images/".$fName.$idAdmin[mt_rand(0,strlen($idAdmin) -1)].".".$type_img;
                            move_uploaded_file($tmp_name,$image_path);
                        } else {
                            $image_path = $current_image_path;
                        }
                        $queryInsert = "UPDATE admins set first_name= ?, last_name= ?, email= ?, gender= ?, image= ? where id = ?";
                        $resultQueryInsert =  $database->prepare($queryInsert);
                        $resultQueryInsert->bind_param("ssssss", $new_fName, $new_lName, $new_email, $new_gender, $image_path,$idAdmin);
                        $resultQueryInsert->execute();
                        if($resultQueryInsert) {
                            get_session_success("addAdminStatus","The admin updated successfully");
                            header("location:manage-admins.php");
                        } else {
                            get_session_danger("addAdminStatus","Admin Update failed");
                            header("location:manage-admins.php");
                        }
                    }
                } else {
                    header("location:manage-admins");
                }
            }
        ?>
        <div class="container">
        <form class="col-12 col-lg-6 mt-4" method="POST" enctype="multipart/form-data">
            <h4 class="mb-3">Update admin</h4>
            <img class="img-fluid rounded-circle" width="70" height="70" src="<?php echo $current_image_path ?>" alt="" loading="lazy">
            <div class="clo-12 mt-4">
                <div class="row g-3">
                    <div class="col-6">
                        <label for="firstName" class="form-label">First name</label>
                        <input type="text" class="form-control" id="firstName" name="fName" value="<?php echo $current_fName; ?>" placeholder="" required>
                    </div>
                    <div class="col-6">
                        <label for="lastName" class="form-label">Last name</label>
                        <input type="text" class="form-control" id="lastName" name="lName" value="<?php echo $current_lName; ?>" placeholder="" required>
                    </div>
                </div>
            </div>
            <div class="col-12 mt-4">
                <label for="email" class="form-label">Email address</label>
                <input type="email" class="form-control" name="email" id="email" value="<?php echo $current_email; ?>" name="email" required>
            </div>
            <div class="col-12 row g-3 mt-4">
                <div class="col-12 col-sm-6">
                    <label for="" class="form-label">gender</label>
                    <select class="form-select" name="gender" aria-label="Default select example">
                        <option value="Male" <?php echo $current_gender == "Male"? "selected": "";  ?>>Male</option>
                        <option value="Female" <?php echo $current_gender == "Female"? "selected": "";  ?>>Female</option>
                    </select>
                </div>
                <div class="col-12 col-sm-6">
                    <label for="formFileLg" class="form-label">New image</label>
                    <input type="file" class="form-control" name="image" id="formFileLg">
                </div>
            </div>
            <button class="btn btn-success col-12 col-md-auto fs-4 my-4" type="submit" name="updateAdmin">Update Admin</button>
        </form>
        <?php
        require '../components/footer-admin.php'
    ?>
        </div>
    </body>
</html>