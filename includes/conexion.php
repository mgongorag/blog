<?php
    $server = 'localhost';
    $username = 'root';
    $password = 'admin';
    $database = 'blog';
    $DB = mysqli_connect($server, $username, $password, $database);

    mysqli_query($DB, "SET NAMES 'UTF8'");

    if(!isset($_SESSION)){
        session_start();
        }