<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"> <!-- Set character encoding -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- Responsive layout -->
    <title>Operator Dashboard</title> <!-- Page title -->
    <link rel="stylesheet" href="styles.css"> <!-- Link to external stylesheet -->
</head>
<body>

    <div class="dashboard-container"> <!-- Main container for dashboard -->
        
        <!-- Dashboard header with title and logout button -->
        <div class="dashboard-header">
            <h2>Operator Dashboard</h2>
            <a href="logout.php" class="logout-icon">
                <img src="logout.png" alt="Logout"> <!-- Logout icon -->
            </a>
        </div>

        <!-- Main content area -->
        <div class="dashboard-content">
            <h3>Add Patient Record</h3> <!-- Form heading -->

            <!-- Patient input form -->
            <form method="POST">
                <label>Name:</label>
                <input type="text" name="name" required> <!-- Patient name -->

                <label>Age:</label>
                <input type="number" name="age" required> <!-- Patient age -->

                <label>Address:</label>
                <input type="text" name="address" required>

                <label>Residence:</label>
                <input type="text" name="residence" required> <!-- Patient residence -->

                <label>Disease:</label>
                <input type="text" name="disease" required> <!-- Patient disease -->

                <button type="submit">Add Record</button> <!-- Submit button -->
            </form>

            <!-- Navigation link to view all patients -->
            <ul class="horizontal-list">
                <li><a href="view_patients.php">View Patients</a></li>
            </ul>
        </div>
    </div>

</body>
</html>
