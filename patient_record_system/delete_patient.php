<?php
include 'db.php'; // Connect to the database

// Check if a patient ID is passed via URL
if (isset($_GET['id'])) {
    $id = $_GET['id']; // Get the patient ID

    // Prepare a DELETE statement to prevent SQL injection
    $stmt = $conn->prepare("DELETE FROM patients WHERE id = ?");
    $stmt->bind_param("i", $id); // 'i' means integer type

    // Execute the query
    if ($stmt->execute()) {
        echo "Patient record deleted successfully!"; // Success message
    } else {
        echo "Error deleting record: " . $stmt->error; // Error message
    }

    $stmt->close(); // Close the prepared statement
}

// Redirect user back to the patient list
header("Location: view_patients.php");
exit;
?>
