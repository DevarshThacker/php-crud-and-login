<?php
include "config.php";
$prod_get = "SELECT * FROM product ORDER BY id DESC LIMIT 1";

$result = $conn->query($prod_get);
$data = [];

while ($row = $result->fetch_assoc()) {
    $data[] = $row;
}

echo json_encode($data);
?>