<?php
require 'connection.php';
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

// Fetch data from the database
$items_sql = "SELECT * FROM items";
$items_result = $conn->query($items_sql);

$users_sql = "SELECT * FROM user";
$users_result = $conn->query($users_sql);

$orders_sql = "SELECT * FROM orders";
$orders_result = $conn->query($orders_sql);

$offers_sql = "SELECT * FROM offers";
$offers_result = $conn->query($offers_sql);

$swapping_sql = "SELECT * FROM swapping";
$swapping_result = $conn->query($swapping_sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <style>
        body {
            background-color: #f8f9fa;
            background-image: url('uploads/img19.jpg');
        }
        .container {
            margin-top: 20px;
        }
        .btn {
            margin: 5px;
        }
        .card {
            margin-top: 20px;
        }
        h3 {
            margin-top: 20px;
        }
        table {
            width: 100% !important;
        }
    </style>
</head>
<body>
<div class="container">
    <h2 class="text-center">Admin Dashboard</h2>
    <div class="text-right">
        <a href="logout.php" class="btn btn-danger">Logout</a>
    </div>
    <hr>

    <div class="card">
        <div class="card-body">
            <h3>Manage Items</h3>
            <a href="add_item.php" class="btn btn-success">Add Item</a>
            <table id="itemsTable" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Price</th>
                        <th>Quantity Available</th>
                        <th>Category</th>
                        <th>Description</th>
                        <th>Manage</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $items_result->fetch_assoc()): ?>
                        <tr>
                            <td><?= $row['id'] ?></td>
                            <td><?= $row['price'] ?></td>
                            <td><?= $row['quantity_available'] ?></td>
                            <td><?= $row['category'] ?></td>
                            <td><?= $row['description'] ?></td>
                            <td>
                                <a href="edit_item.php?id=<?= $row['id'] ?>" class="btn btn-primary btn-sm">Edit</a>
                                <a href="delete_item.php?id=<?= $row['id'] ?>" class="btn btn-danger btn-sm">Delete</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <h3>Manage Users</h3>
            <a href="add_user.php" class="btn btn-success">Add User</a>
            <table id="usersTable" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Address</th>
                        <th>Age</th>
                        <th>Manage</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $users_result->fetch_assoc()): ?>
                        <tr>
                            <td><?= $row['id'] ?></td>
                            <td><?= $row['name'] ?></td>
                            <td><?= $row['email'] ?></td>
                            <td><?= $row['address'] ?></td>
                            <td><?= $row['age'] ?></td>
                            <td>
                                <a href="edit_user.php?id=<?= $row['id'] ?>" class="btn btn-primary btn-sm">Edit</a>
                                <a href="delete_user.php?id=<?= $row['id'] ?>" class="btn btn-danger btn-sm">Delete</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <h3>Manage Orders</h3>
            <a href="add_order.php" class="btn btn-success">Add Order</a>
            <table id="ordersTable" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Date Placed</th>
                        <th>Order Items</th>
                        <th>Payment Status</th>
                        <th>Shipping Method</th>
                        <th>Status</th>
                        <th>Manage</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $orders_result->fetch_assoc()): ?>
                        <tr>
                            <td><?= $row['id'] ?></td>
                            <td><?= $row['date_placed'] ?></td>
                            <td><?= $row['order_items'] ?></td>
                            <td><?= $row['payment_status'] ?></td>
                            <td><?= $row['shipping_method'] ?></td>
                            <td><?= $row['payment_status'] ?></td>
                            <td>
                                <a href="edit_order.php?id=<?= $row['id'] ?>" class="btn btn-primary btn-sm">Edit</a>
                                <a href="delete_order.php?id=<?= $row['id'] ?>" class="btn btn-danger btn-sm">Delete</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <h3>Manage Offers</h3>
            <a href="add_offer.php" class="btn btn-success">Add Offer</a>
            <table id="offersTable" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Discount Percentage</th>
                        <th>Start Day</th>
                        <th>End Day</th>
                        <th>Manage</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $offers_result->fetch_assoc()): ?>
                        <tr>
                            <td><?= $row['id'] ?></td>
                            <td><?= $row['discount_percentage'] ?></td>
                            <td><?= $row['start_date'] ?></td>
                            <td><?= $row['end_date'] ?></td>
                            <td>
                                <a href="edit_offer.php?id=<?= $row['id'] ?>" class="btn btn-primary btn-sm">Edit</a>
                                <a href="delete_offer.php?id=<?= $row['id'] ?>" class="btn btn-danger btn-sm">Delete</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <h3>Manage Swapping</h3>
            <a href="add_swapping.php" class="btn btn-success">Add Swapping</a>
            <table id="swappingTable" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>User ID</th>
                        <th>Book ID</th>
                        <th>Status</th>
                        <th>Manage</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $swapping_result->fetch_assoc()): ?>
                        <tr>
                            <td><?= $row['id'] ?></td>
                            <td><?= $row['user_id'] ?></td>
                            <td><?= $row['book_id'] ?></td>
                            <td><?= $row['status'] ?></td>
                            <td>
                                <a href="edit_swapping.php?id=<?= $row['id'] ?>" class="btn btn-primary btn-sm">Edit</a>
                                <a href="delete_swapping.php?id=<?= $row['id'] ?>" class="btn btn-danger btn-sm">Delete</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    $('#itemsTable').DataTable();
    $('#usersTable').DataTable();
    $('#ordersTable').DataTable();
    $('#offersTable').DataTable();
    $('#swappingTable').DataTable();
});
</script>
</body>
</html>
