<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="icon" type="video/x-icon" href="../images/logo.png">
        <title>Reen | add-admin</title>
        <?php require '../components/librarys.php' ?>
    </head>
    <body>
        <?php
            require '../components/nav-admin.php';
            if(isset($_GET['id'])) {
                $idAdmin = $_GET['id'];
                $querySelect = "SELECT * FROM admins where id = ?";
                $resultSelectQuery = $database->prepare($querySelect);
                $resultSelectQuery->bind_param("s", $idAdmin);
                $resultSelectQuery->execute();
                $row = $resultSelectQuery->get_result();
                $rowTable = $row->fetch_assoc();
                if($row->num_rows == 1) {
                    $database_password = $rowTable['password'];
                    if(isset($_POST['updatePassword'])) {
                        $current_password = htmlspecialchars($_POST['current-password']);
                        $new_password = htmlspecialchars($_POST['new-password']);
                        $confirm_password = htmlspecialchars($_POST['confirm-password']);
                        if($database_password == $current_password) {
                            if($new_password == $confirm_password) {
                                $queryUpdate = "UPDATE admins set password= ? where id = ?";
                                $resultQueryUpdate =  $database->prepare($queryUpdate);
                                $resultQueryUpdate->bind_param("ss", $new_password,$idAdmin);
                                $resultQueryUpdate->execute();
                                if($resultQueryUpdate) {
                                    get_session_success("updatePasswordStatus","The Password updated successfully");
                                } else {
                                    get_session_danger("updatePasswordStatus","Password Update failed");
                                }
                                header("location:manage-admins.php");
                            } else {
                                echo '
                                <div class="alert alert-danger w-auto position-relative bottom-0 right-0" role="alert">
                                    confirm password  not same new password!
                                </div>';
                            }
                        } else {
                            echo '
                                <div class="alert alert-danger w-auto position-relative bottom-0 right-0" role="alert">
                                password incorrect!
                                </div>
                            ';
                        }
                    }
                    } else {
                    header("location:manage-admins");
                }
            }
        ?>
        <div class="container">
        <form class="col-12 col-lg-6 mt-4" method="POST" enctype="multipart/form-data">
            <h4 class="mb-3">Update admin</h4>
            <div class="col-12 mt-4">
                <label for="current-password" class="form-label">current password</label>
                <input type="password" class="form-control" name="current-password" id="current-password" required>
            </div>
            <div class="col-12 mt-4">
                <label for="new-password" class="form-label">new password</label>
                <input type="password" class="form-control" name="new-password" id="new-password" required>
            </div>
            <div class="col-12 mt-4">
                <label for="confirm-password" class="form-label">Confirm password</label>
                <input type="password" class="form-control" name="confirm-password" id="confirm-password" required>
            </div>
            <button class="btn btn-success col-12 col-md-auto fs-4 my-4" type="submit" name="updatePassword">Update Password</button>
        </form>
        <?php
        require '../components/footer-admin.php'
    ?>
        </div>
    </body>
</html>