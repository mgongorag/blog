<?php
if(!isset($_SESSION)){
session_start();
}

if(!isset($_SESSION)){
     header("Location: index.php");
}