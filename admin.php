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
    </style>
</head>
<body>
    
    <div class="navbar">
        <a href="admin_dashboard.php">Admin Dashboard</a>
        <a href="add_admin.php">Add Admin</a>
        <a href="add_product.php">Add Product</a>
        <a href="view_sold_products.php">View Sold Products</a>
    </div>

    <div class="content">
        <!-- Page content goes here -->
        <h1>Welcome to the Jewelry Website</h1>
        <p>This is the homepage of the jewelry website. Please select an option from the navbar on the left.</p>
    </div>
</body>
</html>
