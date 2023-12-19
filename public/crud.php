<a href="Type.php">add product</a>
<div class="navbar">
        <img src="alhedia.png" alt="Jewelry Website Logo" class="logo"> <!-- Logo inside the navbar -->
        <a href="admin.php">Admin Dashboard</a>
        <a href="add_admin.php">Add Admin</a>
        <a href="crud.php">Product</a>
        <a href="usercrud.php">Users</a>
        <a href="Admins.php">Admins</a>

        
    </div>

<?php
define('__ROOT__', "../app/");
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
echo "<table border='1'>";
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
        $imageSrc = "../uploads/" . htmlspecialchars($productPictures[0]);
    } else {
        $imageSrc = "uploads/default.jpg";
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
<style>
        /* Base styles for the navbar and form */
        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f5f5f5;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            font-weight: bold;
        }

        input[type="text"],
        input[type="number"],
        textarea {
            width: 100%;
            padding: 10px;
        }

        button {
            background-color: #007BFF;
            color: #fff;
            padding: 10px 20px;
            border: none;
            cursor: pointer;
        }

        .navbar {
            width: 250px;
            height: 100%;
            background-color: white;
            position: fixed;
            left: 0;
            top: 0;
            color: white;
            padding: 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        body {
    color: black;
    background: #D3D3D3;
    font-family: 'Lato', sans-serif;
    font-size: 15px;
    line-height: 1.42857;
    margin-left: 300px; /* Increase the margin to shift the content further right */
}

.navbar a {
            display: block;
            width: 60%;
            padding: 10px 20px;
            text-decoration: none;
            text-align: center;
            color: white;
            font-weight: bold;
            margin: 10px 0;
            border-radius: 5px;
            background-color: gray;
            transition: background-color 0.3s, color 0.3s;
        }

        .navbar a:hover {
            background-color: #0056b3;
        }
        .content {
            margin-left: 0;
            padding: 20px;
        }

        /* Media query for smaller screens */
        @media (max-width: 768px) {
            .container {
                width: 100%;
            }

            .navbar {
                width: 200px;
                height: 100%;
                background-color: #333;
                position: fixed;
                left: 0;
                top: 0;
                color: white;
                padding: 20px;
                display: flex;
                flex-direction: column;
                /* Stack logo and links vertically */
                align-items: center;
                /* Center content horizontally */
            }

            .content {
                margin-left: 0;
            }
        }

       
        @media (max-width: 768px) {
            .container {
                width: 100%;
            }

            .navbar {
                width: 200px;
                height: 100%;
                background-color: #333;
                position: fixed;
                left: 0;
                top: 0;
                color: white;
                padding: 20px;
                display: flex;
                flex-direction: column;
                align-items: center;
            }

            .content {
                margin-left: 0;
            }
        }

        .logo {
            width: 150px;
            height: auto;
            margin: 20px 0;
        }

        @media (max-width: 768px) {
            .navbar {
                width: 100%;
                background-color: #007BFF;
                padding: 10px;
                align-items: flex-start;
            }

            .navbar a {
                padding: 10px 20px;
                margin: 10px 0;
            }

            .logo {
                width: 100px;
                margin: 10px 0;
            }
        }

        .stats {
            display: flex;
            justify-content: space-between;
            margin: 20px 0;
        }

        .stat-box {
            width: 30%;
            padding: 20px;
            background-color: #f5f5f5;
            border: 1px solid #ddd;
            border-radius: 5px;
            text-align: center;
        }
    </style>