<?php
    session_start();
    define("location", "localhost");
    define("username", "root");
    define("password", "");
    define("database_name", "reen_shop");

    $database = new mysqli(location, username, password, database_name);
    if($database->connect_error) {
        die("Connection Error");
    }
    function create_unique_id() {
        $charecters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charecters_length = strlen($charecters);
        $random_id = '';
        for($i =0; $i < 10; $i++) {
            $random_id .= $charecters[mt_rand(0,$charecters_length - 1)];
        }
        return $random_id;
    }
?>