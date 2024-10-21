<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="video/x-icon" href="../images/logo.png">
    <title>Reen | Manage-Massages</title>
    <?php require '../components/librarys.php' ?>
</head>
<body>
    <!-- Start Header -->
    <?php
        $active = "massages";
        require '../components/nav-admin.php';
    ?>
    <!-- End Header -->
    <div class="container mt-3">
    <h4 class="text-center fs-1 mt-4">Manage Massages</h4>    
    <?php
        $querySelect = "SELECT * FROM massages";
        $resultSelect = $database->query($querySelect);
        if($resultSelect->num_rows > 0) {
            echo '
            <div class="table-control mt-5">
            <table class="table table-striped table-hover text-center">
            <thead>
                <tr class="thead-light">
                    <th>#</th>
                    <th>name</th>
                    <th>address</th>
                    <th>email</th>
                    <th>phone</th>
                    <th>date</th>
                    <th>comment</th>
                </tr>
            </thead>
            <tbody>
            ';
            $count = 1;
            while($row = $resultSelect->fetch_assoc()) {
                $name = $row['name'];
                $address = $row['address'];
                $email = $row['email'];
                $phone = $row['phone'];
                $comment = $row['comments'];
                $date = $row['date'];
                echo '
                    <tr>
                        <td class="center-table-hight">'.$count.'</td>
                        <td class="center-table">'.$name.'</td>
                        <td class="center-table">'.$address.'</td>
                        <td class="center-table">'.$email.'</td>
                        <td class="center-table">'.$phone.'</td>
                        <td class="center-table">'.$date.'</td>
                        <td class="center-table">'.$comment.'</td>
                    </tr>';
                $count++;
            }
            echo '
                </tbody>
            </table>
            </div>';
        } else {
            echo '<h1 class="alert alert-danger fs-4 text-center w-auto">No Found Massage</h1>';
        }
        require '../components/footer-admin.php';
    ?>
    </div>
</body>
</html>