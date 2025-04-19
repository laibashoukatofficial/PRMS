<?php
// Start the session
session_start();

// Check if the user is not logged in, redirect to login page
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}
?>

<?php
// Include the database connection file
include 'db.php';

// Fetch all patient records from the database, ordered by most recent first
$sql = "SELECT * FROM patients ORDER BY created_at DESC";
$result = $conn->query($sql);
?>

<?php


$result = $conn->query("SELECT * FROM patients");
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"> <!-- Character encoding for proper text display -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- Mobile responsiveness -->
    <title>View Patients</title> <!-- Title shown in browser tab -->
    <link rel="stylesheet" href="styles.css"> <!-- Link to your external CSS file -->
</head>
<body>

    <div class="dashboard-container"> <!-- Main wrapper container -->

        <!-- Dashboard header section -->
        <div class="dashboard-header">
            <h2>Patient Records</h2> <!-- Page title -->
            <a href="logout.php" class="logout-icon"> <!-- Logout link with icon -->
                <img src="logout.png" alt="Logout"> <!-- Image shown as logout button -->
            </a>
        </div>

        <!-- Main content section with patient table -->
        <div class="dashboard-content">

            <!-- Table to display patient records -->
            <table class="styled-table">
                <thead>
                    <tr>
                        <th>ID</th> <!-- Patient ID -->
                        <th>Name</th> <!-- Patient Name -->
                        <th>Age</th> <!-- Patient Age -->
                        <th>Residence</th> <!-- Patient Residence -->
                        <th>Disease</th> <!-- Disease details -->
                        <th>Created At</th> <!-- Record creation timestamp -->
                        
                    </tr>
                </thead>
                <tbody>
                    <!-- Loop through each row (patient) and display in the table -->
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo $row['id']; ?></td>
                            <td><?php echo $row['name']; ?></td>
                            <td><?php echo $row['age']; ?></td>
                            <td><?php echo $row['residence']; ?></td>
                            <td><?php echo $row['disease']; ?></td>
                            <td><?php echo $row['created_at']; ?></td>
                            
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>

            <!-- Links under the table -->
            

            <br>
            <!-- Button to go back to operator dashboard -->
            <a href="admin_dashboard.php" class="btn">Back to Admin Dashboard</a>
        </div>
    </div>

</body>
</html>

    </div>

</body>
</html>

