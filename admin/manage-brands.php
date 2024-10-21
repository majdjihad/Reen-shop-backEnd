<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="video/x-icon" href="../images/logo.png">
    <title>Reen | Manage-Brands</title>
    <?php require '../components/librarys.php' ?>
</head>
<body>
    <!-- Start Header -->
    <?php
        $active = "brands";
        require '../components/nav-admin.php';
    ?>
    <!-- End Header -->
    <div class="container mt-3">
    <h4 class="text-center fs-1 mt-4">Manage Brands</h4>
    <a href="../admin/add-brand.php" class="btn btn-success col-12 col-md-auto fs-4 my-4">Add Brand</a>
    <?php
        if(isset($_SESSION['addBrandStatus'])) {
            echo $_SESSION['addBrandStatus'];
            unset($_SESSION['addBrandStatus']);
        } else if(isset($_SESSION['updateBrandStatus'])) {
            echo $_SESSION['updateBrandStatus'];
            unset($_SESSION['updateBrandStatus']);
        } else if(isset($_SESSION['updatePasswordStatus'])) {
            echo $_SESSION['updatePasswordStatus'];
            unset($_SESSION['updatePasswordStatus']);
        } else if(isset($_SESSION['deleteBrandStatus'])) {
            echo $_SESSION['deleteBrandStatus'];
            unset($_SESSION['deleteBrandStatus']);
        }
        $querySelect = "SELECT * FROM brands";
        $resultSelect = $database->query($querySelect);
        if($resultSelect->num_rows > 0) {
            echo '
            <div class="table-control">
            <table class="table table-striped table-hover text-center">
            <thead >
                <tr class="thead-light text-center">
                    <th>#</th>
                    <th>Logo</th>
                    <th>Name</th>
                    <th>Date</th>
                    <th>Action</th>
                </tr>
            </thead>';
            $count = 1;
            while($row = $resultSelect->fetch_assoc()) {
                $id = $row['id'];
                $image = $row['image'];
                $name = $row['name'];
                $date = $row['date'];
                echo '
                <tbody>
                    <tr>
                        <td class="center-table">'.$count.'</td>
                        <td class="center-table">
                            <img class="img-fluid rounded" width="64px" height="64px" src="'.$image.'" alt="" loading="lazy"/>
                        </td>
                        <td class="center-table">'.$name.'</td>
                        <td class="center-table">'.$date.'</td>
                        <td class="center-table">
                            <a class="btn btn-sm btn-outline-success" href="../admin/update-brand.php?id='.$id.'">Update</a>
                            <a class="btn btn-sm btn-outline-danger" href="../admin/delete.php?id='.$id.'&pos=brand">Delete Brand</a>
                        </td>
                    </tr>';
                $count++;
            }
            echo '
                </body>
            </table>
            </div>';
        } else {
            echo '<h1 class="alert alert-danger fs-4 text-center w-auto">No Found Brands</h1>';
        }
        require '../components/footer-admin.php';
        ?>
    </div>
</body>
</html>