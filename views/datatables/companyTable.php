<?php
header("Content-Type: application/json; charset=UTF-8");
$conn = new mysqli("localhost", "josep", "123", "Cronose");
$stmt = $conn->prepare("SELECT * FROM Company");
$stmt->execute();
$result = $stmt->get_result();
$output = $result->fetch_all(MYSQLI_ASSOC);
echo json_encode($output);
?>
