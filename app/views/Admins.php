<?php
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
</head>

<body>

<style>
    body {
        color: black;
        background: #D3D3D3;
        font-family: 'Lato', sans-serif;
        font-size: 15px;
        line-height: 1.42857;
        margin-left: 250px; /* Adjusted the margin to accommodate the navbar width */
    }

    .container {
        max-width: 800px; /* Increased the max-width for a better layout */
        margin: 50px auto; /* Center the container horizontally with some top margin */
        padding: 20px;
        background-color: #f5f5f5;
        border: 1px solid #ddd;
        border-radius: 5px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); /* Added a subtle box shadow for depth */
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
        margin-bottom: 10px; /* Added some bottom margin for input elements */
        box-sizing: border-box; /* Ensures padding and border are included in width */
    }

    button {
        background-color: #007BFF;
        color: #fff;
        padding: 10px 20px;
        border: none;
        cursor: pointer;
    }

    .navbar {
        width: 250px;
        height: 100%;
        background-color: white;
        position: fixed;
        left: 0;
        top: 0;
        color: black; /* Changed text color to black for visibility */
        padding: 20px;
        display: flex;
        flex-direction: column;
        align-items: center;
        box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1); /* Added a shadow for separation from the content */
    }

    .navbar img {
        width: 80%; /* Adjusted the image width to 80% */
        max-height: 150px; /* Set a max-height for the image */
        object-fit: contain; /* Maintain aspect ratio while containing within the specified height */
        margin-bottom: 20px; /* Added some bottom margin for spacing */
    }

    .navbar a {
        display: block;
        width: 80%; /* Increased the link width for better clickability */
        padding: 10px 20px;
        text-decoration: none;
        text-align: center;
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
        margin-left: 250px;
        padding: 20px;
        margin-top: 20px; /* Added some top margin for separation from the navbar */
    }
    table {
    width: 80%;
    margin: 20px auto 0; /* Center the table horizontally with 20px top margin */
    border-collapse: collapse;
    margin-top: 20px;
    margin-left: -30px; /* Adjust the left margin to shift the table to the left */
}



    th, td {
        border: 1px solid #ddd;
        padding: 8px;
        text-align: left;
    }

    th {
        background-color: #f2f2f2;
    }
</style>


<div class="navbar">
        <img src="alhedia.png" alt="Jewelry Website Logo" class="logo"> <!-- Logo inside the navbar -->
        <a href="admin.php">Admin Dashboard</a>
        <a href="add_admin.php">Add Admin</a>
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

</body>

</html>
