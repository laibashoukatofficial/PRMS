<?php
include 'db.php'; // Database connection

// Get patient ID from URL and sanitize it
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = $_GET['id'];

    // Fetch patient details using prepared statement
    $stmt = $conn->prepare("SELECT * FROM patients WHERE id = ?");
    $stmt->bind_param("i", $id); // 'i' means integer
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $patient = $result->fetch_assoc(); // Fetch the patient record
    } else {
        echo "Patient not found!";
        exit;
    }
    $stmt->close();
} else {
    echo "Invalid ID!";
    exit;
}

// Handle form submission for updating patient details
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $age = $_POST['age'];
    $residence = $_POST['residence'];
    $disease = $_POST['disease'];

    // Update using prepared statement
    $update = $conn->prepare("UPDATE patients SET name=?, age=?, residence=?, disease=? WHERE id=?");
    $update->bind_param("sissi", $name, $age, $residence, $disease, $id);

    if ($update->execute()) {
        header("Location: view_patients.php"); // Redirect on success
        exit;
    } else {
        echo "Error updating record: " . $update->error;
    }

    $update->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Patient</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="dashboard-container">
        <!-- Header -->
        <div class="dashboard-header">
            <h2>Edit Patient Record</h2>
            <a href="logout.php" class="logout-icon">
                <img src="logout.png" alt="Logout">
            </a>
        </div>

        <!-- Edit Form -->
        <div class="dashboard-content">
            <form method="POST">
                <label>Patient Name:</label>
                <input type="text" name="name" value="<?php echo htmlspecialchars($patient['name']); ?>" required>

                <label>Age:</label>
                <input type="number" name="age" value="<?php echo $patient['age']; ?>" required>

                <label>Residence:</label>
                <input type="text" name="residence" value="<?php echo htmlspecialchars($patient['residence']); ?>" required>

                <label>Disease:</label>
                <input type="text" name="disease" value="<?php echo htmlspecialchars($patient['disease']); ?>" required>

                <button type="submit">Update Patient</button>
            </form>

            <ul class="horizontal-list">
                <li><a href="view_patients.php">Back to Patient List</a></li>
            </ul>
        </div>
    </div>
</body>
</html>
