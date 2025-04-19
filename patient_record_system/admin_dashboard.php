<?php
// Start session only if it is not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start(); // Start a new session
}

include 'db.php'; // Include the database connection file

// Check if the user is logged in and is an admin
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') {
    header("Location: login.php"); // Redirect to login if not logged in or not admin
    exit;
}

// Process form submission to add a new user
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username']; // Get username from form
    $password = md5($_POST['password']); // Hash password using MD5 (Note: outdated and insecure)
    $role = $_POST['role']; // Get selected role from form

    // SQL query to insert new user
    $sql = "INSERT INTO users (username, password, role) VALUES ('$username', '$password', '$role')";

    // Execute query and show result
    if ($conn->query($sql) === TRUE) {
        echo "<p style='color: green; text-align: center;'>User added successfully!</p>"; // Success message
    } else {
        echo "<p style='color: red; text-align: center;'>Error: " . $conn->error . "</p>"; // Error message
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"> <!-- Character encoding -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- Responsive layout -->
    <title>Admin Dashboard</title> <!-- Title of the page -->
    <link rel="stylesheet" href="styles.css"> <!-- External CSS file -->
</head>
<body>

<div class="dashboard-container"> <!-- Main container for layout -->

    <!-- Header section with title and logout -->
    <div class="dashboard-header">
        <h2>Admin Dashboard</h2>
        <a href="logout.php" class="logout-icon"> <!-- Logout icon -->
            <img src="logout.png" alt="Logout">
        </a>
    </div>    

    <!-- Main content section -->
    <div class="dashboard-content">
        <h3>Add New User</h3>

        <!-- Form to add a new user -->
        <form method="POST">
            <label>Username:</label>
            <input type="text" name="username" required>

            <label>Password:</label>
            <input type="password" name="password" required>

            <label>Role:</label>
            <select name="role">
                <option value="operator">Operator</option>
                <option value="admin">Admin</option>
            </select>

            <button type="submit">Add User</button>
        </form>

        <!-- Links to other admin pages -->
        <ul class="horizontal-list">
            <li><a href="users.php">View Users</a></li>
            <li><a href="view_patients_admin.php">View Patients</a></li>
        </ul>
    </div>

</body>
</html>
