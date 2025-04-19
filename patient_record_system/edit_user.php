<?php
include 'db.php'; // Include database connection

// Validate and fetch user ID from the URL
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = $_GET['id'];

    // Fetch user data using a prepared statement
    $stmt = $conn->prepare("SELECT * FROM users WHERE id = ?");
    $stmt->bind_param("i", $id); // 'i' stands for integer
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if the user exists
    if ($result->num_rows == 1) {
        $user = $result->fetch_assoc(); // Get user details
    } else {
        echo "User not found!";
        exit;
    }
    $stmt->close();
} else {
    echo "Invalid user ID!";
    exit;
}

// Handle form submission for updating user
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $role = $_POST['role'];

    // Update user using a prepared statement
    $update = $conn->prepare("UPDATE users SET username = ?, role = ? WHERE id = ?");
    $update->bind_param("ssi", $username, $role, $id); // s = string, i = integer

    if ($update->execute()) {
        header("Location: users.php"); // Redirect to users list
        exit;
    } else {
        echo "Error updating user: " . $update->error;
    }

    $update->close();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
    <link rel="stylesheet" href="styles.css"> <!-- Link to your CSS -->
</head>
<body>

    <div class="dashboard-container">
        <div class="dashboard-header">
            <h2>Edit User</h2>
            <a href="logout.php" class="logout-icon">
                <img src="logout.png" alt="Logout">
            </a>
        </div>

        <div class="dashboard-content">
            <form method="POST">
                <label>Username:</label>
                <input type="text" name="username" value="<?php echo htmlspecialchars($user['username']); ?>" required>

                <label>Role:</label>
                <select name="role" required>
                    <option value="admin" <?php echo ($user['role'] == 'admin') ? 'selected' : ''; ?>>Admin</option>
                    <option value="operator" <?php echo ($user['role'] == 'operator') ? 'selected' : ''; ?>>Operator</option>
                </select>

                <button type="submit">Update User</button>
            </form>

            <br>
            <a href="users.php" class="btn">Back to Users List</a>
        </div>
    </div>

</body>
</html>
