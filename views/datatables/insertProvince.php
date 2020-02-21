<?php
header("Content-Type: application/json; charset=UTF-8");
$conn = new mysqli("localhost", "josep", "123", "Cronose");

$name = $_POST['name'];

$stmt = $conn->prepare("INSERT INTO Province (name) VALUES ('$name')");
$stmt->execute();
$result = $stmt->get_result();

$conn->close();

?>
