<?php
    if(!isset($_SESSION['signIn-admin'])) {
        header("location:signin-admin.php");
        exit();
    }
?>