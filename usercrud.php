<?php

include_once "UserClass.php"; // Include your User class file
$users = User::SelectAllUsersInDB(); // Fetch all users

include_once "UserClass.php";


if (isset($_GET['delete_id'])) {
    $userID = $_GET['delete_id'];
    $UserObject=new User($userID);
    if(User::deleteUser($UserObject)){
        header("Location:usercrud.php");
        exit;
    }

}




echo '<a href="#">Create New User</a>';

// Display the user list
echo "<table>";
echo "<tr><th>ID</th><th>First Name</th><th>Last Name</th><th>Email</th><th>Actions</th></tr>";
foreach ($users as $user) {
    echo "<tr>";
    echo "<td>{$user->ID}</td>";
    echo "<td>{$user->FName}</td>";
    echo "<td>{$user->LName}</td>";
    echo "<td>{$user->Email}</td>";
    echo "<td><a href='edituser.php?edit_id={$user->ID}'>Edit</a> | <a href='usercrud.php?delete_id={$user->ID}'>Delete</a></td>";
    echo "</tr>";
}
echo "</table>";
?>
