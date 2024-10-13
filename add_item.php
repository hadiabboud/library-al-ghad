<?php
require 'connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $price = $_POST['price'];
    $quantity = $_POST['quantity'];
    $category = $_POST['category'];
    $description = $_POST['description'];
    $images = [];

    $uploadDir = 'uploads/';
    foreach ($_FILES['images']['tmp_name'] as $key => $tmpName) {
        $fileName = basename($_FILES['images']['name'][$key]);
        $filePath = $uploadDir . $fileName;
        if (move_uploaded_file($tmpName, $filePath)) {
            $images[] = $filePath;
        }
    }

    $imagesJson = json_encode($images);

    $sql = "INSERT INTO items (price, quantity_available, category, description, images) VALUES ('$price', '$quantity', '$category', '$description', '$imagesJson')";

    if ($conn->query($sql) === TRUE) {
        $success = "New item added successfully";
    } else {
        $error = "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Item</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            background-image:url(img19.jpg);
        }
        .container {
            margin-top: 50px;
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
    <h2 class="text-center">Add Item</h2>
    <?php if(isset($success)): ?>
        <div class="alert alert-success"><?= $success ?></div>
    <?php endif; ?>
    <?php if(isset($error)): ?>
        <div class="alert alert-danger"><?= $error ?></div>
    <?php endif; ?>
    <form method="post" action="" enctype="multipart/form-data">
        <div class="form-group">
            <label>Price:</label>
            <input type="text" name="price" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Quantity:</label>
            <input type="text" name="quantity" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Category:</label>
            <input type="text" name="category" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Description:</label>
            <textarea name="description" class="form-control" rows="4" required></textarea>
        </div>
        <div class="form-group">
            <label>Images:</label>
            <input type="file" name="images[]" class="form-control" multiple required>
        </div>
        <div class="text-center">
            <button type="submit" class="btn btn-primary">Add Item</button>
        </div>
    </form>
</div>
</body>
</html>
