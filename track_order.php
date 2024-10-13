<?php
require 'connection.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: user_login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

$order_id = $_GET['order_id'];
$sql = "SELECT * FROM orders WHERE id='$order_id' AND user_id='$user_id'";
$result = $conn->query($sql);
$order = $result->fetch_assoc();

$delivery_sql = "SELECT * FROM delivery WHERE order_id='$order_id'";
$delivery_result = $conn->query($delivery_sql);
$delivery = $delivery_result->fetch_assoc();

$item_ids = explode(',', $order['order_items']);
$item_images = [];

foreach ($item_ids as $item_id) {
    $item_sql = "SELECT images FROM items WHERE id='$item_id'";
    $item_result = $conn->query($item_sql);
    if ($item_result->num_rows > 0) {
        $item = $item_result->fetch_assoc();
        $images = json_decode($item['images'], true);
        if (is_array($images)) {
            $item_images = array_merge($item_images, $images);
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Track Order</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            padding-top: 20px;
            background-image: url('uploads/img19.jpg');
        }
        .container {
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 800px;
            margin: 0 auto;
        }
        .table th {
            width: 30%;
            font-weight: normal;
        }
        .table td {
            vertical-align: middle;
        }
        .carousel-inner img {
            width: 100%;
            height: 500px;
        }
    </style>
</head>
<body>
<div class="container">
    <h2 class="mb-4">Track Order</h2>
    <h3>Order Details</h3>
    <table class="table table-bordered">
        <tr>
            <th>ID</th>
            <td><?php echo $order['id']; ?></td>
        </tr>
        <tr>
            <th>Date Placed</th>
            <td><?php echo $order['date_placed']; ?></td>
        </tr>
        <tr>
            <th>Order Items</th>
            <td><?php echo $order['order_items']; ?></td>
        </tr>
        <tr>
            <th>Payment Status</th>
            <td><?php echo $order['payment_status']; ?></td>
        </tr>
        <tr>
            <th>Shipping Method</th>
            <td><?php echo $order['shipping_method']; ?></td>
        </tr>
    </table>

    <?php if ($delivery): ?>
    <h3>Delivery Details</h3>
    <table class="table table-bordered">
        <tr>
            <th>Notes</th>
            <td><?php echo $delivery['notes']; ?></td>
        </tr>
        <tr>
            <th>Delivery Cost</th>
            <td><?php echo $delivery['delivery_cost']; ?></td>
        </tr>
        <tr>
            <th>Delivery Company Name</th>
            <td><?php echo $delivery['delivery_company_name']; ?></td>
        </tr>
        <tr>
            <th>Delivery Status</th>
            <td><?php echo $delivery['delivery_status']; ?></td>
        </tr>
    </table>
    <?php else: ?>
        <p>No delivery information available.</p>
    <?php endif; ?>

    <?php if (!empty($item_images)): ?>
    <h3>Item Images</h3>
    <div id="itemImagesCarousel" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
            <?php foreach ($item_images as $index => $image): ?>
            <div class="carousel-item <?php if ($index == 0) echo 'active'; ?>">
                <img class="d-block w-100" src="<?php echo $image; ?>" alt="Item Image <?php echo $index + 1; ?>">
            </div>
            <?php endforeach; ?>
        </div>
        <a class="carousel-control-prev" href="#itemImagesCarousel" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#itemImagesCarousel" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
    <?php endif; ?>
</div>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>
</html>
