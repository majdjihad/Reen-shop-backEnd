<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="video/x-icon" href="../img/logo_page.png">
    <title>Reen | Signin</title>
    <!-- Link Main CSS -->
    <link rel="stylesheet" href="../css/main.css">
    <!-- Link Icon Title -->
    <link rel="icon" type="video/x-icon" href="./images/logo.png">
    <?php require './components/librarys.php' ?>
</head>
<body>
    <?php
        require './config/constants.php';
        if(isset($_POST['signin'])) {
            $email = htmlspecialchars($_POST['email']);
            $password = htmlspecialchars($_POST['password']);
            $queryTest = "SELECT * FROM users where email = ? and password = ?";
            $resultQueryTest = $database->prepare($queryTest);
            $resultQueryTest->bind_param("ss", $email, $password);
            $resultQueryTest->execute();
            $selectedAdmin = $resultQueryTest->get_result();
            if($selectedAdmin->num_rows == 1) {
                $row = $selectedAdmin->fetch_assoc();
                $idUser = $row['id'];
                $_SESSION['signIn-user'] = $idUser;
                header("location:index.php");
            } else {
                echo '
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary btn-msg d-none" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                asd
                </button>
                
                <!-- Modal -->
                <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-body py-4 fs-5">
                        Email or Password invalid!
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Understood</button>
                      </div>
                    </div>
                  </div>
                </div>
                <script>
                    document.querySelector(".btn-msg").click();
                </script>
                ';
            }
        }
    ?>
    <div class="container">
        <div class="form-signin">
            <form method="POST">
                <a href="./index.php" class="text-decoration-none my-5 d-flex justify-content-center align-items-center">
                    <img src="./images/logo.png" alt="">
                    <p class="m-0 ms-2 fs-3 text-dark">Reen-Shop</p>
                </a>
                <h1 class="h3 mb-3 fw-normal text-center">Sign in</h1>
                <div class="form-floating col-12 col-md-4 m-auto mt-4">
                    <input type="email" class="form-control" name="email" id="floatingInput" placeholder="Enter email" required>
                    <label for="floatingInput" class="text-muted">Enter email</label>
                </div>
                <div class="form-floating col-12 col-md-4 m-auto mt-4">
                    <input type="password" class="form-control" name="password" id="floatingPassword" placeholder="Enter password" required>
                    <label for="floatingPassword text-muted" class="text-muted">Enter password</label>
                </div>
                <div class="checkbox col-12 col-md-4 m-auto my-3">
                    <label>
                        <input type="checkbox" name="checkbox" value="remember-me">
                        Remember me
                    </label>
                </div>
                <button class="btn btn-success d-block fs-4 col-12 col-md-4 m-auto" type="submit" name="signin">Sign in</button>
                <p class=" col-12 col-md-4 m-auto my-3">No have account?
                    <a href="./register.php">register</a>
                </p>
        <?php
        require './components/footer-admin.php'
    ?>
            </form>
        </div>
    </div>
</body>
</html>