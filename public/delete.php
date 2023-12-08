<?php


session_start();


define('__ROOT__', "../app/");
require_once(__ROOT__ . "model/User.php");
require_once(__ROOT__ . "controller/UserController.php");


$UserObject=new User($_SESSION["UserID"]);
if(User::deleteUser($UserObject)){
    session_destroy();
    header("Location:index.php");
    exit;
}

