<?php
session_start(); // Start session to access session variables
include 'db.php'; // Include database connection

// Check if user is logged in and is an admin
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') {
    header("Location: login.php");
    exit;
}

// Check if an ID is provided in the URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Use prepared statement to securely delete user
    $stmt = $conn->prepare("DELETE FROM users WHERE id = ?");
    $stmt->bind_param("i", $id); // Bind 'id' as integer

    if ($stmt->execute()) {
        echo "User deleted successfully!";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close(); // Close statement
}

// Redirect back to admin dashboard
header("Location: admin_dashboard.php");
exit;
?>
