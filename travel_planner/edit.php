<?php
include 'db.php';

// Check if an ID is provided in the URL
if (!isset($_GET['id'])) {
    echo "No itinerary ID provided.";
    exit;
}

// Retrieve the existing itinerary data for editing
$id = $_GET['id'];
$stmt = $conn->prepare("SELECT * FROM itineraries WHERE id = ?");
$stmt->execute([$id]);
$itinerary = $stmt->fetch();

if (!$itinerary) {
    echo "Itinerary not found.";
    exit;
}

// Handle the form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Handle the update of an itinerary
    if (isset($_POST['update'])) {
        $destination = $_POST['destination'];
        $start_date = $_POST['start_date'];
        $end_date = $_POST['end_date'];
        $activities = $_POST['activities'];

        // Update the itinerary in the database
        $stmt = $conn->prepare("UPDATE itineraries SET destination = ?, start_date = ?, end_date = ?, activities = ? WHERE id = ?");
        $stmt->execute([$destination, $start_date, $end_date, $activities, $id]);

        // Redirect to the index page after updating
        header("Location: index.php");
        exit;
    }

    // Handle the deletion of an itinerary
    if (isset($_POST['delete'])) {
        $stmt = $conn->prepare("DELETE FROM itineraries WHERE id = ?");
        $stmt->execute([$id]);

        // Redirect to the index page after deletion
        header("Location: index.php");
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Itinerary</title>
</head>
<body>
    <h1>Edit Itinerary</h1>
    <form method="post">
        <input type="hidden" name="id" value="<?php echo htmlspecialchars($itinerary['id']); ?>">
        <label>Destination:</label>
        <input type="text" name="destination" value="<?php echo htmlspecialchars($itinerary['destination']); ?>" required><br>
        <label>Start Date:</label>
        <input type="date" name="start_date" value="<?php echo htmlspecialchars($itinerary['start_date']); ?>" required><br>
        <label>End Date:</label>
        <input type="date" name="end_date" value="<?php echo htmlspecialchars($itinerary['end_date']); ?>" required><br>
        <label>Activities:</label>
        <textarea name="activities" required><?php echo htmlspecialchars($itinerary['activities']); ?></textarea><br>
        <input type="submit" name="update" value="Update Itinerary">
    </form>

    <form method="post" onsubmit="return confirm('Are you sure you want to delete this itinerary?');">
        <input type="hidden" name="id" value="<?php echo htmlspecialchars($itinerary['id']); ?>">
        <input type="submit" name="delete" value="Delete Itinerary">
    </form>

    <a href="index.php">Back to Itineraries</a>
</body>
</html>