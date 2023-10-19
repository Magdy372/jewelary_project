<?php
$servername = "172.232.216.8";  // Replace with the remote server's IP address or hostname
 // Use the appropriate port for the remote MySQL server
$username = "root";  // Replace with your MySQL username
$password = "Omarsalah123o";  // Replace with your MySQL password
$DB = "Jewelry_project"; 


// Create a connection
$conn = new mysqli($servername, $username, $password, $DB);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} else {
    echo "Connected successfully to the remote MySQL server!";
}

// Perform your database operations here

