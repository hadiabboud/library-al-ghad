<?php
require 'connection.php';
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $date_placed = $_POST['date_placed'];
    $order_items = $_POST['order_items'];
    $payment_status = $_POST['payment_status'];
    $shipping_method = $_POST['shipping_method'];
    $status = $_POST['status'];
    $user_id = $_POST['user_id'];

    $sql = "INSERT INTO orders (date_placed, order_items, payment_status, shipping_method, status, user_id) VALUES ('$date_placed', '$order_items', '$payment_status', '$shipping_method', '$status', '$user_id')";

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
    <title>Add Order</title>
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
    <h2 class="text-center">Add Order</h2>
    <form method="post" action="">
        <div class="form-group">
            <label>Date Placed:</label>
            <input type="date" name="date_placed" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Order Items:</label>
            <input type="text" name="order_items" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Payment Status:</label>
            <input type="text" name="payment_status" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Shipping Method:</label>
            <input type="text" name="shipping_method" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Status:</label>
            <input type="text" name="status" class="form-control" required>
        </div>
        <div class="form-group">
            <label>User ID:</label>
            <input type="text" name="user_id" class="form-control" required>
        </div>
        <div class="text-center">
            <button type="submit" class="btn btn-primary">Add Order</button>
        </div>
    </form>
</div>
</body>
</html>
