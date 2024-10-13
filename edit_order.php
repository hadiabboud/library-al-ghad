<?php
require 'connection.php';
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

$id = $_GET['id'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $date_placed = $_POST['date_placed'];
    $order_items = $_POST['order_items'];
    $payment_status = $_POST['payment_status'];
    $shipping_method = $_POST['shipping_method'];

    $sql = "UPDATE orders SET date_placed='$date_placed', order_items='$order_items', payment_status='$payment_status', shipping_method='$shipping_method' WHERE id=$id";
    
    if ($conn->query($sql) === TRUE) {
        header("Location: manage_orders.php");
        exit();
    } else {
        echo "Error updating record: " . $conn->error;
    }
}

$sql = "SELECT * FROM orders WHERE id = $id";
$result = $conn->query($sql);
$order = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Order</title>
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
    <h2 class="text-center">Edit Order</h2>
    <form method="post" action="">
        <div class="form-group">
            <label>Date Placed:</label>
            <input type="date" name="date_placed" class="form-control" value="<?= htmlspecialchars($order['date_placed']) ?>" required>
        </div>
        <div class="form-group">
            <label>Order Items:</label>
            <textarea name="order_items" class="form-control" rows="5" required><?= htmlspecialchars($order['order_items']) ?></textarea>
        </div>
        <div class="form-group">
            <label>Payment Status:</label>
            <input type="text" name="payment_status" class="form-control" value="<?= htmlspecialchars($order['payment_status']) ?>" required>
        </div>
        <div class="form-group">
            <label>Shipping Method:</label>
            <input type="text" name="shipping_method" class="form-control" value="<?= htmlspecialchars($order['shipping_method']) ?>" required>
        </div>
        <div class="text-center">
            <button type="submit" class="btn btn-primary">Update</button>
        </div>
    </form>
</div>
</body>
</html>
