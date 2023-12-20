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
?>

<head>
    <link rel="stylesheet" href="../../css/crud.css">
</head>

<div class="navbar">
    <img src="alhedia.png" alt="Jewelry Website Logo" class="logo"> <!-- Logo inside the navbar -->
    <a href="admin.php">Admin Dashboard</a>
    <a href="add_admin.php">Add Admin</a>
    <a href="crud.php">Product</a>
    <a href="usercrud.php">Users</a>
    <a href="Admins.php">Admins</a>


</div>

<?php
define('__ROOT__', "../");
require_once(__ROOT__ . "model/Product.php");
require_once(__ROOT__ . "controller/ProductController.php");

$model = new Product();
$controller = new ProductController($model);


// Fetch products
$products = $model->getAllProducts();

if (isset($_GET['action'])) {
    switch ($_GET['action']) {
        case 'delete_product':
            if (isset($_GET['product_id'])) {
                $id = $_GET['product_id'];
                $controller->deleteProduct($id);
                header("Location: crud.php");
                exit();
            }
            break;
    }
}


// HTML Table Header
echo "<table>";
echo "<tr>";
echo "<th>Product Name</th>";
echo "<th>Description</th>";
echo "<th>Product Pictures</th>";
echo "<th>Price</th>";
echo "<th>Product Type</th>";
echo "<th>Actions</th>";

echo "</tr>";

// Loop through products and display each row
foreach ($products as $product) {
    echo "<tr>";
    echo "<td>{$product['ProductName']}</td>";
    echo "<td>{$product['Description']}</td>";
    $productPictures = explode(',', $product['ProductPicture']);
    if (!empty($productPictures[0])) {
        $imageSrc = "../../uploads/" . htmlspecialchars($productPictures[0]);
    } else {
        $imageSrc = "../../uploads/default.jpg";
    }
    echo '<td><img src="' . $imageSrc . '" width="80" height="80"></td>';
    echo "<td>{$product['Price']}</td>";
    $productTypeId = $product['Product_Type'];
    $model2 = new ProductType($productTypeId);
    $controller = new ProductController($model2);
    $productTypeName = $model2->getType();
    echo "<td>{$productTypeName}</td>";
    echo "<td>";

    // Edit link
    echo '<a class="edit-button" href="editproduct.php?edit_id=' . htmlspecialchars($product['id']) . '">Edit</a> ';

    // Delete form using GET
    echo '<form method="GET" action="crud.php" onsubmit="return confirm(\'Are you sure you want to delete this product?\');">';
    echo '<input type="hidden" name="action" value="delete_product">';
    echo '<input type="hidden" name="product_id" value="' . htmlspecialchars($product['id']) . '">';
    echo '<button class="delete" type="submit">Delete</button>';
    echo '</form>';

    echo "</td>";
    echo "</tr>";
}

// HTML Table Footer
echo "</table>";
?>
<a href="Type.php" class="add-product-button">add product</a>