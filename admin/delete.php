<?php
    require '../config/constants.php';
    require '../config/session.php';
    require '../config/checkSignIn-admin.php';
    if(isset($_GET['id']) && isset($_GET['pos'])) {
        $id = $_GET['id'];
        $position = $_GET['pos'].'s';
        $querySelect = "SELECT * FROM $position where id = ?";
        $resultQuerySelect = $database->prepare($querySelect);
        $resultQuerySelect->bind_param("s", $id);
        $resultQuerySelect->execute();
        $row = $resultQuerySelect->get_result();
        if($row->num_rows == 1) {
            $queryDelete = "DELETE FROM $position where id = ?";
            $resultQueryDelete = $database->prepare($queryDelete);
            $resultQueryDelete->bind_param("s", $id);
            $resultQueryDelete->execute();
                if($resultQueryDelete) {
                get_session_success("delete.'$position'.Status","The $position delete successfully");
            } else {
                get_session_danger("delete.'$position'.Status","$position delete failed");
            }
            header("location:manage-$position.php");
        } else {
            header("location:manage-$position.php");
        }
    } else {
        header("location:manage-$position.php");
    }
?>