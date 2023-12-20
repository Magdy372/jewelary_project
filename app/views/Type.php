<?php
define('__ROOT__', "../");
require_once(__ROOT__ . "model/Product.php");
require_once(__ROOT__ . "controller/ProductController.php");
$model = new ProductType();
$controller = new ProductController($model);
$productTypes = $model->getAllProductTypes();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Select Product Type</title>
    <link rel="stylesheet" href="../../css/Type.css">
</head>

<body>
    <div class="navbar">
        <img src="alhedia.png" alt="Jewelry Website Logo" class="logo"> <!-- Logo inside the navbar -->
        <a href="admin.php">Admin Dashboard</a>
        <a href="add_admin.php">Add Admin</a>
        <a href="crud.php">Product</a>
        <a href="usercrud.php">Users</a>
        <a href="Admins.php">Admins</a>

    </div>
    <!-- Product Type Selection Page -->
    <form method="post" action="addproduct.php">
        <label for="selectProductType">Select Product Type:</label>
        <select name="selectProductType" required>
            <?php
            if ($productTypes) {
                foreach ($productTypes as $row) {
                    echo "<option value='{$row['ID']}'>{$row['Type']}</option>";
                }
            } else {
                echo "<option value=''>No product types available</option>";
            }
            ?>
        </select>
        <input type="submit" value="Next">
    </form>
</body>

</html>