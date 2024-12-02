<?php
include 'db.php';

// Fetch all itineraries from the database
$stmt = $conn->prepare("SELECT * FROM itineraries");
$stmt->execute();
$itineraries = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Itineraries</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1> Travel Itineraries</h1>
    <table>
        <tr>
            <th>ID</th>
            <th>Destination</th>
            <th>Start Date</th>
            <th>End Date</th>
            <th>Activities</th>
            <th>Actions</th>
        </tr>
        <?php foreach ($itineraries as $itinerary): ?>
        <tr>
            <td><?php echo htmlspecialchars($itinerary['id']); ?></td>
            <td><?php echo htmlspecialchars($itinerary['destination']); ?></td>
            <td><?php echo htmlspecialchars($itinerary['start_date']); ?></td>
            <td><?php echo htmlspecialchars($itinerary['end_date']); ?></td>
            <td><?php echo htmlspecialchars($itinerary['activities']); ?></td>
            <td>
                <a href="edit.php?id=<?php echo htmlspecialchars($itinerary['id']); ?>">Edit</a>
                <form method="post" action="index.php" style="display:inline;">
                    <input type="hidden" name="id" value="<?php echo htmlspecialchars($itinerary['id']); ?>">
                    <input type="submit" name="delete" value="Delete" onclick="return confirm('Are you sure you want to delete this itinerary?');">
                </form>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>

    <h2>Add New Itinerary</h2>
<form method="post" action="add.php">
    <label>Destination:</label>
    <input type="text" name="destination" required><br>
    <label>Start Date:</label>
    <input type="date" name="start_date" required><br>
    <label>End Date:</label>
    <input type="date" name="end_date" required><br>
    <label>Activities:</label>
    <textarea name="activities" required></textarea><br>
    <input type="submit" value="Add Itinerary">
</form>

    <?php
    // Handle the deletion of an itinerary
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete'])) {
        $deleteId = $_POST['id'];
        $stmt = $conn->prepare("DELETE FROM itineraries WHERE id = ?");
        $stmt->execute([$deleteId]);
        header("Location: index.php"); // Refresh the page after deletion
        exit;
    }
    ?>
</body>
</html>