<?php
session_start(); // Start a new or resume existing session
include 'db.php'; // Include the database connection file

$error = ""; // Initialize an empty variable for error messages

// Check if the request method is POST (i.e., form was submitted)
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']); // Get the submitted username and remove whitespace
    $password = md5($_POST['password']); // Encrypt the password using MD5 (consider using password_hash for better security)

    // Prepare a SQL statement to prevent SQL injection
    $stmt = $conn->prepare("SELECT * FROM users WHERE username=? AND password=?");
    $stmt->bind_param("ss", $username, $password); // Bind parameters: 's' for string (username and password)
    $stmt->execute(); // Execute the prepared statement
    $result = $stmt->get_result(); // Get the result set from the executed statement

    // Check if exactly one user matched the credentials
    if ($result->num_rows == 1) {
        $user = $result->fetch_assoc(); // Fetch the user data as an associative array
        $_SESSION['user_id'] = $user['id']; // Store user ID in session
        $_SESSION['username'] = $user['username']; // Store username in session
        $_SESSION['role'] = $user['role']; // Store user role in session

        // Redirect user based on their role
        if ($user['role'] == 'admin') {
            header("Location: admin_dashboard.php"); // Redirect to admin dashboard
            exit;
        } elseif ($user['role'] == 'operator') {
            header("Location: operator_dashboard.php"); // Redirect to operator dashboard
            exit;
        } else {
            $error = "Invalid role!"; // If role doesn't match expected values
        }
    } else {
        $error = "Invalid username or password!"; // Show error if login failed
    }

    $stmt->close(); // Close the prepared statement
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Meta tags for character encoding and responsive design -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title> <!-- Page title -->
    <link rel="stylesheet" href="styles.css"> <!-- Link to external CSS file -->
    <style>
        body {
            background-color: #f4f4f4; /* Light grey background */
            display: flex; /* Use flex layout */
            justify-content: center; /* Center content horizontally */
            align-items: center; /* Center content vertically */
            height: 100vh; /* Full viewport height */
            margin: 0; /* Remove default margin */
        }
    </style>
</head>
<body>
    <div class="login-container"> <!-- Container for login form -->
        <h2>User Login</h2> <!-- Login heading -->

        <!-- Show error message if it exists -->
        <?php if (!empty($error)) echo "<p class='error'>$error</p>"; ?>

        <!-- Login form -->
        <form method="POST">
            <label>Username:</label>
            <input type="text" name="username" required><br> <!-- Username input field -->

            <label>Password:</label>
            <input type="password" name="password" required><br> <!-- Password input field -->

            <button type="submit">Login</button> <!-- Submit button -->
            
        </form>

       
    </div>
</body>
</html>
