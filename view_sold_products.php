<!DOCTYPE html>
<html>
<head>
    <title>Jewelry Website</title>
    <style>
        /* CSS for styling the navbar */
        .navbar {
            width: 200px;
            height: 100%;
            background-color: #333;
            position: fixed;
            left: 0;
            top: 0;
            color: white;
            padding: 20px;
        }

        body {
    color: #666666;
    font-family: 'Lato', sans-serif;
    font-size: 15px;
    line-height: 1.42857;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f5f5f5;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        .product {
            margin-bottom: 20px;
            border: 1px solid #ccc;
            padding: 10px;
        }

        .product h3 {
            margin: 0;
        }

        .product p {
            margin: 0;
        }

        .navbar a {
            display: block;
            padding: 10px 0;
            text-decoration: none;
            color: white;
        }

        .content {
            margin-left: 220px; /* Adjust based on your design */
            padding: 20px;
        }
        @media (max-width: 768px) {
            .container {
                width: 100%;
            }

            .navbar {
                width: 100%;
                height: auto;
                position: static;
                padding: 10px;
            }

            .content {
                margin-left: 0;
            }
        }

    </style>
</head>
<body>
    <div class="navbar">
        <a href="admin.php">Admin Dashboard</a>
        <a href="add_admin.php">Add Admin</a>
        <a href="add_product.php">Add Product</a>
        <a href="view_sold_products.php">View Sold Products</a>
    </div>

    <div class="container">
        <h2>View Sold Products</h2>

        <!-- Product 1 -->
        <div class="product">
            <h3>Product Name 1</h3>
            <p>Units Sold: 50</p>
        </div>

        <!-- Product 2 -->
        <div class="product">
            <h3>Product Name 2</h3>
            <p>Units Sold: 30</p>
        </div>

        <!-- Product 3 -->
        <div class="product">
            <h3>Product Name 3</h3>
            <p>Units Sold: 20</p>
        </div>
        
        <!-- You can add more product containers here -->
    </div>
</body>
</html>
