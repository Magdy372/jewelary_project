<?php

include_once "UserClass.php"; // Include your User class file
$users = User::SelectAllUsersInDB(); // Fetch all users

include_once "UserClass.php";

  


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
    echo "<td><a href='edit.php?id={$user->ID}'>Edit</a> | <a href='delete.php?id={$user->ID}'>Delete</a></td>";
    echo "</tr>";
}
echo "</table>";
?>
