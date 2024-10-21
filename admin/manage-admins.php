<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="video/x-icon" href="../images/logo.png">
    <title>Reen | Manage-admins</title>
    <?php require '../components/librarys.php' ?>
</head>
<body>
    <!-- Start Header -->
    <?php
        $active = "admins";
        require '../components/nav-admin.php';
    ?>
    <!-- End Header -->
    <div class="container mt-3">
    <h4 class="text-center fs-1 mt-4">Manage Admin</h4>
    <a href="../admin/add-admin.php" class="btn btn-success col-12 col-md-auto fs-4 my-4">Add Admin</a>
    
    <?php
        if(isset($_SESSION['addAdminStatus'])) {
            echo $_SESSION['addAdminStatus'];
            unset($_SESSION['addAdminStatus']);
        } else if(isset($_SESSION['updateAdminStatus'])) {
            echo $_SESSION['updateAdminStatus'];
            unset($_SESSION['updateAdminStatus']);
        } else if(isset($_SESSION['updatePasswordStatus'])) {
            echo $_SESSION['updatePasswordStatus'];
            unset($_SESSION['updatePasswordStatus']);
        } else if(isset($_SESSION['deleteAdminStatus'])) {
            echo $_SESSION['deleteAdminStatus'];
            unset($_SESSION['deleteAdminStatus']);
        }
        $querySelect = "SELECT * FROM admins";
        $resultSelect = $database->query($querySelect);
        if($resultSelect->num_rows > 0) {
            echo '
            <div class="table-control">
            <table class="table table-striped table-hover text-center">
            <thead>
                <tr class="thead-light">
                    <th>#</th>
                    <th>image</th>
                    <th>FirstName</th>
                    <th>LastName</th>
                    <th>Email</th>
                    <th>Gender</th>
                    <th>Action</th>
                </tr>
            </thead>    
            ';
            $count = 1;
            while($row = $resultSelect->fetch_assoc()) {
                $id = $row['id'];
                $image = $row['image'];
                $fName = $row['first_name'];
                $lName = $row['last_name'];
                $email = $row['email'];
                $gender = $row['gender'];
                echo '
                <tbody>
                    <tr>
                        <td class="center-table-hight">'.$count.'</td>
                        <td>
                            <img class="rounded-circle" width="64px" height="64px" src="'.$image.'"/>
                        </td>
                        <td class="center-table">'.$fName.'</td>
                        <td class="center-table">'.$lName.'</td>
                        <td class="center-table">'.$email.'</td>
                        <td class="center-table">'.$gender.'</td>
                        <td class="center-table">
                            <a class="btn btn-sm btn-outline-success" href="../admin/update-admin.php?id='.$id.'">Update</a>
                            <a class="btn btn-sm btn-outline-danger" href="../admin/update-password.php?id='.$id.'">Change Password</a>
                            <a class="btn btn-sm btn-outline-danger" href="../admin/delete.php?id='.$id.'&pos=admin">Delete Admin</a>
                        </td>
                    </tr>';
                $count++;
            }
            echo '
                </body>
            </table>
            </div>';
        } else {
            echo '<h1 class="alert alert-danger fs-4 text-center w-auto">No Found Admins</h1>';
        }
        require '../components/footer-admin.php';
    ?>
    </div>
</body>
</html>