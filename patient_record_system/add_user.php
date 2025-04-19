<?php
include 'db.php'; // Include the database connection file

if ($_SERVER["REQUEST_METHOD"] == "POST") { // Check if form has been submitted using POST
    $username = $_POST['username']; // Get the username from the form
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Securely hash the password
    $role = $_POST['role']; // Get the selected user role (admin/operator)

    // SQL query to insert new user data into the users table
    $sql = "INSERT INTO users (username, password, role) VALUES ('$username', '$password', '$role')";
    
    if ($conn->query($sql) === TRUE) { // Execute the query and check if it's successful
        echo "New user added successfully!"; // Display success message
    } else {
        echo "Error: " . $conn->error; // Display error message if the query fails
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"> <!-- Character encoding -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- Responsive design on different devices -->
    <title>Add New User</title> <!-- Page title in browser tab -->
    <link rel="stylesheet" href="styles.css"> <!-- Link to external CSS file -->
</head>
<body>

    <div class="dashboard-container"> <!-- Main layout container -->

        <!-- Dashboard Header -->
        <div class="dashboard-header">
            <h2>Add User Record</h2> <!-- Page heading -->
            <a href="logout.php" class="logout-icon"> <!-- Logout button with icon -->
                <img src="logout.png" alt="Logout"> <!-- Logout icon image -->
            </a>
        </div>

        <!-- Form Section -->
        <div class="dashboard-content">
            <form method="POST"> <!-- Form to submit new user data -->
                <label>User Name:</label>
                <input type="text" name="username" required> <!-- Input field for username -->

                <label>Password:</label>
                <input type="text" name="password" required> <!-- Input field for password -->

                <label>Role:</label>
                <select name="role" required> <!-- Dropdown to select role -->
                    <option value="admin">Admin</option>
                    <option value="operator">Operator</option>
                </select>

                <button type="submit">Add User</button> <!-- Submit button -->
            </form>

            <ul class="horizontal-list">
                <li><a href="users.php">View users</a></li> <!-- Link to view user list -->
            </ul>

            <br>
            <a href="admin_dashboard.php" class="btn">Back to Admin Dashboard</a> <!-- Back to dashboard link -->
        </div>
    </div>

</body>
</html>
