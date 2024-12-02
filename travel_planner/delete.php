<?php
include 'db.php';

// Check if the ID is provided
if (!isset($_GET['id'])) {
    header("Location: index.php");
    exit();
}

$id = $_GET['id'];

// Delete the itinerary
$stmt = $conn->prepare("DELETE FROM itineraries WHERE id = ?");
$stmt->execute([$id]);

// Redirect to the index page after deletion
header("Location: index.php");
exit();
?>