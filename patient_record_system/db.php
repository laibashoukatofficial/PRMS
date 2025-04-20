<?php
$host = " sql12.freesqldatabase.com"; // Replace with your actual host if different
$username = "sql12774261";           // Your Freesqldatabase username
$password = "RqXnrjwjCR";          // Your Freesqldatabase password
$database = "sql12774261";           // Your database name

$connection = new mysqli($host, $username, $password, $database);

if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

        // Uncomment below line to check connection
// echo "Database connected successfully!";
    
?>

