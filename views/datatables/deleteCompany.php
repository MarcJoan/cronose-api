<?php
header("Content-Type: application/json; charset=UTF-8");
$conn = new mysqli("localhost", "josep", "123", "Cronose");

$id = $_REQUEST['id'];

$stmt = $conn->prepare("DELETE FROM Company WHERE id = '$id'");
$stmt->execute();
$result = $stmt->get_result();

$conn->close();

?>
