<?php


include_once "UserClass.php";
session_start();

$UserObject=new User($_SESSION["UserID"]);
if(User::deleteUser($UserObject)){
    session_destroy();
    header("Location:index.php");
    exit;
}

