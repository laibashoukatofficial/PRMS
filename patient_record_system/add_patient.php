<?php
session_start(); // Start session to use session variables
if (!isset($_SESSION['user_id'])) { // Check if user is logged in
    header("Location: login.php"); // If not, redirect to login page
    exit; // Stop executing the script
}
?>

<?php
include 'db.php'; // Include database connection file

if ($_SERVER["REQUEST_METHOD"] == "POST") { // Check if form is submitted using POST method
    $name = $_POST['name']; // Get patient name from form
    $age = $_POST['age']; // Get patient age
    $address = $_POST['address']; // Get address input
    $residence = $_POST['residence']; // Get patient residence
    $disease = $_POST['disease']; // Get patient disease

    // SQL query to insert data into patients table
    $sql = "INSERT INTO patients (name, age, address, residence, disease) VALUES ('$name', '$age', '$address' '$residence', '$disease')";

    if ($conn->query($sql) === TRUE) { // Run query and check if successful
        echo "Patient record added successfully!"; // Success message
    } else {
        echo "Error: " . $conn->error; // Show error if query fails
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"> <!-- Character encoding -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- Responsive design -->
    <title>Add Patient Record</title> <!-- Page title -->
    <link rel="stylesheet" href="styles.css"> <!-- Link external CSS -->
</head>
<body>

    <div class="dashboard-container"> <!-- Main container -->

        <!-- Dashboard Header -->
        <div class="dashboard-header">
            <h2>Add Patient Record</h2> <!-- Heading -->
            <a href="logout.php" class="logout-icon"> <!-- Logout link -->
                <img src="logout.png" alt="Logout"> <!-- Logout icon -->
            </a>
        </div>

        <!-- Form Section -->
        <div class="dashboard-content">
            <form method="POST"> <!-- Patient input form -->
                <label>Patient Name:</label>
                <input type="text" name="name" required> <!-- Text input for name -->

                <label>Age:</label>
                <input type="number" name="age" required> <!-- Number input for age -->

                <label>Address:</label>
                <input type="text" name="address" required>


                <label>Residence:</label>
                <input type="text" name="residence" required> <!-- Text input for residence -->

                <label>Disease:</label>
                <input type="text" name="disease" required> <!-- Text input for disease -->

                <button type="submit">Add Patient</button> <!-- Submit button -->
            </form>

            <ul class="horizontal-list">
                <li><a href="view_patients.php">View Patients</a></li> <!-- Link to view patients -->
            </ul>
            <br>
            <a href="operator_dashboard.php" class="btn">Back to Operator Dashboard</a> <!-- Back button -->
        </div>
    </div>

</body>
</html>
