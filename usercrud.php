<!DOCTYPE html>
<html>

<head>
    <title>User Management</title>

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
            color: #666666;
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

        table {
            width: 80%;
            border-collapse: collapse;
            margin: 0 auto 0 20%;
        }

        th, td {
            text-align: center;
            padding: 5px;
        }

        th {
            background-color: #f2f2f2;
        }

        .add-user-button {
            display: inline-block;
            padding: 5px 10px;
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

        .add-user-button:hover {
            background-color: #0056b3;
        }

        .center-h2 {
            text-align: center;
            position: absolute;
            top: 55%;
            right: 50%;
        }
        @media (max-width: 768px) {
            /* ... Your existing responsive CSS ... */
        }
        .logo {
    width: 150px;
    height: auto;
    margin: 20px 0;
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
        <h2>User Management</h2>
        <table>
            <tr>
                <th>ID</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email</th>
                <th>Actions</th>
            </tr>

            <?php
            include_once "UserClass.php"; // Include your User class file
            $users = User::SelectAllUsersInDB(); // Fetch all users

            if (isset($_GET['delete_id'])) {
                $userID = $_GET['delete_id'];
                $UserObject = new User($userID);
                if (User::deleteUser($UserObject)) {
                    header("Location:usercrud.php");
                    exit;
                }
            }

            echo '<a href="#">Create New User</a>';

            // Display the user list
            foreach ($users as $user) {
                echo "<tr>";
                echo "<td>{$user->ID}</td>";
                echo "<td>{$user->FName}</td>";
                echo "<td>{$user->LName}</td>";
                echo "<td>{$user->Email}</td>";
                echo "<td><a href='edituser.php?edit_id={$user->ID}'>Edit</a> | <a href='usercrud.php?delete_id={$user->ID}'>Delete</a></td>";
                echo "</tr>";
            }
            ?>

        </table>
        <a class="add-user-button" href="#">Add User</a>
    </div>
</body>

</html>
