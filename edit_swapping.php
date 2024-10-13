<?php
require 'connection.php';
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

$id = $_GET['id'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_POST['user_id'];
    $book_id = $_POST['book_id'];
    $status = $_POST['status'];

    $sql = "UPDATE swapping SET user_id='$user_id', book_id='$book_id', status='$status' WHERE id=$id";
    
    if ($conn->query($sql) === TRUE) {
        header("Location: manage_swapping.php");
        exit();
    } else {
        echo "Error updating record: " . $conn->error;
    }
}

$sql = "SELECT * FROM swapping WHERE id = $id";
$result = $conn->query($sql);
$swapping = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Swapping</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            padding-top: 50px;
            background-image: url('uploads/img19.jpg')
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
        }
        .form-group label {
            font-weight: bold;
        }
        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
            width: 100%;
        }
        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #004085;
        }
    </style>
</head>
<body>
<div class="container">
    <h2 class="text-center">Edit Swapping</h2>
    <form method="post" action="">
        <div class="form-group">
            <label for="user_id">User ID:</label>
            <input type="text" id="user_id" name="user_id" class="form-control" value="<?= htmlspecialchars($swapping['user_id']) ?>" required>
        </div>
        <div class="form-group">
            <label for="book_id">Book ID:</label>
            <input type="text" id="book_id" name="book_id" class="form-control" value="<?= htmlspecialchars($swapping['book_id']) ?>" required>
        </div>
        <div class="form-group">
            <label for="status">Status:</label>
            <input type="text" id="status" name="status" class="form-control" value="<?= htmlspecialchars($swapping['status']) ?>" required>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
</body>
</html>
