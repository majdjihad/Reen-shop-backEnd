<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="video/x-icon" href="../images/logo.png">
    <title>Reen | Home</title>
    <?php require '../components/librarys.php' ?>

</head>
<body style="background-color:#f6f6f6;">
    <?php
        require '../components/nav-admin.php';
    ?>
    <div class="container">
        <h1 class="text-center mt-4">Dashboard</h1>
        <div class="d-flex row col-12 justify-content-around algin-items-center flex-wrap g-3 my-5">
        <div class="col-12 col-sm-6 col-md-4 col-lg-3 m-3 text-center bg-body col-4 p-3 rounded border shadow-sm">
                <i class="fa-solid fa-user-gear fs-2"></i>
                <h2 class="fs-2 my-3">Admins</h2>
                <p class="text-center fs-2 m-0">
                    <?php
                        $querySelectAdmin = "SELECT * FROM admins";
                        $resultQuerySelectAdmin = $database->query($querySelectAdmin);
                        $adminSize = $resultQuerySelectAdmin->num_rows;
                        echo $adminSize;
                    ?>
                </p>
            </div>
            <div class="col-12 col-sm-6 col-md-4 col-lg-3 m-3 text-center bg-body col-4 p-3 rounded border shadow-sm">
            <i class="fa-solid fa-user fs-2"></i>                
            <h2 class="fs-2 my-3">Users</h2>
                <p class="text-center fs-2 m-0">
                    <?php
                        $querySelectUser = "SELECT * FROM users";
                        $resultQuerySelectUser = $database->query($querySelectUser);
                        $userSize = $resultQuerySelectUser->num_rows;
                        echo $userSize;
                    ?>
                </p>
            </div>
            <div class="col-12 col-sm-6 col-md-4 col-lg-3 m-3 text-center bg-body col-4 p-3 rounded border shadow-sm">
                <i class="fa-brands fa-bandcamp fs-2"></i>
                <h2 class="fs-2 my-3">Brands</h2>
                <p class="text-center fs-2 m-0">
                    <?php
                        $querySelectAdmin = "SELECT * FROM brands";
                        $resultQuerySelectAdmin = $database->query($querySelectAdmin);
                        $adminSize = $resultQuerySelectAdmin->num_rows;
                        echo $adminSize;
                    ?>
                </p>
            </div>
            <div class="col-12 col-sm-6 col-md-4 col-lg-3 m-3 text-center bg-body col-4 p-3 rounded border shadow-sm">
                <i class="fa-solid fa-shirt fs-2"></i>
                <h2 class="fs-2 my-3">Product</h2>
                <p class="text-center fs-2 m-0">
                    <?php
                        $querySelectUser = "SELECT * FROM products";
                        $resultQuerySelectUser = $database->query($querySelectUser);
                        $userSize = $resultQuerySelectUser->num_rows;
                        echo $userSize;
                    ?>
                </p>
            </div>
            <div class="col-12 col-sm-6 col-md-4 col-lg-3 m-3 text-center bg-body col-4 p-3 rounded border shadow-sm">
                <i class="fa-solid fa-box-open fs-2"></i>
                <h2 class="fs-2 my-3">Orders</h2>
                <p class="text-center fs-2 m-0">
                    <?php
                        $querySelectUser = "SELECT * FROM orders";
                        $resultQuerySelectUser = $database->query($querySelectUser);
                        $userSize = $resultQuerySelectUser->num_rows;
                        echo $userSize;
                    ?>
                </p>
            </div>
            <div class="col-12 col-sm-6 col-md-4 col-lg-3 m-3 text-center bg-body col-4 p-3 rounded border shadow-sm">
                <i class="fa-solid fa-envelope fs-2"></i>
                <h2 class="fs-2 my-3">Massages</h2>
                <p class="text-center fs-2 m-0">
                    <?php
                        $querySelectUser = "SELECT * FROM massages";
                        $resultQuerySelectUser = $database->query($querySelectUser);
                        $userSize = $resultQuerySelectUser->num_rows;
                        echo $userSize;
                    ?>
                </p>
            </div>
        </div>

        </div>
    <?php
        require '../components/footer-admin.php'
    ?>
    </div>
</body>
</html>