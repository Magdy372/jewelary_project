<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
$user_role = $_SESSION['user_role'];
if ($user_role !== "1") {
    // Redirect to another page or display an access denied message
    header("Location: access_denied.php");
    exit();
}

define('__ROOT__', "../");
require_once(__ROOT__ . "model/Users.php");
require_once(__ROOT__ . "model/User.php");
require_once(__ROOT__ . "controller/UserController.php");
?>
<!DOCTYPE html>
<html>

<head>
    <title>User Management</title>

    <link rel="stylesheet" href="../../css/usercrudStyle.css">
</head>

<body>
    <<div class="navbar">
    <img src="../../img/alhedia.png" alt="Jewelry Website Logo" class="logo"> 
        <a href="admin.php">Admin Dashboard</a>
        <a href="Order_admin.php">Orders</a>
        <a href="crud.php">Product</a>
        <a href="usercrud.php">Users</a>
        <a href="Admins.php">Admins</a>

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



                $model = new Users();
                $controller = new UserController($model);



                // include_once "UserClass.php"; // Include your User class file
                $users = $controller->getUsers(2); // Fetch all users

                if (isset($_GET['delete_id'])) {
                    $userID = $_GET['delete_id'];
                    $model1 = new User($userID);
                    //$UserObject = new User($userID);
                    $controller1 = new UserController($model1);
                    if ($controller1->deleteUser($model1)) {
                        //header("Location:usercrud.php");
                        //exit;
                    }
                }


                // echo '<a href="#">Create New User</a>';

                // Display the user list
                foreach ($users as $user) {
                    echo "<tr>";
                    echo "<td>" . $user['ID'] . "</td>";
                    echo "<td>" . $user['FName'] . "</td>";
                    echo "<td>" . $user['LName'] . "</td>";
                    echo "<td>" . $user['Email'] . "</td>";
                    echo "<td><a class='edit' href='edituser.php?edit_id={$user['ID']}'>Edit</a> | <a class='delete' href='usercrud.php?delete_id={$user['ID']}'>Delete</a></td>";
                    echo "</tr>";
                }
                ?>

            </table>
            <!-- <a class="add-user-button" href="#">Add User</a> -->
        </div>
</body>

</html>