<?php
$host = "localhost";  // Server name
$user = "root";       // Default MySQL user
$pass = "";           // No password by default
$dbname = "patient_db"; // Your database name

// Create connection
$conn = new mysqli($host, $user, $pass, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Uncomment below line to check connection
// echo "Database connected successfully!";
?>
