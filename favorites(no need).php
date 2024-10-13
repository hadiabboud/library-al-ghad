<?php
require 'connection.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Fetch favorite books for the user
$user_id = $_SESSION['user_id'];
$sql = "SELECT * FROM favorites WHERE user_id = $user_id";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Favorites</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container">
    <h2>Favorites</h2>
    <a href="logout.php" class="btn btn-danger">Logout</a>
    <br><br>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Book ID</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?= $row['id'] ?></td>
                    <td><?= $row['book_id'] ?></td>
                    <td>
                        <a href="remove_favorite.php?id=<?= $row['id'] ?>" class="btn btn-danger">Remove</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>
</body>
</html>
