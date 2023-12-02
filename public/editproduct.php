<!DOCTYPE html>
<html>

<head>

    <title>Edit Product</title>
   
</head>

<body>
 <?php
 define('__ROOT__', "../app/");
 require_once(__ROOT__ . "model/Products.php");
 require_once(__ROOT__ . "controller/ProductController.php");
 require_once(__ROOT__ . "views/ProductView.php");
 
 $model = new Product();
 $controller = new ProductController($model);
 $view = new ProductView($controller, $model);
 if (isset($_GET['edit_id'])) {
    $productID = $_GET['edit_id'];
}
        if (isset($_POST['submit'])) {
            $ProductID=$_POST['ProductID'];
            $ProductName = $_POST['ProductName'];
    $ProductPictures = $_FILES['ProductPicture']['name'];
    $Description = $_POST['Description'];
    $Weight = $_POST['Weight'];
    $Size = $_POST['Size'];
    $Price = $_POST['Price'];
    $Availability = $_POST['Availability'];
    $CategoryID = $_POST['CategoryID'];
    $MetalID = $_POST['MetalID'];
    $ProductPictures = $model->uploadProductPictures($_FILES);
   
 
            $controller->updateProduct($ProductID,$ProductName, $ProductPictures, $Description, $Weight, $Size, $Price, $Availability, $CategoryID, $MetalID) ;
    }
        ?>
    <div class="navbar">
        <img src="alhedia.png" alt="Jewelry Website Logo" class="logo"> <!-- Logo inside the navbar -->
        <a href="admin.php">Admin Dashboard</a>
        <a href="add_admin.php">Add Admin</a>
        <a href="crud.php">Product</a>
        <a href="usercrud.php">Users</a>
    </div>

    <div class="container">
        <h2>Edit Product</h2>
        <?php
         echo $view->editform($productID);
        ?>
       
    </div>
</body>

</html>
<script>
    function validateForm() {
        var productName = document.getElementById("ProductName").value;
        var nameError = document.getElementById("nameError");
        var description = document.getElementById("Description").value;
        var descriptionError = document.getElementById("descriptionError");
        var price = parseFloat(document.getElementById("Price").value);
        var priceError = document.getElementById("priceError");
        var weight = parseFloat(document.getElementById("Weight").value);
        var weightError = document.getElementById("weightError");
        var size = parseFloat(document.getElementById("Size").value);
        var sizeError = document.getElementById("sizeError");
        var picture = document.querySelector('input[type="file"]').files[0];
        var pictureError = document.getElementById("pictureError");

        // Validate ProductName and Description
        var nameDescriptionPattern = /^[A-Za-z\s]+$/;
        if (!nameDescriptionPattern.test(productName) || productName.length < 8) {
            nameError.textContent = " enter valid Product Name ";
            return false;
        } else {
            nameError.textContent = "";
        }

        if (!nameDescriptionPattern.test(description) || description.length < 8) {
            descriptionError.textContent = " enter valid Description .";
            return false;
        } else {
            descriptionError.textContent = "";
        }

        // Validate Price, Weight, and Size
        if (isNaN(price) || price <= 0) {
            priceError.textContent = "Price must be a positive number.";
            return false;
        } else {
            priceError.textContent = "";
        }

        if (isNaN(weight) || weight <= 0) {
            weightError.textContent = "Weight must be a positive number.";
            return false;
        } else {
            weightError.textContent = "";
        }

        if (isNaN(size) || size < 0) {
            sizeError.textContent = "Size must be a non-negative number.";
            return false;
        } else {
            sizeError.textContent = "";
        }

        // Validate ProductPicture file extension
        if (!isValidImageFile(picture)) {
            pictureError.textContent = "Image file must be in JPEG, PNG, GIF, or TIFF format.";
            return false;
        } else {
            pictureError.textContent = "";
        }

        return true;
    }

    function isValidImageFile(file) {
        var allowedExtensions = ["jpg", "jpeg", "png", "gif", "tiff"];
        if (file) {
            var fileExtension = file.name.split('.').pop().toLowerCase();
            return allowedExtensions.indexOf(fileExtension) !== -1;
        }
        return false;
    }
</script>
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
        @@media (max-width: 768px) {
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