<!DOCTYPE html>
<html>
<head>
    <title>Jewelry Website</title>
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

        /* Media query for smaller screens */
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
        <h2>Add a New Admin</h2>
        <form action="process_product.php" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="Username">Username</label>
                <input type="text" name="Username" id="Username" required>
            </div>

            <div class="form-group">
                <label for="Password">Password</label>
                <input type="text" name="Password" id="Password" required>
            </div>

            
            <div class="form-group">
                <label for="Admin_image">Admin Image</label>
                <input type="file" name="Admin_image" id="Admin_image" accept="image/*" required>
            </div>

            <button type="submit">Add admin</button>
        </form>
    </div>
</body>
</html>
