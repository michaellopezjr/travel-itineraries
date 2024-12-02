<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $destination = $_POST['destination'];
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];
    $activities = $_POST['activities'];

    $stmt = $conn->prepare("INSERT INTO itineraries (destination, start_date, end_date, activities) VALUES (?, ?, ?, ?)");
    $stmt->execute([$destination, $start_date, $end_date, $activities]);

    header("Location: index.php");
    exit; // Always exit after a header redirect
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400&family=Sacramento&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="styles.css"> <!-- Link to your CSS file -->
    <title>Create Itinerary</title>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f9f9f9;
            color: #333;
            margin: 0;
            padding: 20px;
        }

        h1 {
            font-family: 'Sacramento', cursive;
            color: #5a5a5a;
        }

        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            margin: 0 auto;
        }

        input[type="text"],
        input[type="date"],
        textarea {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            background-color: #5a5a5a;
            color: white;
            border: none;
            padding: 10px 15px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }

        input[type="submit"]:hover {
            background-color: #777;
        }

        a {
            display: inline-block;
            margin-top: 20px;
            text-decoration: none;
            color: #5a5a5a;
            font-weight: bold;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <h1>Create Itinerary</h1>
    <form method="post">
        <label for="destination">Destination:</label>
        <input type="text" name="destination" required><br>

        <label for="start_date">Start Date:</label>
        <input type="date" name="start_date" required><br>

        <label for="end_date">End Date:</label>
        <input type="date" name="end_date" required><br>

        <label for="activities">Activities:</label>
        <textarea name="activities" required></textarea><br>

        <input type="submit" value="Add Itinerary">
    </form>
    <a href="index.php">Back to Itineraries</a>
</body>
</html>