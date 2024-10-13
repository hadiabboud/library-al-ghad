<?php
require 'connection.php';
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

$id = $_GET['id'];

$sql = "DELETE FROM offers WHERE id=$id";

if ($conn->query($sql) === TRUE) {
    header("Location: manage_offers.php");
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
?>
