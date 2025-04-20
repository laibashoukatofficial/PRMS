<?php
$host = "sql12.freesqldatabase.com"; // Replace with your actual host if different
$user = "sql12774261";           // Your Freesqldatabase username
$pass = "RqXnrjwjCR";          // Your Freesqldatabase password
$dbname = "sql12774261";           // Your database name

$conn = new mysqli($host, $user, $pass, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

        // Uncomment below line to check connection
// echo "Database connected successfully!";
    
?>

