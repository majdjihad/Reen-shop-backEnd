<?php
    require './config/constants.php';
    if(isset($_SESSION['signIn-user'])) {
        $idUser = $_SESSION['signIn-user'];
        $querySelect = "SELECT * FROM users where id = '$idUser'";
        $resultQuerySelect = $database->query($querySelect);
        $row = $resultQuerySelect->fetch_assoc();
        $name = $row['first_name'].' '.$row['last_name'];
        $image_path = $row['image'];
    } else {
        $image_path = "./images/user_personal.png";
    }
?>
<nav class="navbar navbar-expend-lg bg-dark navbar-light d-none d-lg-block templatemo_nav_top">
    <div class="container text-light">
        <div class="w-100 d-flex justify-content-between">
            <div class="info">
                <i class="fa-solid fa-envelope text-light"></i>
                <a href="mailto:info@Shop.com.com" class="text-light text-decoration-none me-3">info@Shop.com</a>
                <i class="fa-solid fa-phone"></i>
                <a href="tel:+75822145422" class="text-light text-decoration-none">+75822145422</a>
            </div>
            <div div class="account">
                <ul class="list-unstyled m-0">
                    <li class="d-inline me-3"><a class="text-light" href="https://www.facebook.com"><i class="fa-brands fa-facebook"></i></a></li>
                    <li class="d-inline me-3"><a class="text-light" href="https://www.instagram.com"><i class="fa-brands fa-instagram"></i></a></li>
                    <li class="d-inline me-3"><a class="text-light" href="https://www.linkedin.com"><i class="fa-brands fa-linkedin-in"></i></a></li>
                    <li class="d-inline me-3"><a class="text-light" href="https://www.twitter.com"><i class="fa-brands fa-twitter"></i></a></li>
                </ul>
            </div>
        </div>
    </div>
    </nav>
    <!-- Start Header -->
    <nav class=" navbar-expand-lg navbar-light pt-2 pb-2">
        <div class="container d-lg-flex justify-content-between align-items-center">
            <div class=" navbar d-flex jsutify-content-between align-items-center">
            <a href="./index.php" class="text-decoration-none my-5 d-flex justify-content-center align-items-center logo">
                    <img src="./images/logo.png" alt="">
                    <p class="m-0 ms-2 fs-4 text-dark">Reen-Shop</p>
                </a>
                <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#templatemo_main_nav" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
            </div>
            <div class="align-self-center collapse navbar-collapse flex-fill  d-lg-flex justify-content-lg-around" id="templatemo_main_nav">
            <div class="flex-fill">
                <ul class="nav navbar-nav d-flex justify-content-between mx-lg-auto">
                    <li class="nav-item">
                        <a class="text-decoration-none nav-item-link <?php echo $active == 'home'? 'active': '' ?>" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="text-decoration-none nav-item-link <?php echo $active == 'about'? 'active': '' ?>" href="about.php">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="text-decoration-none nav-item-link <?php echo $active == 'shop'? 'active': '' ?>" href="shop.php">Shop</a>
                    </li>
                    <li class="nav-item">
                        <a class="text-decoration-none nav-item-link <?php echo $active == 'contact'? 'active': '' ?>" href="contact.php">Contact</a>
                    </li>
                </ul>
            </div>
        <div class="navbar align-self-center d-flex justify-content-start">
            <div class="d-lg-none flex-sm-fill col-7 col-sm-auto pr-3 box-search">
                <div class="input-group">
                    <div class="input-group-text d-none d-lg-flex">
                        <i class="btn-close" data-bs-dismiss="offcanvas"></i>
                    </div>
                    <input type="text" class="form-control" id="inputMobileSearch" placeholder="Search ...">
                    <div class="input-group-text">
                        <i class="fa fa-fw fa-search" style="cursor: pointer;"></i>
                    </div>
                </div>
            </div>
            <button class="bg-transparent search p-0 m-0 mx-2 border-0 d-none d-lg-inline" data-bs-toggle="tooltip" data-bs-placement="top" title="Search">
                <i class="fa fa-fw fa-search text-dark mr-2 fs-5 d-none d-lg-block"></i>
            </button>
            <a href="cart.php" class="bg-transparent p-2 m-0 mx-2 border-0 position-relative notices-cart" data-bs-toggle="tooltip" data-bs-placement="top" title="Cart">
                <i class="fa fa-fw fa-cart-arrow-down mr-1 fs-5 <?php echo $active == 'cart'? 'active': 'text-dark' ?>"></i>
                <span class="position-absolute top-0 left-100 translate-middle badge rounded-pill bg-warning text-dark notices">+<span>0</span></span>
            </a>
            <!-- <button class="bg-transparent p-0 m-0 mx-2 border-0" data-bs-toggle="tooltip" data-bs-placement="top" title="<?php echo $name; ?>">
                    <img src="<?php echo $image_path; ?>" style="width: 40px" alt="user" class="img-fluid rounded-circle">
            </button>
            <button class="bg-transparent p-0 m-0 mx-2 border-0" data-bs-toggle="tooltip" data-bs-placement="top" title="Logout">
                <a class="nav-link" aria-current="page" href="./logout.php">
                    <i class="fa-solid fa-arrow-right-from-bracket fs-3"></i>
                </a>
            </button> -->
        </div>
        </div>
    </div>
</nav>
<!-- Close Header -->
