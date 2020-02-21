<?php
header("Content-Type: application/json; charset=UTF-8");
$conn = new mysqli("localhost", "josep", "123", "Cronose");

$coin_price = $_POST['coin_price'];

$stmt = $conn->prepare("INSERT INTO Category (coin_price) VALUES ('$coin_price')");
$stmt->execute();
$result = $stmt->get_result();

$conn->close();

?>
