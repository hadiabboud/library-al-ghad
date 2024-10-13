<?php
require 'connection.php';
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

$id = $_GET['id'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $discount_percentage = $_POST['discount_percentage'];
    $start_day = $_POST['start_day'];
    $end_day = $_POST['end_day'];

    $sql = "UPDATE offers SET discount_percentage='$discount_percentage', start_date='$start_day', end_date='$end_day' WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        header("Location: manage_offers.php");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$sql = "SELECT * FROM offers WHERE id = $id";
$result = $conn->query($sql);
$offer = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Offer</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            background-image: url('uploads/img19.jpg')
        }
        .container {
            margin-top: 50px;
            max-width: 600px;
        }
        .form-group label {
            font-weight: bold;
        }
        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }
        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #004085;
        }
    </style>
</head>
<body>
<div class="container">
    <h2 class="text-center">Edit Offer</h2>
    <form method="post" action="">
        <div class="form-group">
            <label>Discount Percentage:</label>
            <input type="text" name="discount_percentage" class="form-control" value="<?= htmlspecialchars($offer['discount_percentage']) ?>" required>
        </div>
        <div class="form-group">
            <label>Start Day:</label>
            <input type="date" name="start_day" class="form-control" value="<?= htmlspecialchars($offer['start_date']) ?>" required>
        </div>
        <div class="form-group">
            <label>End Day:</label>
            <input type="date" name="end_day" class="form-control" value="<?= htmlspecialchars($offer['end_date']) ?>" required>
        </div>
        <div class="text-center">
            <button type="submit" class="btn btn-primary">Update</button>
        </div>
    </form>
</div>
</body>
</html>
