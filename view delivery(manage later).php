<?php
require 'connection.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Fetch deliveries for the user
$user_id = $_SESSION['user_id'];
$sql = "SELECT * FROM delivery WHERE user_id = $user_id";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>View Delivery</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container">
    <h2>View Delivery</h2>
    <a href="logout.php" class="btn btn-danger">Logout</a>
    <br><br>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Notes</th>
                <th>Delivery Cost</th>
                <th>Delivery Company Name</th>
                <th>Delivery Status</th>
                <th>Order ID</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?= $row['id'] ?></td>
                    <td><?= $row['notes'] ?></td>
                    <td><?= $row['delivery_cost'] ?></td>
                    <td><?= $row['delivery_company_name'] ?></td>
                    <td><?= $row['delivery_status'] ?></td>
                    <td><?= $row['order_id'] ?></td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>
</body>
</html>
