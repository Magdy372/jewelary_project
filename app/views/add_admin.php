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
//$model = new User();
$controller = new AdminController($model);
//$view = new ViewUser($controller, $model);



// if (isset($_POST['Submit'])){


// 	$Fname =  $_POST['FName'];
// 	$Lname =  $_POST['LName'];
// 	$password=$_POST['Password'];
// 	$Conpass=$_POST['conPass'];
// 	$email =  $_POST['Email'];


//    $controller->insert($Fname, $Lname, $password,$Conpass, $email) ;

if (isset($_POST['Submit'])) {
    $Fname =  $_POST['FName'];
    $Lname =  $_POST['LName'];
    $password = $_POST['Password'];
    $Conpass = $_POST['conPass'];
    $email =  $_POST['Email'];

    $controller->insert_admin($Fname, $Lname, $password, $Conpass, $email);
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Jewelry Website</title>

    <link rel="stylesheet" href="../../css/add_admin.css">

</head>

<body>

    <div class="navbar">
        <img src="alhedia.png" alt="Jewelry Website Logo" class="logo"> <!-- Logo inside the navbar -->
        <a href="admin.php">Admin Dashboard</a>
        <!-- <a href="add_admin.php">Add Admin</a> -->
        <a href="crud.php">Product</a>
        <a href="usercrud.php">Users</a>
        <a href="Admins.php">Admins</a>

    </div>

    <div class="container">
        <h2>Add a New Admin</h2>
        <form method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="First">Fisrt Name <span>*<?php echo $controller->getFnameErr(); ?></span></label>
                <input type="text" name="FName" id="First" required>
            </div>

            <div class="form-group">
                <label for="Last">Last Name <span>*<?php echo $controller->getLnameErr();; ?></span></label>
                <input type="text" name="LName" id="Last" required>
            </div>

            <div class="form-group">
                <label for="Email">E-mail <span>*<?php echo $controller->getEmailErr(); ?></span></label>
                <input type="text" name="Email" id="Email" required>
            </div>

            <div class="form-group">
                <label for="Pass">Password <span>* <?php echo $controller->getPasswordErr(); ?></span></label>
                <input type="password" name="Password" id="Pass" required>
            </div>

            <div class="form-group">
                <label for="ConfPass">Confirm Password <span>* <?php echo $controller->getConfirmErr(); ?></span></label>
                <input type="password" name="conPass" id="ConfPass" required>
            </div>

            <button type="submit" name="Submit">Add admin</button>
        </form>
    </div>
</body>

</html>