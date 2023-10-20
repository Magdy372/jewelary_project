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

    <!-- Add Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="navbar">
        <a href="admin.php">Admin Dashboard</a>
        <a href="add_admin.php">Add Admin</a>
        <a href="add_product.php">Add Product</a>
        <a href="view_sold_products.php">View Sold Products</a>
    </div>

    <!-- Your Bootstrap "Add Admin" Form -->
    <div class="content">
        <h2>Add Admin</h2>
        <form>
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <button type="submit" class="btn btn-primary">Add Admin</button>
        </form>
    </div>

    <!-- Add Bootstrap and jQuery JavaScript -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
