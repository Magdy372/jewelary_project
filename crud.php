<!DOCTYPE html>
<html>
<head>
    <title>Product Management</title>
</head>
<body>
    <h2>Product Management</h2>
    <a href="addproduct.php">Add Product</a>
    <table>
        <tr>
            <th>Product Name</th>
            <th>Product Pictures</th>
            <th>Description</th>
            <th>Weight</th>
            <th>Size</th>
            <th>Price</th>
            <th>Availability</th>
            <th>MetalID</th>
            <th>Category</th>
            <th>Actions</th>
        </tr>

        <?php
        // Replace this with your database connection logic
        $con = mysqli_connect("172.232.216.8", "root", "Omarsalah123o", "Jewelry_project");

        if (!$con) {
            die("Connection failed: " . mysqli_connect_error());
        }

       //delete
        include_once "productclass.php";
        if (isset($_POST['delete_product'])) {
            $ProductID = $_POST['delete_product'];
            if (Product::deleteProduct($con, $ProductID)) {
                header("Location:crud.php");
                // You can optionally redirect the user or perform other actions after deletion.
            } else {
                echo "Failed to delete the product.";
            }
        }

        // Replace this with code to fetch products from your database
        $query = "SELECT * FROM Product";
        $result = mysqli_query($con, $query);

        if ($result) {
            while ($product = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>{$product['ProductName']}</td>";

                $ProductPictures = explode(',', $product['ProductPicture']);
                if (!empty($ProductPictures[0])) {
                    $imageSrc = "uploads/" . $ProductPictures[0];
                } else {
                    $imageSrc = "uploads/default.jpg";
                }

                echo '<td><img src="' . $imageSrc . '" width="80" height="80"></td>';
                echo "<td>{$product['Description']}</td>";
                echo "<td>{$product['Weight']}</td>";
                echo "<td>{$product['Size']}</td>";
                echo "<td>{$product['Price']}</td>";
                echo "<td>{$product['Availability']}</td>";
                $metalID = $product['MetalID'];
                $metalQuery = "SELECT MetalName FROM Metal WHERE MetalID = $metalID";
                $metalResult = mysqli_query($con, $metalQuery);
                $metal = mysqli_fetch_assoc($metalResult);
                
                echo "<td>{$metal['MetalName']}</td>";

                // Fetch and display category name for the product
                $categoryID = $product['CategoryID'];
                $categoryQuery = "SELECT CategoryName FROM Categories WHERE CategoryID = $categoryID";
                $categoryResult = mysqli_query($con, $categoryQuery);
                $category = mysqli_fetch_assoc($categoryResult);

                echo "<td>{$category['CategoryName']}</td>";
                echo "<td>";
              
                echo "<a href='editproduct.php?id={$product['ProductID']}'>Edit</a> ";
                echo "</td>";

                // Form for delete
                echo "<td>";
                echo "<form method='POST'  onsubmit='return confirm(\"Are you sure you want to delete this product?\");'>";
                echo "<input type='hidden' name='delete_product' value='{$product['ProductID']}'>";
                echo "<button type='submit'>Delete</button>";
                echo "</form>";
                echo "</td>";

                echo "</tr>";
            }
        }

        ?>
    </table>
</body>
</html>
