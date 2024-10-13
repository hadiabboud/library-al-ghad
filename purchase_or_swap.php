<?php
require 'connection.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Fetch items from the database
$sql = "SELECT * FROM items";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Purchase or Swap Books</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
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
    <h2>Purchase or Swap Books</h2>
    <a href="logout.php" class="btn btn-danger">Logout</a>
    <br><br>
    <table id="itemsTable" class="display">
        <thead>
            <tr>
                <th>ID</th>
                <th>Price</th>
                <th>Quantity Available</th>
                <th>Category</th>
                <th>Description</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?= $row['id'] ?></td>
                    <td><?= $row['price'] ?></td>
                    <td><?= $row['quantity_available'] ?></td>
                    <td><?= $row['category'] ?></td>
                    <td><?= $row['description'] ?></td>
                    <td>
                        <a href="purchase_item.php?id=<?= $row['id'] ?>" class="btn btn-primary">Purchase</a>
                        <a href="swap_item.php?id=<?= $row['id'] ?>" class="btn btn-secondary">Swap</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>

<script>
$(document).ready(function() {
    $('#itemsTable').DataTable();
});
</script>
</body>
</html>
