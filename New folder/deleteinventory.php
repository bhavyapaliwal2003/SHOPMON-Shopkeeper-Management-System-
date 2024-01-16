<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once('php/config.php');

if (!isset($_GET['id'])) {
    header("Location: inventory.php");
    exit();
}

$id = $_GET['id'];

$conn = get_db_connection();

$stmt = $conn->prepare("DELETE FROM `inventory` WHERE `id` = ?");
$stmt->bind_param("i", $id);

$result = $stmt->execute();

if ($result) {
    echo "Product deleted successfully!";
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();

header('location:inventory.php');
die();
?>
