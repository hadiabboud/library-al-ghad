<?php
require 'connection.php';
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

$sql = "SELECT * FROM orders";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Manage Orders</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background-image: url('uploads/img19.jpg');
        }
        </style>
</head>
<body>
<div class="container">
    <h2>Manage Orders</h2>
    <a href="logout.php" class="btn btn-danger">Logout</a>
    <br><br>
    <table id="ordersTable" class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Date Placed</th>
                <th>Order Items</th>
                <th>Payment Status</th>
                <th>Shipping Method</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?= $row['id'] ?></td>
                    <td><?= $row['date_placed'] ?></td>
                    <td><?= $row['order_items'] ?></td>
                    <td><?= $row['payment_status'] ?></td>
                    <td><?= $row['shipping_method'] ?></td>
                    <td><?= $row['payment_status'] ?></td>
                    <td>
                        <a href="edit_order.php?id=<?= $row['id'] ?>" class="btn btn-warning">Edit</a>
                        <a href="delete_order.php?id=<?= $row['id'] ?>" class="btn btn-danger">Delete</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script>
$(document).ready(function() {
    $('#ordersTable').DataTable();
});
</script>
</body>
</html>
