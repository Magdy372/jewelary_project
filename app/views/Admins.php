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
        require_once(__ROOT__ . "controller/AdminController.php");

        $model = new Users();
        $controller = new AdminController($model);

        // Check if form is submitted to insert a new admin
        if (isset($_POST['Submit'])) {
            $Fname = $_POST['FName'];
            $Lname = $_POST['LName'];
            $password = $_POST['Password'];
            $Conpass = $_POST['conPass'];
            $email = $_POST['Email'];

            $controller->insert_admin($Fname, $Lname, $password, $Conpass, $email);
        }

        if (isset($_POST['deleteAdmin'])) {
            $adminID = $_POST['adminID'];
            $controller->deleteAdmin($adminID);
            // Redirect back to the Admins.php page after deletion
            header("Location: Admins.php");
            exit();
        }

        // Fetch and display admins with usertypeid = 1
        $admins = $controller->getAdminsByUserType(1);
        ?>


        <!DOCTYPE html>
        <html lang="en">

        <head>
            <title>Admin</title>
            <link rel="stylesheet" href="../../css/AddAdmin.css">
        </head>

        <body>




            <div class="navbar">
            <img src="../../img/alhedia.png" alt="Jewelry Website Logo" class="logo">   <!-- Logo inside the navbar -->
                <a href="admin.php">Admin Dashboard</a>
                <!-- <a href="add_admin.php">Add Admin</a> -->
                <a href="crud.php">Product</a>
                <a href="usercrud.php">Users</a>
                <a href="Admins.php">Admins</a>

            </div>


            <div class="content">
                <h2>Edit Admins</h2>
                <table>
                    <thead>
                        <tr>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Email</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $admins = $controller->getAdminsByUserType(1);
                        foreach ($admins as $admin) : ?>
                            <tr>
                                <td><?php echo $admin['FName']; ?></td>
                                <td><?php echo $admin['LName']; ?></td>
                                <td><?php echo $admin['Email']; ?></td>
                                <td>
                                    <form method="post" style="display: inline;">
                                        <input type="hidden" name="adminID" value="<?php echo $admin['ID']; ?>">
                                        <button type="submit" name="deleteAdmin">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <a href="add_admin.php" class="add-admin-button">Add Admin</a>
        </body>

        </html>