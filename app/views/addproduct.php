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
$model2 = new ProductType();
$controller = new ProductController($model);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["selectProductType"])) {
        $_SESSION["Type"] = ($_POST["selectProductType"]);
        $selectedProductType = $_SESSION["Type"];
        $result = $model2->getOptionsForType($selectedProductType);
    } elseif (isset($_POST["productName"], $_POST["description"], $_FILES["ProductPicture"], $_POST["price"])) {
        // Retrieve form data
        $productName = ($_POST["productName"]);
        $description = ($_POST["description"]);
        $productPictures = $_FILES['ProductPicture']['name'];
        $price = ($_POST["price"]);
        $optionsValues = $_POST["options"] ?? [];

        // Check if product type is set in session
        if (!isset($_SESSION["Type"])) {
            echo "Error: Product type not set.";
            exit();
        }

        $productType = $_SESSION["Type"];

        // Insert into the database
        $controller->insertProduct($productName, $description, $productPictures, $price, $productType, $optionsValues);
        header("Location: crud.php");
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product</title>
    <link rel="stylesheet" href="../../css/addproduct.css">
</head>

<body>
    <div class="navbar">
        <img src="alhedia.png" alt="Jewelry Website Logo" class="logo">
        <a href="admin.php">Admin Dashboard</a>
        <!-- <a href="add_admin.php">Add Admin</a> -->
        <a href="crud.php">Product</a>
        <a href="usercrud.php">Users</a>
        <a href="Admins.php">Admins</a>
    </div>

    <!-- Add Product Form -->
    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data">
        <?php if (!isset($_SESSION["Type"])) : ?>
            <label for="selectProductType">Select Product Type:</label>
            <select name="selectProductType" required>
                <?php
                $productTypes = $controller->getAllProductTypes();
                foreach ($productTypes as $row) {
                    echo "<option value='{$row['ID']}'>{$row['Type']}</option>";
                }
                ?>
            </select>
            <input type="submit" value="Next">
        <?php else : ?>
            <label for="productName">Product Name:</label>
            <input type="text" name="productName" required><br>

            <label for="description">Description:</label>
            <input type="text" name="description" required><br>

            <label for="ProductPicture">Product Pictures:</label>
            <input type="file" name="ProductPicture[]" multiple="multiple" accept=".jpg, .jpeg, .png, .gif"><br>

            <label for="price">Price:</label>
            <input type="number" name="price" required><br>

            <!-- Fetch options values from the database -->
            <?php
            if (isset($result)) {
                foreach ($result as $row) {
                    $optionId = $row['ID'];
                    $optionName = $row['Name'];

                    echo "<label for='option_$optionId'>$optionName:</label>";

                    // Check if the option is 'Size'
                    if ($optionName == 'Size') {
                        echo "<input type='number' name='options[$optionId]' required><br>";
                    } else {
                        // Fetch option values for the dropdown
                        $optionValues = $model->getOptionValues($optionId);

                        echo "<select name='options[$optionId]' required>";
                        foreach ($optionValues as $optionValue) {
                            echo "<option value='$optionValue'>$optionValue</option>";
                        }
                        echo "</select><br>";
                    }
                }
            }
            ?>

            <input type="submit" value="Add Product">
        <?php endif; ?>
    </form>
</body>

</html>
