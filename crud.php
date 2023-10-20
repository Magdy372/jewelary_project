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
    <form method="post" enctype="multipart/form-data">
        <label for="ProductName">Product Name:</label>
        <input type="text" name="ProductName" required><br>

        <label for="ProductPicture">Product Picture:</label>
        <input type="file" name="ProductPicture" required><br>

        <label for="Description">Description:</label>
        <textarea name="Description" required></textarea><br>

        <label for="Weight">Weight:</label>
        <input type="text" name="Weight" required><br>

        <label for="Size">Size:</label>
        <input type="text" name="Size"><br>

        <label for="Price">Price:</label>
        <input type="text" name="Price" required><br>

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

        <input type="submit" name="submit">
    </form>

    <?php
    include_once "productclass.php";

    if (isset($_POST['submit'])) {
        $ProductName = $_POST['ProductName'];
        $ProductPicture = $_FILES['ProductPicture']['name'];
        $Description = $_POST['Description'];
        $Weight = $_POST['Weight'];
        $Size = $_POST['Size'];
        $Price = $_POST['Price'];
        $Availability = $_POST['Availability'];
        $CategoryID = $_POST['CategoryID'];

        // Check if CategoryID is not empty
        if (empty($CategoryID)) {
            echo "Please select a category for the product.";
        } else {
            if (Product::addProduct($con, $ProductName, $ProductPicture, $Description, $Weight, $Size, $Price, $Availability, $CategoryID)) {
                echo "Product added successfully!";
            } else {
                echo "Failed to add the product.";
            }
        }

        // Handle file upload
        $targetDirectory = "uploads/";
        $targetFile = $targetDirectory . basename($_FILES['ProductPicture']['name']);

        if (move_uploaded_file($_FILES['ProductPicture']['tmp_name'], $targetFile)) {
            echo "Product picture uploaded successfully!";
        } else {
            echo "Failed to upload the product picture.";
        }
    }
    ?>
</body>
</html>
