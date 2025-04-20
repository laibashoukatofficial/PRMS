<?php
$host = "db4free.net";
$username = "laibadev";         // your username
$password = "Umar@447#";     // your password
$database = "patient_db";       // your DB name

$connection = new mysqli($host, $username, $password, $database);

if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

    // Uncomment below line to check connection
// echo "Database connected successfully!";
    
?>
