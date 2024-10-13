<?php
require 'connection.php';
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

$sql = "SELECT * FROM offers";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Manage Offers</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet">
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
    <h2>Manage Offers</h2>
    <a href="logout.php" class="btn btn-danger">Logout</a>
    <br><br>
    <table id="offersTable" class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Discount Percentage</th>
                <th>Start Day</th>
                <th>End Day</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?= $row['id'] ?></td>
                    <td><?= $row['discount_percentage'] ?></td>
                    <td><?= $row['start_date'] ?></td>
                    <td><?= $row['end_date'] ?></td>
                    <td>
                        <a href="edit_offer.php?id=<?= $row['id'] ?>" class="btn btn-warning">Edit</a>
                        <a href="delete_offer.php?id=<?= $row['id'] ?>" class="btn btn-danger">Delete</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script>
$(document).ready(function() {
    $('#offersTable').DataTable();
});
</script>
</body>
</html>
