<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Reen | add-admin</title>
        <?php require '../components/librarys.php' ?>
    </head>
    <body>
        <?php
        require '../config/constants.php';
        require '../config/session.php';       
        if(isset($_POST['AddAdmin'])) {
                $idAdmin = create_unique_id();
                $fName = htmlspecialchars($_POST['fName']);
                $lName = htmlspecialchars($_POST['lName']);
                $email = htmlspecialchars($_POST['email']);
                $password = htmlspecialchars($_POST['password']);
                $gender = htmlspecialchars($_POST['gender']);
                if(isset($_FILES['image']) && $_FILES['image']['name'] != '') {
                    $name = $_FILES['image']['name'];
                    $tmp_name = $_FILES['image']['tmp_name'];
                    $type_img = explode('.',$name);
                    $type_img = end($type_img);
                    $image_path = "../images/admins_images/".$fName.$idAdmin[mt_rand(0,strlen($idAdmin) -1)].".".$type_img;
                    move_uploaded_file($tmp_name,$image_path);
                } else {
                    $image_path = "../images/user_personal.png";
                }
                $queryInsert = "INSERT INTO admins set id= ?, first_name= ?, last_name= ?, email= ?, password= ?, gender= ?, image= ?";
                $resultQueryInsert =  $database->prepare($queryInsert);
                $resultQueryInsert->bind_param("sssssss",$idAdmin, $fName, $lName, $email, $password, $gender, $image_path);
                $resultQueryInsert->execute();
                if($resultQueryInsert) {
                    $_SESSION['signIn-admin'] = "true";
                    get_session_success("addAdminStatus","Successfully as Admin Added");
                    header("location:manage-admins.php");
                } else {                
                    get_session_danger("addAdminStatus","Admin Added failed");
                    header("location:manage-admins.php");
                }
            }
        ?>
        <div class="container">
        <form class="col-12 col-lg-6 mt-4" method="POST" enctype="multipart/form-data">
            <h4 class="mb-3">Register admin</h4>
            <div class="clo-12 mt-4">
                <div class="row g-3">
                    <div class="col-6">
                        <label for="firstName" class="form-label">First name</label>
                        <input type="text" class="form-control" id="firstName" name="fName" placeholder="" required>
                    </div>
                    <div class="col-6">
                        <label for="lastName" class="form-label">Last name</label>
                        <input type="text" class="form-control" id="lastName" name="lName" placeholder="" required>
                    </div>
                </div>
            </div>
            <div class="col-12 mt-4">
                <label for="email" class="form-label">Email address</label>
                <input type="email" class="form-control" name="email" id="email" name="email" required>
            </div>
            <div class="col-12 mt-4">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" name="password" id="password" required>
            </div>
            <div class="col-12 row g-3 mt-4">
                <div class="col-12 col-sm-6">
                    <label for="gender" class="form-label">gender</label>
                    <select class="form-select" name="gender" id="gender" aria-label="Default select example">
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                    </select>
                </div>
                <div class="col-12 col-sm-6">
                    <label for="formFileLg" class="form-label">image parson</label>
                    <input type="file" class="form-control" name="image" id="formFileLg">
                </div>
            </div>
            <button class="btn btn-success col-12 col-md-auto fs-4 my-4" type="submit" name="AddAdmin">Add Admin</button>
        </form>
        <?php
        require '../components/footer-admin.php'
    ?>
        </div>
    </body>
</html>