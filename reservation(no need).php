<?php
require 'connection.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_SESSION['user_id'];
    $book_id = $_POST['book_id'];
    $reservation_date = date('Y-m-d');

    $sql = "INSERT INTO reservations (user_id, book_id, reservation_date) VALUES ('$user_id', '$book_id', '$reservation_date')";
    
    if ($conn->query($sql) === TRUE) {
        $success = "Reservation made successfully!";
    } else {
        $error = "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Reservation</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            padding-top: 20px;
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
            background-color: #007bff;
            border-color: #007bff;
        }
        .btn-primary:hover {
            background-color: #0069d9;
            border-color: #0062cc;
        }
        .btn-danger {
            background-color: #dc3545;
            border-color: #dc3545;
        }
        .btn-danger:hover {
            background-color: #c82333;
            border-color: #bd2130;
        }
        .alert {
            margin-top: 20px;
        }
    </style>
</head>
<body>
<div class="container">
    <h2>Reservation</h2>
    <a href="logout.php" class="btn btn-danger">Logout</a>
    <br><br>
    <?php if(isset($success)): ?>
        <div class="alert alert-success"><?= $success ?></div>
    <?php endif; ?>
    <?php if(isset($error)): ?>
        <div class="alert alert-danger"><?= $error ?></div>
    <?php endif; ?>
    <form method="post" action="">
        <div class="form-group">
            <label for="book_id">Book ID:</label>
            <input type="text" id="book_id" name="book_id" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Reserve</button>
    </form>
</div>
</body>
</html>
