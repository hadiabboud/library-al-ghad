<?php
require 'connection.php';
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_POST['user_id'];
    $book_id = $_POST['book_id'];
    $status = $_POST['status'];

    $sql = "INSERT INTO swapping (user_id, book_id, status) VALUES ('$user_id', '$book_id', '$status')";

    if ($conn->query($sql) === TRUE) {
        header("Location: admin_dashboard.php");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Swapping</title>
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
        .alert {
            margin-top: 20px;
        }
    </style>
</head>
<body>
<div class="container">
    <h2 class="text-center">Add Swapping</h2>
    <form method="post" action="">
        <div class="form-group">
            <label>User ID:</label>
            <input type="text" name="user_id" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Book ID:</label>
            <input type="text" name="book_id" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Status:</label>
            <input type="text" name="status" class="form-control" required>
        </div>
        <div class="text-center">
            <button type="submit" class="btn btn-primary">Add Swapping</button>
        </div>
    </form>
</div>
</body>
</html>
