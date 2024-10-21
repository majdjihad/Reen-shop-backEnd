<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reen | Contact</title>
    <!-- Link Main CSS -->
    <link rel="stylesheet" href="./css/main.css">
    <!-- Link Icon Title -->
    <link rel="icon" type="video/x-icon" href="./images/logo.png">
    <?php require './components/librarys.php' ?>
</head>
<body>
  <!-- Start Contact Page -->
    <!-- Start Header -->
    <?php
      $active = "contact";
      require "./components/header.php";
      if(isset($_POST['sendMassage'])) {
        $idMassage = create_unique_id();
        $fullName = htmlspecialchars($_POST['full_name']);
        $address = htmlspecialchars($_POST['address']);
        $email = htmlspecialchars($_POST['email']);
        $phone = htmlspecialchars($_POST['phone']);
        $comments = htmlspecialchars($_POST['comments']);
        date_default_timezone_set("Asia/Gaza");
        $date = date("Y/m/d h:i:sA");
        $queryInsert = "INSERT INTO massages set id= ?, name= ?, address= ?, email= ?, phone= ?, comments= ?, date= ?";
        $resultQueryInsert =  $database->prepare($queryInsert);
        $resultQueryInsert->bind_param("sssssss",$idMassage, $fullName, $address, $email, $phone, $comments, $date);
        $resultQueryInsert->execute();
    }

    ?>
    <!-- Start Header -->
    <!-- Start Contact Us Section -->
    <section class="contact">
      <div class="container py-5">
          <div class="title-section text-center col-md-6 m-auto pt-4">
              <p class="fw-light fs-1">Contact Us</p>
              <p>Proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Lorem ipsum dolor sit amet.</p>
            </div>
        </div>
    </section>
    <!-- End Contact Us Section -->
        <!-- Start Form Section -->
        <section class="form bg-light py-5">
        <div class="container">
            <form action="" method="post">
            <div class="d-flex justify-content-between flex-wrap">
                <div class="form-floating mb-3 col-12 col-md-6 pe-1">
                    <input type="text" class="form-control" id="floatingInput" name="full_name" placeholder="Name">
                    <label for="floatingInput" class="text-secondary">Name</label>
                </div>
                <div class="form-floating mb-3 col-12 col-md-6 ps-1">
                    <input type="text" class="form-control" id="floatingPassword" name="address" placeholder="Address">
                    <label for="floatingPassword" class="text-secondary">Address</label>
                </div>
            </div>
            <div class="d-flex justify-content-between flex-wrap">
                <div class="form-floating mb-3 col-12 col-md-6 ps-1">
                    <input type="email" class="form-control" id="floatingInput" name="email" placeholder="email">
                    <label for="floatingInput" class="text-secondary">Email</label>
                </div>
                <div class="form-floating mb-3 col-12 col-md-6 ps-1">
                    <input type="text" class="form-control" id="floatingInput" name="phone" placeholder="phone">
                    <label for="floatingInput" class="text-secondary">phone</label>
                </div>
            </div>
            <div class="form-floating">
                <textarea class="form-control" placeholder="Leave a comment here" name="comments" id="floatingTextarea2" style="height: 280px"></textarea>
                <label for="floatingTextarea2" class="text-secondary">Comments</label>
            </div>
            <input class="btn btn-success mt-3 fs-4 col-12 col-md-auto" type="submit" name="sendMassage" value="Send">
            </form>
        </div>
    </section>
    <!-- End Form Section -->
    <!-- Start Map Section -->
    <section class="map">
        <div class="pb-5">
            <iframe style="width: 100%; height: 500px;" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d7332803.960403!2d34.29373746907335!3d26.898329284526916!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x14368976c35c36e9%3A0x2c45a00925c4c444!2sEgypt!5e0!3m2!1sen!2s!4v1671989564448!5m2!1sen!2s" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade" aria-hidden="false" tabindex="0"></iframe>      
        </div>
    </section>
    <!-- End Map Section -->
    <!-- Start Brand -->
    <?php
    require "./components/brand.php";
  ?>
  <!-- End Brand -->
  <!-- Start Footer -->
  <?php
    require "./components/footer.php";
  ?>
  <!-- End Footer -->
  <!-- End Contact Page -->
  <script src="./js/main.js"></script>
</body>
</html>