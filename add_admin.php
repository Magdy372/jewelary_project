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
            background-color: #0056b3;
            color: #fff;
            padding: 10px 20px;
            border: none;
            cursor: pointer;
            position: relative;
            top: 50%;
            left: 40%;    
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
        .content {
            margin-left: 220px;
            /* Adjust based on your design */
            padding: 20px;
        }

        /* Media query for smaller screens */
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