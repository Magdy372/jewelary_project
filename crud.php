<!DOCTYPE html>
<html>

<head>
    <title>Product Management</title>

    <style>
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
            background:#D3D3D3;
            font-family: 'Lato', sans-serif;
            font-size: 15px;
            line-height: 1.42857;
        }

        .navbar a {
    display: block;
    width: 60%; /* Set a fixed width for all buttons */
    padding: 10px 20px;
    text-decoration: none;
    text-align: center; /* Center the text */
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


        table {
            width: 80%;
            /* Reduce the table width */
            border-collapse: collapse;
            margin: 0 auto 0 20%;
            /* Shift the table to the right by adding a left margin */
        }

        th,
        td {
            text-align: center;
            padding: 5px;
            /* Reduce the padding inside table cells */
        }

        th {
            background-color: #f2f2f2;
        }

        .actions {
            display: flex;
            justify-content: center;
        }

        .add-product-button {
            display: inline-block;
            padding: 5px 10px;
            /* Reduce the button padding */
            background-color: #007BFF;
            color: #fff;
            text-decoration: none;
            border: none;
            border-radius: 5px;
            position: relative;
            top: 50%;
            left: 55%;
            transform: translate(-50%, -50%);
        }


        .add-product-button:hover {
            background-color: #0056b3;
        }

        .center-h2 {
            text-align: center;
            position: absolute;
            top: 55%;
            right: 50%;
            /* transform: translate(-50%, -50%); */
        }
    </style>
</head>

<body>
    <div class="navbar">
        <img src="alhedia.png" alt="Jewelry Website Logo" class="logo"> <!-- Logo inside the navbar -->
        <a href="admin.php">Admin Dashboard</a>
        <a href="add_admin.php">Add Admin</a>
        <a href="crud.php">Product</a>
        <a href="usercrud.php">Users</a>
    </div>

    <div class="container">
        <h2>Product Management</h2>
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
        <a class="add-product-button" href="addproduct.php">Add Product</a>
    </div>
</body>

</html>