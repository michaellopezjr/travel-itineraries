<?php
include 'db.php'; // Include your database connection file

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the form data
    $destination = $_POST['destination'];
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];
    $activities = $_POST['activities'];

    // Prepare the SQL statement
    $stmt = $conn->prepare("INSERT INTO itineraries (destination, start_date, end_date, activities) VALUES (?, ?, ?, ?)");
    
    // Execute the statement with the form data
    if ($stmt->execute([$destination, $start_date, $end_date, $activities])) {
        // Redirect back to index.php after successful insertion
        header("Location: index.php");
        exit;
    } else {
        echo "Error: Could not add the itinerary.";
    }
}
?>