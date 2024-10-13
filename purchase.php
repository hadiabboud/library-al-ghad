<?php
require 'connection.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: user_login.php");
    exit();
}

if (isset($_GET['item_id'])) {
    $item_id = $_GET['item_id'];
    $user_id = $_SESSION['user_id'];

    // Fetch item details
    $sql = "SELECT * FROM items WHERE id = $item_id";
    $result = $conn->query($sql);
    $item = $result->fetch_assoc();

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $quantity = $_POST['quantity'];

        // Insert order
        $sql = "INSERT INTO orders (date_placed, order_items, payment_status, shipping_method, user_id) 
                VALUES (NOW(), 'Item ID: $item_id, Quantity: $quantity', 'Pending', 'Standard', $user_id)";
        if ($conn->query($sql) === TRUE) {
            $success = "Purchase successful";
        } else {
            $error = "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Purchase Item</title>
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
            max-width: 600px;
            margin: 0 auto;
        }
        .form-group {
            margin-bottom: 20px;
        }
        .btn-primary {
            width: 100%;
        }
    </style>
</head>
<body>
<div class="container">
    <h2 class="mb-4">Purchase Item</h2>
    <?php if(isset($success)): ?>
        <div class="alert alert-success"><?= $success ?></div>
    <?php endif; ?>
    <?php if(isset($error)): ?>
        <div class="alert alert-danger"><?= $error ?></div>
    <?php endif; ?>
    <form method="post" action="">
        <div class="form-group">
            <label for="item_id">Item ID:</label>
            <input type="text" id="item_id" name="item_id" class="form-control" value="<?php echo $item['id']; ?>" readonly>
        </div>
        <div class="form-group">
            <label for="item_name">Item Name:</label>
            <input type="text" id="item_name" name="item_name" class="form-control" value="<?php echo $item['description']; ?>" readonly>
        </div>
        <div class="form-group">
            <label for="quantity">Quantity:</label>
            <input type="number" id="quantity" name="quantity" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Purchase</button>
    </form>
</div>
</body>
</html>
