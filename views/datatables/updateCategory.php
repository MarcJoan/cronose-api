<?php
header("Content-Type: application/json; charset=UTF-8");
$conn = new mysqli("localhost", "josep", "123", "Cronose");

$id = $_POST['id'];
$coin_price = $_POST['coin_price'];

$stmt = $conn->prepare("update Category set coin_price = '$coin_price' where id = '$id'");
$stmt->execute();
$result = $stmt->get_result();

$conn->close();

?>
