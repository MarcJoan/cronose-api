<?php
header("Content-Type: application/json; charset=UTF-8");
$conn = new mysqli("localhost", "josep", "123", "Cronose");

$name = $_POST['name'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$website = $_POST['website'];

$stmt = $conn->prepare("INSERT INTO Company (name, email, phone, website) VALUES ('$name', '$email', '$phone', '$website')");
$stmt->execute();
$result = $stmt->get_result();

$conn->close();

?>
