<?php
require 'connection.php';
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

$id = $_GET['id'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $price = $_POST['price'];
    $quantity = $_POST['quantity'];
    $category = $_POST['category'];
    $description = $_POST['description'];
    
    // Handle image uploads
    $target_dir = "uploads/";
    $images = [];
    $uploadOk = 1;

    foreach ($_FILES['images']['tmp_name'] as $key => $tmp_name) {
        $target_file = $target_dir . basename($_FILES['images']['name'][$key]);
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Check if image file is a actual image or fake image
        $check = getimagesize($tmp_name);
        if($check !== false) {
            if (move_uploaded_file($tmp_name, $target_file)) {
                $images[] = $target_file;
            } else {
                $uploadOk = 0;
            }
        } else {
            $uploadOk = 0;
        }
    }

    if ($uploadOk) {
        $images_json = json_encode($images);
        $sql = "UPDATE items SET price='$price', quantity_available='$quantity', category='$category', description='$description', images='$images_json' WHERE id=$id";
    } else {
        $sql = "UPDATE items SET price='$price', quantity_available='$quantity', category='$category', description='$description' WHERE id=$id";
    }

    if ($conn->query($sql) === TRUE) {
        header("Location: manage_items.php");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$sql = "SELECT * FROM items WHERE id = $id";
$result = $conn->query($sql);
$item = $result->fetch_assoc();
$item_images = json_decode($item['images'], true) ?? [];
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Item</title>
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
        .existing-images img {
            max-width: 100px;
            margin: 10px;
        }
    </style>
</head>
<body>
<div class="container">
    <h2 class="text-center">Edit Item</h2>
    <form method="post" action="" enctype="multipart/form-data">
        <div class="form-group">
            <label>Price:</label>
            <input type="text" name="price" class="form-control" value="<?= htmlspecialchars($item['price']) ?>" required>
        </div>
        <div class="form-group">
            <label>Quantity Available:</label>
            <input type="text" name="quantity" class="form-control" value="<?= htmlspecialchars($item['quantity_available']) ?>" required>
        </div>
        <div class="form-group">
            <label>Category:</label>
            <input type="text" name="category" class="form-control" value="<?= htmlspecialchars($item['category']) ?>" required>
        </div>
        <div class="form-group">
            <label>Description:</label>
            <textarea name="description" class="form-control" required><?= htmlspecialchars($item['description']) ?></textarea>
        </div>
        <div class="form-group">
            <label>Images:</label>
            <input type="file" name="images[]" class="form-control" multiple>
        </div>
        <div class="form-group existing-images">
            <label>Existing Images:</label>
            <?php foreach ($item_images as $image): ?>
                <img src="<?= htmlspecialchars($image) ?>" alt="Item Image">
            <?php endforeach; ?>
        </div>
        <div class="text-center">
            <button type="submit" class="btn btn-primary">Update</button>
        </div>
    </form>
</div>
</body>
</html>
