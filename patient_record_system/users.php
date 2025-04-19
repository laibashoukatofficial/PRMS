<?php
session_start(); // Start the session

include 'db.php'; // Include the database connection

// Check if user is not logged in or not an admin, redirect to login
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') {
    header("Location: login.php");
    exit;
}

// Fetch all users from the database
$users = $conn->query("SELECT * FROM users");
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"> <!-- Set character encoding -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- Mobile responsiveness -->
    <title>Users List</title> <!-- Page title -->
    <link rel="stylesheet" href="styles.css"> <!-- Link to external CSS -->
</head>
<body>

    <div class="dashboard-container"> <!-- Main container -->

        <!-- Header with page title and logout button -->
        <div class="dashboard-header">
            <h2>Users List</h2>
            <a href="logout.php" class="logout-icon">
                <img src="logout.png" alt="Logout"> <!-- Logout icon -->
            </a>
        </div>

        <!-- Main content section for users table -->
        <div class="dashboard-content">
            <table border="1"> <!-- Table to display user list -->
                <tr>
                    <th>ID</th>
                    <th>Username</th>
                    <th>Role</th>
                    <th>Actions</th> <!-- For edit and delete options -->
                </tr>

                <!-- Loop through each user and display their data -->
                <?php while ($row = $users->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $row['id']; ?></td> <!-- User ID -->
                        <td><?php echo $row['username']; ?></td> <!-- Username -->
                        <td><?php echo $row['role']; ?></td> <!-- Role (admin/operator) -->
                        <td>
                            <!-- Edit and Delete buttons with user ID in query string -->
                            <a href="edit_user.php?id=<?php echo $row['id']; ?>" class="btn-edit">Edit</a>
                            <a href="delete_user.php?id=<?php echo $row['id']; ?>" onclick="return confirm('Are you sure?');" class="btn-delete">Delete</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </table>

            <!-- Link to add a new user -->
            <ul class="horizontal-list">
                <li><a href="add_user.php">Add New User</a></li>
            </ul>

            <!-- Link back to admin dashboard -->
            <br>
            <a href="admin_dashboard.php" class="btn">Back to Admin Dashboard</a>
        </div>
    </div>

</body>
</html>
