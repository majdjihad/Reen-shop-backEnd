        <!-- Start Brands Section -->
        <section class="brands bg-light">
            <div class="container py-5">
                <div class="title-section col-lg-6 m-auto pt-5 text-center">
                    <p class="fw-light fs-1">Our Brands</p>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod Lorem ipsum dolor sit amet.</p>
                </div>
                <div id="carouselExampleControls" class="carousel slide col-lg-9 m-auto" data-bs-ride="carousel">
                    <div class="carousel-inner">
                            <?php
                                $querySelect = "SELECT * FROM brands limit 4";
                                $resultSelect = $database->query($querySelect);
                                if($resultSelect->num_rows > 0) {
                                    $counter = 1;
                                    echo '
                                    <div class="carousel-item active">
                                    <div class="row">            
                                    ';
                                    while($row = $resultSelect->fetch_assoc()) {
                                        $brandId = $row['id'];
                                        $brandName = $row['id'];
                                        $imagePath = $row['image'];
                                        echo '
                                        <div class="col-3 p-md-5">
                                            <a href="brand-products.php?brand='.$brandId.'">
                                                <img src="'.substr($imagePath, 1, strlen($imagePath)).'" class="img-fluid brand-img" alt="'.$brandName.'">
                                            </a>
                                        </div>                                        
                                        ';
                                    }
                                    echo '
                                            </div>
                                        </div>
                                    ';                
                                }
                            ?>
                            <?php
                                $querySelect = "SELECT * FROM brands limit 4";
                                $resultSelect = $database->query($querySelect);
                                if($resultSelect->num_rows > 0) {
                                    $counter = 1;
                                    echo '
                                    <div class="carousel-item">
                                    <div class="row">            
                                    ';
                                    while($row = $resultSelect->fetch_assoc()) {
                                        $brandId = $row['id'];
                                        $brandName = $row['id'];
                                        $imagePath = $row['image'];
                                        echo '
                                        <div class="col-3 p-md-5">
                                            <a href="../brand-products.php?brand='.$brandId.'">
                                                <img src="'.substr($imagePath, 1, strlen($imagePath)).'" class="img-fluid brand-img" alt="'.$brandName.'">
                                            </a>
                                        </div>                                        
                                        ';
                                    }                                
                                }
                            ?>
                        </div>                  
                    </div>
                    <button class="move-slide-brands-pre d-none d-md-block" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
                      <span class="text-muted fs-1" aria-hidden="true"><i class="fa-solid fa-angle-left"></i></span>
                      <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="move-slide-brands-next d-none d-md-block" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
                      <span class="text-muted fs-1" aria-hidden="true"><i class="fa-solid fa-angle-right"></i></span>
                      <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>
        </section>
        <!-- End Brands Section -->