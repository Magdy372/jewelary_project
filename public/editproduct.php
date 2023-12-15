<?php
$conn = mysqli_connect("172.232.216.8", "root", "Omarsalah123o", "Jewelry_project");
define('__ROOT__', "../app/");
require_once(__ROOT__ . "model/Product.php");
require_once(__ROOT__ . "controller/ProductController.php");

$model = new Product();
$controller = new ProductController($model);

// Fetch the product details for editing
$productId = $_GET['edit_id'] ?? null;
if ($productId !== null) {
    $product = $model->getProductById($productId);
    $options = $model->getOptionsForType($product['Product_Type']);
    $sovValues = $model->getProductSOVValues($productId);
} else {
    // Handle the case where $productId is not provided or invalid
    echo "Error: Invalid product ID.";
    exit();
}

if (isset($_POST['submit'])) {
    $productName = $_POST["productName"];
    $description = $_POST["description"];
    $price = $_POST["price"];
    $optionsValues = $_POST["options"] ?? [];
    if (empty($_FILES['ProductPicture']['name'][0])) {
        // No new pictures uploaded, reuse existing ones
        $productPictures = $product['ProductPicture'];
    } else {
        $productPictures = $model->uploadProductPictures($_FILES);
    }

    $controller->updateProduct($productId, $productName, $description, $productPictures, $price, $optionsValues);
    header("Location: crud.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Product</title>
</head>
<body>
<div class="navbar">
    <img src="alhedia.png" alt="Jewelry Website Logo" class="logo">
    <a href="admin.php">Admin Dashboard</a>
    <a href="add_admin.php">Add Admin</a>
    <a href="crud.php">Product</a>
    <a href="usercrud.php">Users</a>
    <a href="Admins.php">Admins</a>

</div>
<!-- Update Product Form -->
<form method="post" enctype="multipart/form-data"> <!-- Add enctype for file uploads -->
    <input type="hidden" name="action" value="update_product">
    <input type="hidden" name="productId" value="<?php echo $product['id']; ?>">

    <!-- Other form fields -->

    <label for="productName">Product Name:</label>
    <input type="text" name="productName" value="<?php echo $product['ProductName']; ?>" required><br>

    <label for="description">Description:</label>
    <input type="text" name="description" value="<?php echo $product['Description']; ?>" required><br>

    <!-- Display existing product pictures -->
    <?php
    $productPictures = explode(',', $product['ProductPicture']);
    foreach ($productPictures as $picture) {
        echo '<img src="../uploads/' . $picture . '" width="80" height="80">';
    }
    ?>
    <label for="ProductPicture">Product Pictures:</label>
    <input type="file" name="ProductPicture[]" multiple="multiple" accept=".jpg, .jpeg, .png, .gif"><br>

    <!-- Add other input fields as needed -->

    <label for="price">Price:</label>
    <input type="text" name="price" value="<?php echo $product['Price']; ?>" required><br>

    <!-- Assuming $options contains the available options and $sovValues contains the SOV values -->
    <div id="optionsContainer">
        <?php foreach ($options as $option): ?>
            <?php
            // Fetch and display existing option value if needed
            $existingOptionValue = ''; // Default value if no SOV value is found
            foreach ($sovValues as $sov) {
                if ($sov['Product_Type_S_O'] == $option['ID']) {
                    $existingOptionValue = $sov['Value'];
                    break;
                }
            }
            ?>

            <label for="option_<?php echo $option['ID']; ?>"><?php echo $option['Name']; ?>:</label>
            <?php
            // Check if the option is 'Size'
            if ($option['Name'] == 'Size') {
                echo "<input type='number' name='options[{$option['ID']}]' value='{$existingOptionValue}' required><br>";
            } else {
                // Fetch option values for the dropdown
                $optionValuesQuery = "SELECT * FROM option_values WHERE Option_ID = '{$option['ID']}'";
                $optionValuesResult = $conn->query($optionValuesQuery);

                if ($optionValuesResult && $optionValuesResult->num_rows > 0) {
                    echo "<select name='options[{$option['ID']}]' required>";
                    while ($valueRow = $optionValuesResult->fetch_assoc()) {
                        $optionValue = $valueRow['Value'];
                        $isSelected = ($existingOptionValue == $optionValue) ? 'selected' : '';
                        echo "<option value='{$optionValue}' {$isSelected}>{$optionValue}</option>";
                    }
                    echo "</select><br>";
                } else {
                    echo "Error fetching option values.";
                }
            }
            ?>
        <?php endforeach; ?>
    </div>

    <input type="submit" name="submit" value="Update Product">
</form>
</body>
</html>

</body>
</html>
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