<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reen | Register</title>
    <!-- Link Main CSS -->
    <link rel="stylesheet" href="./css/main.css">
    <?php require './components/librarys.php' ?>
</head>
<body>
    <?php
        require './config/constants.php';
        require './config/session.php';
        if(isset($_POST['register'])) {
            $idUser = create_unique_id();
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
                $image_path = "./images/users_images/".$fName.$idUser[mt_rand(0,strlen($idUser) -1)].".".$type_img;
                move_uploaded_file($tmp_name,$image_path);
            } else {
                $image_path = "./images/user_personal.png";
            }
            $queryInsert = "INSERT INTO users set id= ?, first_name= ?, last_name= ?, email= ?, password= ?, gender= ?, image= ?";
            $resultQueryInsert =  $database->prepare($queryInsert);
            $resultQueryInsert->bind_param("sssssss",$idUser, $fName, $lName, $email, $password, $gender, $image_path);
            $resultQueryInsert->execute();
            if($resultQueryInsert) {
                $_SESSION['signIn-user'] = $idUser;
                get_session_success("addUserStatus","Successfully  Register");
                header("location:index.php");
            } else {                
                get_session_danger("addUserStatus","Something Error!");
                header("location:index.php");
            }
        }
    ?>
    <div class="container row col-12 d-flex align-items-end m-auto">
        <form class="col-12 col-lg-6" method="POST" enctype="multipart/form-data">
            <div class="text-center">
                <img src="./img/logo.png" width="200px" alt="">
            </div>
            <h4 class="mb-3">Register User</h4>
            <div class="clo-12">
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
            <div class="col-12 mt-3">
                <label for="email" class="form-label">Email address</label>
                <input type="email" class="form-control" name="email" id="email" required>
            </div>
            <div class="col-12 mt-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" name="password" id="password" required>
            </div>
            <div class="col-12 row g-3 mt-3">
                <div class="col-12 col-sm-6">
                    <label for="" class="form-label">gender</label>
                    <select class="form-select" name="gender" aria-label="Default select example" required>
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                    </select>
                </div>
                <div class="col-12 col-sm-6">
                    <label for="formFileLg" class="form-label">image parson</label>
                    <input type="file" class="form-control" name="image" id="formFileLg">
                </div>
            </div>
            <button class="btn btn-success col-12 col-md-auto fs-4 mt-4" type="submit" name="register">register</button>
        </form>
        <div class="col-6 d-none d-lg-block">
            <img src="./images/about-hero.svg" alt="">
        </div>
    </div>
</body>
</html>