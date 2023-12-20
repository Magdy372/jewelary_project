<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
$user_role = $_SESSION['user_role'];
if ($user_role !== "1") {
    // Redirect to another page or display an access denied message
    header("Location: access_denied.php");
    exit();
}

define('__ROOT__', "../");

require_once(__ROOT__ . "model/Product.php");
require_once(__ROOT__ . "controller/ProductController.php");

$model = new Product();
$productController = new ProductController($model);
$totalProducts = $productController->getTotalProducts();



require_once(__ROOT__ . "model/Users.php");
require_once(__ROOT__ . "controller/AdminController.php");

$modeladmin = new Users();
$adminController = new AdminController($modeladmin);
$totalAdmins = $adminController->getTotalAdmins();



require_once(__ROOT__ . "model/Users.php");
require_once(__ROOT__ . "controller/UserController.php");

$modeluser = new Users();
$userController = new UserController($modeluser);
$totalUsers = $userController->getTotalUsers();


?>
<!DOCTYPE html>
<html>

<head>
    <title>Jewelry Website</title>
    <link rel="stylesheet" href="../../css/admin.css">
</head>

<body>

    <div class="navbar">
        <img src="alhedia.png" alt="Jewelry Website Logo" class="logo">
        <!-- Logo inside the navbar -->
        <a href="admin.php">Admin Dashboard</a>
        <!-- <a href="add_admin.php">Add Admin</a> -->
        <a href="crud.php">Product</a>
        <a href="usercrud.php">Users</a>
        <a href="Admins.php">Admins</a>
    </div>

    <div class="content">
        <h2>Admin Dashboard</h2>
        <div class="stats">
            <div class="stat-box">
                <h3>Total Products</h3>
                <h4><?php echo $totalProducts; ?></h4>
            </div>
            <div class="stat-box">
                <h3>Total Admins</h3>
                <h4><?php echo $totalAdmins; ?></h4>
            </div>
            <div class="stat-box">
                <h3>Total Users</h3>
                <h4><?php echo $totalUsers; ?></h4>
            </div>
        </div>
    </div>
</body>

</html>