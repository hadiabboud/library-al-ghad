<?php
require 'connection.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: user_login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
?>

<!DOCTYPE html>
<html>
<head>
    <title>User Dashboard</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.11.4/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            padding-top: 20px;
            padding-bottom: 20px;
            background-image: url('uploads/img19.jpg');
        }
        .container {
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .btn-custom {
            margin-right: 10px;
        }
        .table-container {
            margin-top: 20px;
        }
        .table thead {
            background-color: #007bff;
            color: #fff;
        }
        .table th, .table td {
            vertical-align: middle;
            text-align: center;
        }
    </style>
</head>
<body>
<div class="container">
    <h2 class="mb-4">Welcome, <?php echo htmlspecialchars($_SESSION['user_name']); ?></h2>
    <a href="user_logout.php" class="btn btn-danger btn-custom">Logout</a>
    <a href="edit_profile.php" class="btn btn-primary btn-custom">Edit Profile</a>

    <div class="table-container">
        <h3 class="mt-4 mb-3">Available Items</h3>
        <table id="itemsTable" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Category</th>
                    <th>Description</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT * FROM items";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>
                            <td>{$row['id']}</td>
                            <td>{$row['price']}</td>
                            <td>{$row['quantity_available']}</td>
                            <td>{$row['category']}</td>
                            <td>{$row['description']}</td>
                            <td><a href='purchase.php?item_id={$row['id']}' class='btn btn-success btn-sm'>Purchase</a></td>
                        </tr>";
                    }
                }
                ?>
            </tbody>
        </table>
    </div>

    <hr>

    <div class="table-container">
        <h3 class="mt-4 mb-3">Current Offers</h3>
        <table id="offersTable" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Discount Percentage</th>
                    <th>Start Day</th>
                    <th>End Day</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT * FROM offers";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>
                            <td>{$row['id']}</td>
                            <td>{$row['discount_percentage']}</td>
                            <td>{$row['start_date']}</td>
                            <td>{$row['end_date']}</td>
                        </tr>";
                    }
                }
                ?>
            </tbody>
        </table>
    </div>

    <hr>

    <div class="table-container">
        <h3 class="mt-4 mb-3">Your Orders</h3>
        <table id="ordersTable" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Date Placed</th>
                    <th>Order Items</th>
                    <th>Payment Status</th>
                    <th>Shipping Method</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT * FROM orders WHERE user_id = '$user_id'";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>
                            <td>{$row['id']}</td>
                            <td>{$row['date_placed']}</td>
                            <td>{$row['order_items']}</td>
                            <td>{$row['payment_status']}</td>
                            <td>{$row['shipping_method']}</td>
                            <td>{$row['payment_status']}</td>
                            <td><a href='track_order.php?order_id={$row['id']}' class='btn btn-info btn-sm'>Track</a></td>
                        </tr>";
                    }
                }
                ?>
            </tbody>
        </table>
    </div>

    <hr>

    <div class="table-container">
        <h3 class="mt-4 mb-3">Your Swapping Requests</h3>
        <table id="swappingTable" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Book ID</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT * FROM swapping WHERE user_id = '$user_id'";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>
                            <td>{$row['id']}</td>
                            <td>{$row['book_id']}</td>
                            <td>{$row['status']}</td>
                        </tr>";
                    }
                }
                ?>
            </tbody>
        </table>
    </div>
    <div><button id="bbb" onclick="del()"></button></div>

</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.4/js/dataTables.bootstrap4.min.js"></script>
<script>
    $(document).ready(function() {
        $('#itemsTable, #offersTable, #ordersTable, #swappingTable').DataTable();
    });
</script>

</body>
</html>
