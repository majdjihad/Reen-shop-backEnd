<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="video/x-icon" href="../images/logo.png">
    <title>Reen | Manage-Orders</title>
    <?php require '../components/librarys.php' ?>
</head>
<body>
    <!-- Start Header -->
    <?php
        $active = "orders";
        require '../components/nav-admin.php';
    ?>
    <!-- End Header -->
    <div class="container mt-3">
    <h4 class="text-center fs-1 mt-4">Manage Orders</h4>    
    <?php
        $querySelect = "SELECT * FROM orders";
        $resultSelect = $database->query($querySelect);
        if($resultSelect->num_rows > 0) {
            echo '
            <div class="table-control">
            <table class="table table-striped table-hover text-center">
            <thead>
                <tr class="thead-light">
                    <th>#</th>
                    <th>image</th>
                    <th>price</th>
                    <th>color</th>
                    <th>size</th>
                    <th>date</th>
                </tr>
            </thead>
            <tbody>
            ';
            $count = 1;
            while($row = $resultSelect->fetch_assoc()) {
                $image = $row['image_path'];
                $productPrice = $row['product_price'];
                $productColor = $row['product_color'];
                $productSize = $row['product_size'];
                $date = $row['date'];
                echo '
                    <tr>
                        <td class="center-table-hight">'.$count.'</td>
                        <td>
                            <img class="rounded" width="64px" height="64px" src="'.$image.'"/>
                        </td>
                        <td class="center-table">'.$productPrice.'</td>
                        <td class="center-table">'.$productColor.'</td>
                        <td class="center-table">'.$productSize.'</td>
                        <td class="center-table">'.$date.'</td>
                    </tr>';
                $count++;
            }
            echo '
                </tbody>
            </table>
            </div>';
        } else {
            echo '<h1 class="alert alert-danger fs-4 text-center w-auto">No Found Orders</h1>';
        }
        require '../components/footer-admin.php';
    ?>
    </div>
</body>
</html>