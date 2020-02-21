<?php
header("Content-Type: application/json; charset=UTF-8");
$conn = new mysqli("localhost", "josep", "123", "Cronose");

$id = $_POST['id'];
$name = $_POST['name'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$website = $_POST['website'];

$stmt = $conn->prepare("UPDATE Company SET name = '$name', email = '$email', phone = '$phone', website = '$website' where id = '$id'");
$stmt->execute();
$result = $stmt->get_result();

$conn->close();

?>
