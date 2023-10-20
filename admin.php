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

        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f5f5f5;
            border: 1px solid #ddd;
            border-radius: 5px;
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

    <div class="content"> <!-- Adjusted the container to move the content to the right of the navbar -->
        <h2>Admin Dashboard</h2>
        <div class="stats">
            <div class="stat-box">
                <h3>Total Products</h3>
                <p>100</p> <!-- Replace with actual product count -->
            </div>

            <div class="stat-box">
                <h3>Total Sales</h3>
                <p>$10,000</p> <!-- Replace with actual sales data -->
            </div>

            <div class="stat-box">
                <h3>Users Online</h3>
                <p>50</p> <!-- Replace with actual online user count -->
            </div>
        </div>
    </div>
</body>
</html>
