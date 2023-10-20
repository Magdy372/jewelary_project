<!DOCTYPE html>
<html>
<head>
    <title>Add Product</title>
</head>
<body>
    <h2>Add Product</h2>
    <?php
    $con = mysqli_connect("172.232.216.8", "root", "Omarsalah123o", "Jewelry_project");
    if (!$con) {
        die("Connection failed: " . mysqli_connect_error());
    }
    ?>
    <form name="productForm" method="post" enctype="multipart/form-data" onsubmit="return validateForm()">
        <label for="ProductName">Product Name:</label>
        <input type="text" name="ProductName" id="ProductName" required>
        <span id="nameError" class="error"></span><br>

        <label for="ProductPicture">Product Pictures:</label>
        <input type="file" name="ProductPicture[]" multiple="multiple" accept=".jpg, .jpeg, .png, .gif" required>
        <span id="pictureError" class="error"></span><br>

        <label for="Description">Description:</label>
        <textarea name="Description" id="Description" required></textarea>
        <span id="descriptionError" class="error"></span><br>

        <label for="Weight">Weight:</label>
        <input type="number" name="Weight" id="Weight" required>
        <span id="weightError" class="error"></span><br>

        <label for="Size">Size:</label>
        <input type="number" name="Size" id="Size">
        <span id="sizeError" class= "error"></span><br>

        <label for="Price">Price:</label>
        <input type="number" name="Price" id="Price" required>
        <span id="priceError" class="error"></span><br>

        <label for="Availability">Availability:</label>
        <select name="Availability">
            <option value="1">Available</option>
            <option value="0">Not Available</option>
        </select><br>

        <label for="CategoryID">Category:</label>
        <select name="CategoryID" id="CategoryID">
            <?php
            // Fetch and display category names and IDs
            $categoryQuery = "SELECT CategoryID, CategoryName FROM Categories";
            $categoryResult = mysqli_query($con, $categoryQuery);

            if ($categoryResult) {
                while ($category = mysqli_fetch_assoc($categoryResult)) {
                    echo "<option value='{$category['CategoryID']}'>{$category['CategoryName']}</option>";
                }
            }
            ?>
        </select><br>

        <input type="submit" name="submit" value="Submit">
    </form>
   
    </table>

    <?php
    include_once "productclass.php";

    if (isset($_POST['submit'])) {
        $ProductName = $_POST['ProductName'];
        $ProductPictures = $_FILES['ProductPicture']['name'];
        $Description = $_POST['Description'];
        $Weight = $_POST['Weight'];
        $Size = $_POST['Size'];
        $Price = $_POST['Price'];
        $Availability = $_POST['Availability'];
        $CategoryID = $_POST['CategoryID'];

        // Check if CategoryID is not empty
        if (empty($CategoryID)) {
            echo "Please select a category for the product.";
        }

        // Handle file upload
        $targetDirectory = "uploads/";
        $uploadedFiles = [];

        foreach ($_FILES['ProductPicture']['tmp_name'] as $key => $tmp_name) {
            $fileName = basename($_FILES['ProductPicture']['name'][$key]);
            $targetFile = $targetDirectory . $fileName;

            if (move_uploaded_file($tmp_name, $targetFile)) {
                $uploadedFiles[] = $fileName;
            } else {
                echo "Failed to upload the product picture: {$fileName}<br>";
            }
        }

        // Convert uploaded files array to a comma-separated string
        $ProductPictures = implode(',', $uploadedFiles);

        if (Product::addProduct($con, $ProductName, $ProductPictures, $Description, $Weight, $Size, $Price, $Availability, $CategoryID)) {
            header("Location:crud.php");
        } else {
            echo "Failed to add the product.";
        }
    }
    ?>
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