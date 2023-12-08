
<?php
$conn = mysqli_connect("172.232.216.8", "root", "Omarsalah123o", "habd");
define('__ROOT__', "../app/");
require_once(__ROOT__ . "model/Product.php");
require_once(__ROOT__ . "controller/ProductController.php");

$model = new Product();
$controller = new ProductController($model);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["selectProductType"])) {
        $_SESSION["Type"] = ($_POST["selectProductType"]);
        $selectedProductType = $_SESSION["Type"];
        echo "$selectedProductType";
        $result = $model->getOptionsForType($selectedProductType);
    } elseif (isset($_POST["productName"], $_POST["description"], $_FILES["ProductPicture"], $_POST["price"])) {
        // Retrieve form data
        $productName = ($_POST["productName"]);
        $description = ($_POST["description"]);
        $productPictures = $_FILES['ProductPicture']['name'];
        $price = ($_POST["price"]);
        $optionsValues = $_POST["options"] ?? []; // Ensure optionsValues is defined
       

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
</head>
<body>
<div class="navbar">
        <img src="alhedia.png" alt="Jewelry Website Logo" class="logo"> <!-- Logo inside the navbar -->
        <a href="admin.php">Admin Dashboard</a>
        <a href="add_admin.php">Add Admin</a>
        <a href="crud.php">Product</a>
        <a href="usercrud.php">Users</a>
    </div>
<!-- Add Product Form -->
<form method="post"  action="<?php echo $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data">
    <?php if (!isset($_SESSION["Type"])): ?>
        <label for="selectProductType">Select Product Type:</label>
        <select name="selectProductType" required>
            <?php
            $productTypes = $conn->query("SELECT * FROM product_type");
            while ($row = $productTypes->fetch_assoc()) {
                echo "<option value='{$row['ID']}'>{$row['Type']}</option>";
            }
            ?>
        </select>
        <input type="submit" value="Next">
    <?php else: ?>
        <label for="productName">Product Name:</label>
        <input type="text" name="productName" required><br>

        <label for="description">Description:</label>
        <input type="text" name="description" required><br>

        <label for="ProductPicture">Product Pictures:</label>
        <input type="file" name="ProductPicture[]" multiple="multiple" accept=".jpg, .jpeg, .png, .gif"><br>

        <label for="price">Price:</label>
        <input type="number" name="price" required><br>

        <!-- Display options based on the selected product type -->
        <div id="optionsContainer">
            <?php
            if (isset($result)) {
                foreach ($result as $row) {
                    $optionId = $row['ID'];
                    $optionName = $row['Name'];

                    echo "<label for='option_$optionId'>$optionName:</label>";
                    $inputType = ($optionName == 'Size') ? 'number' : 'text';

    echo "<input type='$inputType' name='options[$optionId]' required><br>";
                }
            }
            ?>
        </div>

        <input type="submit" value="Add Product">
    <?php endif; ?>
</form>

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