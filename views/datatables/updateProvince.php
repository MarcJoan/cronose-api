<?php
header("Content-Type: application/json; charset=UTF-8");
$conn = new mysqli("localhost", "josep", "123", "Cronose");

$id = $_POST['id'];
$name = $_POST['name'];

$stmt = $conn->prepare("update Province set name = '$name' where id = '$id'");
$stmt->execute();
$result = $stmt->get_result();

$conn->close();

?>
